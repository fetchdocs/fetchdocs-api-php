<?php

namespace Fetchdocs\SDKClient\Services;

use Fetchdocs\SDKClient\Exceptions\ExceptionFactory;
use Fetchdocs\SDKClient\Exceptions\FetchSDKException;
use Fetchdocs\SDKClient\Exceptions\MissingRequiredParametersException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Service
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $serverURI;

    /**
     * @var string
     */
    private $hashKey;

    /**
     * Service constructor.
     *
     * @param string $apiKey
     * @param $hashKey
     * @param string $serverURI
     */
    public function __construct($apiKey, $serverURI, $hashKey = null)
    {
        $this->client = new Client();
        $this->apiKey = $apiKey;
        $this->serverURI = $serverURI;
        $this->hashKey = $hashKey;
    }

    /**
     * Execute
     *
     * @param string $endpoint
     * @param array $data
     * @param array $requiredParameters
     *
     * @return mixed
     *
     * @throws FetchSDKException
     * @throws MissingRequiredParametersException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute($endpoint, $data = [], $requiredParameters = [])
    {
        try {
            $this->validate($data, $requiredParameters);
            return $this->request($endpoint, $data);
        } catch (ClientException $exception) {
            throw ExceptionFactory::make($exception);
        }
    }

    /**
     * Send request
     *
     * @param string $endpoint
     * @param array $data
     *
     * @return mixed
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function request($endpoint, $data = [])
    {
        $requestParameters = array_merge([API_KEY_FIELD_NAME => $this->apiKey], $data);

        if ($this->hashKey) {
            $requestParameters = $this->castString($requestParameters);
            $requestParameters[API_CHECKSUM_FIELD_NAME] = $this->hashRequest($requestParameters);
        }

        $response = $this->client->request('POST', $this->serverURI . $endpoint, [
            'headers' => ['content-type' => 'application/json'],
            'json' => $requestParameters
        ]);

        return json_decode($response->getBody());
    }

    /**
     * Hash Request
     *
     * @param array $requestParameters
     *
     * @return string
     */
    private function hashRequest($requestParameters)
    {
        return hash_hmac(API_HASH_ALGORITHM, json_encode($requestParameters), $this->hashKey);
    }

    /**
     * Cast Request Parameters to string
     *
     * @param array $data
     *
     * @return array
     */
    private function castString($data)
    {
        $result = [];

        foreach ($data as $key => $value) {
            $result[$key] = "$value";
        }

        return $result;
    }

    /**
     * Validate request
     *
     * @param $data
     * @param array $requiredParameters
     *
     * @return bool
     *
     * @throws MissingRequiredParametersException
     */
    private function validate($data, $requiredParameters = [])
    {
        $missingParameters = [];

        foreach ($requiredParameters as $parameter) {
            if (!isset($data[$parameter])) {
                $missingParameters[] = $parameter;
            }
        }

        if(count($missingParameters)) {
            throw new MissingRequiredParametersException('Those Parameters are required ' . implode(',', $missingParameters), 403);
        }

        return true;
    }
}

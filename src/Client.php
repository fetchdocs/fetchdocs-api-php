<?php

namespace Fetchdocs\SDKClient;

use Fetchdocs\SDKClient\Exceptions\MissingRequiredParametersException;
use Fetchdocs\SDKClient\Services\Service;

class Client
{
    /**
     * @var Service
     */
    private $service;


    /**
     * Client constructor.
     *
     * @param $apiKey
     * @param $serverURI
     * @param string | null $hashKey
     */
    public function __construct($apiKey, $serverURI, $hashKey = null)
    {
        $this->service = new Service($apiKey, $serverURI, $hashKey);
    }

    /**
     * Make a new instance of Client Class
     *
     * @param string $apiKey
     * @param string | null $hashKey
     * @param bool $useStageServer
     *
     * @return Client
     */
    public static function make($apiKey, $hashKey = null, $useStageServer = false)
    {
        $serverURI = PROD_SERVER_URI;

        if ($useStageServer) {
            $serverURI = STAGE_SERVER_URI;
        }

        return new Client($apiKey, $serverURI, $hashKey);
    }

    /**
     *  Timezones
     *
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function timezones()
    {
        return $this->service->execute(TIMEZONES_ENDPOINT)->data;
    }

    /**
     *  Environments
     *
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function environments()
    {
        return $this->service->execute(ENVIRONMENTS_ENDPOINT)->data;
    }

    /**
     * List Date Formats
     *
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function dateFormats()
    {
        return $this->service->execute(DATE_FORMATS_ENDPOINT)->data;
    }

    /**
     * Create Environment
     *
     * @param array $data
     *
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createEnvironment($data)
    {
        $requiredParameters = [
            'name',
            'push_notification_url',
            'push_input_request_url'
        ];

        return $this->service->execute(CREATE_ENVIRONMENT_ENDPOINT, $data, $requiredParameters)->data;
    }

    /**
     * Update Environment
     *
     * @param $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateEnvironment($data)
    {
        $requiredParameters = [
            'prim_uid'
        ];

        return $this->service->execute(UPDATE_ENVIRONMENT_ENDPOINT, $data, $requiredParameters);
    }

    /**
     * Delete Environment
     *
     * @param array $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteEnvironment($data)
    {
        $requiredParameters = [
            'prim_uid',
        ];

        return $this->service->execute(DELETE_ENVIRONMENT_ENDPOINT, $data, $requiredParameters);
    }

    /**
     * List Customer Accounts
     *
     * @param array $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listCustomersAccounts($data)
    {
        return $this->service->execute(LIST_CUSTOMER_ACCOUNTS_ENDPOINT, $data)->data;
    }

    /**
     * Create Customer
     *
     * @param array $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createCustomer($data)
    {
        return $this->service->execute(CREATE_CUSTOMER_ENDPOINT, $data)->data;
    }

    /**
     * Update Customer
     *
     * @param array $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateCustomer($data)
    {
        $requiredParameters = [
            'prim_uid',
            'customer_secret'
        ];

        return $this->service->execute(UPDATE_CUSTOMER_ENDPOINT, $data, $requiredParameters);
    }

    /**
     * Delete Customer
     *
     * @param $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteCustomer($data)
    {
        $requiredParameters = [
            'prim_uid',
            'customer_secret'
        ];

        return $this->service->execute(DELETE_CUSTOMER_ENDPOINT, $data, $requiredParameters);
    }

    /**
     * Deactivate Customer
     *
     * @param $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deactivateCustomer($data)
    {
        $requiredParameters = [
            'prim_uid',
            'customer_secret'
        ];

        return $this->service->execute(DEACTIVATE_CUSTOMER_ENDPOINT, $data, $requiredParameters);
    }

    /**
     * Activate Customer
     *
     * @param $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function activateCustomer($data)
    {
        $requiredParameters = [
            'prim_uid',
            'customer_secret'
        ];

        return $this->service->execute(ACTIVATE_CUSTOMER_ENDPOINT, $data, $requiredParameters);
    }

    /**
     * Get Customer Account Overview
     *
     * @param $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCustomerAccountOverview($data)
    {
        $requiredParameters = [
            'prim_uid'
        ];

        return $this->service->execute(GET_CUSTOMER_ACCOUNT_OVERVIEW_ENDPOINT, $data, $requiredParameters)->data;
    }

    /**
     * Get Customer Account Overview
     *
     * @param $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCustomerSession($data)
    {
        $requiredParameters = [
            'prim_uid',
            'customer_secret'
        ];

        return $this->service->execute(GET_CUSTOMER_SESSION_ENDPOINT, $data, $requiredParameters)->data;
    }

    /**
     * Destroy Customer Session
     *
     * @param $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function destroyCustomerSession($data)
    {
        $requiredParameters = [
            'access_token',
        ];

        return $this->service->execute(DESTROY_CUSTOMER_SESSION_ENDPOINT, $data, $requiredParameters);
    }

    /**
     * List Suppliers
     *
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listSuppliers()
    {
        return $this->service->execute(LIST_SUPPLIERS_ENDPOINT)->data;
    }

    /**
     * Create Customer Supplier
     *
     * @param array $data
     * @param string $encryptionKey
     *
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createCustomerSupplier($data, $encryptionKey)
    {
        $requiredParameters = [
            'customer_prim_uid',
            'supplier_prim_uid',
            'fields',
            'active',
            'iv'
        ];

        return $this->service->execute(CREATE_CUSTOMER_SUPPLIER_ENDPOINT, $this->attachUsernamePassword($data, $encryptionKey), $requiredParameters);
    }

    /**
     * Attach username and password to request parameters
     *
     * @param $data
     * @param $encryptionKey
     * @return array
     *
     * @throws MissingRequiredParametersException
     */
    private function attachUsernamePassword($data, $encryptionKey)
    {
        if (!isset($data['username']) || !isset($data['password'])) {
            throw new MissingRequiredParametersException('Username and password are required', 403);
        }

        $iv = $this->generateCipherIV();

        $data['fields'] = json_encode([
            'USERNAME' => $data['username'],
            'PASSWORD' => $this->encryptPassword($data['password'], $encryptionKey, $iv)
        ]);

        $data['iv'] = base64_encode($iv);

        unset($data['password']);
        unset($data['username']);

        return $data;
    }

    /**
     * Test Password Encryption
     *
     * @param $password
     * @param $encryptionKey
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testPasswordEncryption($password, $encryptionKey)
    {
        $iv = $this->generateCipherIV();

        return $this->service->execute(TEST_PASSWORD_ENCRYPTION_ENDPOINT, [
            'iv' => base64_encode($iv),
            'password_encrypted' => $this->encryptPassword($password, $encryptionKey, $iv),
            'password_compare' => base64_encode($password)
        ]);
    }

    /**
     * Generate Cipher IV
     *
     * @return string
     */
    private function generateCipherIV()
    {
        return openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-ctr'));
    }

    /**
     * Encrypt Password
     *
     * @param $password
     * @param $encryptionKey
     * @param $iv
     *
     * @return string
     */
    private function encryptPassword($password, $encryptionKey, $iv)
    {
        return base64_encode(openssl_encrypt($password, 'aes-256-ctr', $encryptionKey, true, $iv));
    }

    /**
     * Delete customer supplier
     *
     * @param array $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteCustomerSupplier($data)
    {
        $requiredParameters = [
            'prim_uid',
        ];

        return $this->service->execute(DELETE_CUSTOMER_SUPPLIER_ENDPOINT, $data, $requiredParameters);
    }

    /**
     * List customer suppliers
     *
     * @param $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listCustomerSuppliers($data)
    {
        $requiredParameters = [
            'prim_uid',
        ];

        return $this->service->execute(LIST_CUSTOMER_SUPPLIERS_ENDPOINT, $data, $requiredParameters)->data;
    }

    /**
     * Update customer supplier
     *
     * @param $data
     * @param $encryptionKey
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateCustomerSupplier($data, $encryptionKey)
    {
        $requiredParameters = [
            'prim_uid',
            'fields',
            'active',
            'iv',
            'customer_prim_uid'
        ];

        return $this->service->execute(UPDATE_CUSTOMER_SUPPLIER_ENDPOINT, $this->attachUsernamePassword($data, $encryptionKey), $requiredParameters);
    }

    /**
     * Get Supplier Fields
     *
     * @param array $data
     *
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSupplierFields($data)
    {
        $requiredParameters = [
            'prim_uid'
        ];

        return $this->service->execute(GET_SUPPLIER_FIELDS, $data, $requiredParameters)->data;
    }

    /**
     * Get Document Queue
     *
     * @param array $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDocumentsQueue($data)
    {
        $requiredParameters = [
            'environment_prim_uid'
        ];

        return $this->service->execute(GET_DOCUMENT_QUEUE, $data, $requiredParameters)->data;
    }

    /**
     * Test Queue Document
     *
     * @param $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testQueueDocument($data)
    {
        $requiredParameters = [
            'prim_uid',
            'customer_supplier_uid',
        ];

        return $this->service->execute(TEST_QUEUE_DOCUMENT_ENDPOINT, $data, $requiredParameters);
    }

    /**
     * Get Document
     *
     * @param array $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDocument($data)
    {
        $requiredParameters = [
            'prim_uid',
            'customer_secret'
        ];

        return $this->service->execute(GET_DOCUMENT, $data, $requiredParameters)->data;
    }

    /**
     * Remove Document From Queue
     *
     * @param array $data
     * @return mixed
     *
     * @throws Exceptions\FetchSDKException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function removeDocumentFromQueue($data)
    {
        $requiredParameters = [
            'prim_uid',
            'customer_secret'
        ];

        return $this->service->execute(REMOVE_DOCUMENT_FROM_QUEUE, $data, $requiredParameters);
    }
}

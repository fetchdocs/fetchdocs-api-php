<?php

namespace Fetchdocs\SDKClient\Exceptions;

use GuzzleHttp\Exception\ClientException;

class ExceptionFactory
{
    const API_KEY_IS_MISSING = 'general#403#1';
    const API_KEY_IS_BLOCKED = 'general#403#2';
    const API_CHECKSUM_IS_MISSING = 'general#403#4';
    const INVALID_API_CHECKSUM = 'general#403#5';
    const DAILY_LIMIT_EXCEEDED = 'general#429#1';
    const MINUTE_LIMIT_EXCEEDED = 'general#429#2';
    const SERVICE_UNAVAILABLE = 'general#503';
    const MISSING_REQUIRED_PARAMETERS_CODE = 'general#403';

    /**
     * Make Exception depends on the error code
     *
     * @param \GuzzleHttp\Exception\ClientException $exception
     *
     * @return  FetchSDKException
     */
    public static function make(ClientException $exception)
    {
        $body = json_decode($exception->getResponse()->getBody());

        switch ($body->code) {
            case self::API_KEY_IS_MISSING:
                return new MissingAPIKeyException($body->detail, $exception->getCode());
            case self::MISSING_REQUIRED_PARAMETERS_CODE:
                return new MissingRequiredParametersException($body->detail, $exception->getCode());
            case self::API_KEY_IS_BLOCKED:
                return new APIKeyIsBlockedException($body->detail, $exception->getCode());
            case self::API_CHECKSUM_IS_MISSING:
                return new MissingAPIChecksumException($body->detail, $exception->getCode());
            case self::INVALID_API_CHECKSUM:
                return new InvalidAPIChecksum($body->detail, $exception->getCode());
            case self::DAILY_LIMIT_EXCEEDED:
                return new LimitExceededException($body->detail, $exception->getCode());
            case self::MINUTE_LIMIT_EXCEEDED:
                return new LimitExceededException($body->detail, $exception->getCode());
            case self::SERVICE_UNAVAILABLE:
                return new ServiceUnavailableException($body->detail, $exception->getCode());
            default:
                return new FetchSDKException($body->detail, $exception->getCode());
        }
    }
}

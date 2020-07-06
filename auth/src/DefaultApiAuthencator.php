<?php
/**
 * Created by PhpStorm.
 * User: appeon
 * Date: 2020/7/2
 * Time: 14:13
 */
namespace Auth;

use Auth\Storage\CredentialStorage;
use Auth\Storage\MySqlCredentialStorage;

class DefaultApiAuthencator implements ApiAuthencator
{
    private $credentialStorage;

    public function __construct(CredentialStorage $credentialStorage = null)
    {
        if (empty($credentialStorage)){
            $this->credentialStorage = new MySqlCredentialStorage();
        } else {
            $this->credentialStorage = $credentialStorage;
        }

    }


    public function auth($apiRequest)
    {
        if(is_string($apiRequest)){
            $apiRequest = ApiRequest::createFromFullUrl($apiRequest);
        }

        $appId     = $apiRequest->getAppId();
        $token     = $apiRequest->getToken();
        $timestamp = $apiRequest->getTimestamp();
        $baseUrl   = $apiRequest->getBaseUrl();

        // 校验 token 是否过期
        $clientAuthToken = new AuthToken($token,$timestamp);
        if ($clientAuthToken->isExpired()){
            throw new \RuntimeException('Token is expired.');
        }

        // 校验 token 是否正确
        $password = $this->credentialStorage->getPasswordByAppId($appId);
        $serverAuthToken = AuthToken::generate($baseUrl,$appId,$password,$timestamp);
        if (!$serverAuthToken->match($clientAuthToken)){
            throw new \RuntimeException('Token verification fail.');
        }
        echo 'ok';
    }
}
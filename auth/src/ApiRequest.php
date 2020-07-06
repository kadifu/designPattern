<?php
/**
 * Created by PhpStorm.
 * User: appeon
 * Date: 2020/7/2
 * Time: 13:23
 */

namespace Auth;

class ApiRequest{

    private $baseUrl;
    private $token;
    private $appId;
    private $timestamp;

    public function __construct(string $baseUrl,string $token,string $appId,int $timestamp)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
        $this->appId = $appId;
        $this->timestamp = $timestamp;
    }

    static public function createFromFullUrl(string $url):ApiRequest
    {
        //$url=https://www.666.com/login?appId=1001&timestamp=1454568865&token=a78cdefhrtes998erej
        list($baseUrl,$pramStr) = explode('?',$url);
        $prams = explode('&',$pramStr);
        $token = $appId = '';
        $timestamp = 0;
        foreach ($prams as $pram){
            list($key,$val) = explode('=',$pram);
            switch ($key){
                case 'appId':
                    $appId = $val;
                    break;
                case 'token':
                    $token = $val;
                    break;
                case 'timestamp':
                    $timestamp = $val;
                    break;
            }
        }
        return new ApiRequest($baseUrl,$token,$appId,$timestamp);
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

}
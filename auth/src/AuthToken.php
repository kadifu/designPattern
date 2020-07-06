<?php
/**
 * Created by PhpStorm.
 * User: appeon
 * Date: 2020/7/2
 * Time: 11:10
 */

namespace Auth;

class AuthToken{

    private $token;
    private $createTime;
    private $expiredTimeInterval = 1*60*1000;

    public function __construct(string $token,int $createTime,int $expiredTimeInterval = 0){
        if (!empty($expiredTimeInterval)){
            $this->expiredTimeInterval = $expiredTimeInterval;
        }
        $this->token = $token;
        $this->createTime = $createTime;
    }

    /**
     * @param string $baseUrl
     * @param string $appId
     * @param string $password
     * @param int $timestamp
     * @return AuthToken
     */
    static public function generate(string $baseUrl,string $appId,string $password,int $timestamp):AuthToken
    {
        $token = self::generateToken($baseUrl,$appId,$password,$timestamp);
        return new AuthToken($token,$timestamp);

    }

    static public function generateToken(string $baseUrl,string $appId,string $password,int $timestamp):string
    {
        return md5($baseUrl.$appId.$password.$timestamp);
    }

    public function getToken():string{
        return $this->token;
    }

    /**
     * @return bool
     */
    public function isExpired():bool{
        return $this->createTime + $this->expiredTimeInterval > time() ? true : false;
    }

    /**
     * @param AuthToken $authToken
     * @return bool
     */
    public function match(AuthToken $authToken):bool{
        return $this->getToken() === $authToken->getToken() ? true : false;
    }
}
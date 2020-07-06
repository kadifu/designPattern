<?php
/**
 * Created by PhpStorm.
 * User: appeon
 * Date: 2020/7/2
 * Time: 14:18
 */
namespace Auth\Storage;

class MySqlCredentialStorage implements CredentialStorage
{
    /**
     * @param string $appId
     * @return string
     */
    public function getPasswordByAppId(string $appId): string
    {
        // TODO: Implement getPasswordByAppId() method.
        return 'password';
    }

}
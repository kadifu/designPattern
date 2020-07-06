<?php
/**
 * Created by PhpStorm.
 * User: appeon
 * Date: 2020/7/2
 * Time: 13:35
 */
namespace Auth\Storage;

interface CredentialStorage
{
    /**
     * @param string $appId
     * @return string
     */
    public function getPasswordByAppId(string $appId):string;
}
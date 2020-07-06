<?php
/**
 * Created by PhpStorm.
 * User: appeon
 * Date: 2020/7/2
 * Time: 13:58
 */

namespace Auth;
interface ApiAuthencator
{
    /**
     * @param $apiRequest
     * @return mixed
     */
    public function auth($apiRequest);
}
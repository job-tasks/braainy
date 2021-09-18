<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class CurlService.
 */
final class CurlService
{
    /**
     * @param $url
     * @param array $postArray
     * @return bool|string
     */
    public function send($url, $postArray = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        //If there is array to send post else get
        if (!empty($postArray)) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postArray));
        }

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);

        // Check HTTP status code
        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK
                    return $result;
                default:
                    return false;
            }
        }
    }
}

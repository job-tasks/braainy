<?php

namespace App\Service;


/**
 * Class CurlService.
 */
final class CurlService
{
    /**
     * @param $url
     * @param $requestType
     * @param array $postArray
     * @return bool|string
     */
    public function send($url, $requestType = CURLOPT_HTTPGET, $postArray = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        $headers = [
            "X-Access-Token: 749f6c0f873eb98f16257eec9baa47c944617d34"
        ];

        //If there is array to send post else get
        if ($requestType === CURLOPT_POST) {
            curl_setopt($ch, $requestType, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postArray));
        }

        if ($requestType === CURLOPT_PUT) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postArray));
            $headers = [
                "X-Access-Token: 749f6c0f873eb98f16257eec9baa47c944617d34",
                'Content-Type: application/json',
            ];
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

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

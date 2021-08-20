<?php

namespace App\Services;

/**
 *This service will handle the functions related to the URL
 */
class UrlService
{

    /**
     * @param string $url
     *
     * @return bool
     */
    final public function validateUrl(string $url): bool
    {
        return (bool)filter_var($url, FILTER_VALIDATE_URL);
    }


    final public function uniqueId()
    {
    }

}

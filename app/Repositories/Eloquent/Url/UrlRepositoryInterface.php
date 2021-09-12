<?php

namespace App\Repositories\Eloquent\Url;

interface UrlRepositoryInterface
{
    /**
     * Find record which has given redirect id
     * @return mixed
     */
    public function findByRedirectId(string $redirectId);

    /**
     * Check if given redirect id is exists
     * @return bool
     */
    public function isRedirectIdExists(string $redirectId): bool;
}

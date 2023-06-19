<?php

namespace App\Services\Facades;

use App\Services\ArticleService;
use Illuminate\Support\Facades\Facade;

/**
 * Facade for user service
 */
class ArticleFacade extends Facade
{

    /**
     * Returning service name
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ArticleService::class;
    }
}

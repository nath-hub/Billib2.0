<?php

namespace App\Services\Facades;

use App\Services\TicketService;
use Illuminate\Support\Facades\Facade;

/**
 * Facade for user service
 */
class TicketFacade extends Facade
{

    /**
     * Returning service name
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TicketService::class;
    }
}

<?php
namespace Konversation\Cuckoo\Facade;

use Illuminate\Support\Facades\Facade;

class Topic extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cuckoo.topic';
    }
}


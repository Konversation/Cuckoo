<?php
namespace Konversation\Cuckoo\Exception;

use InvalidArgumentException;

class InvalidEntityException extends InvalidArgumentException
{
    /*
     * The message to output when this exception is thrown.
     *
     * @var string
     */
    protected $message = 'The given entity type is invalid.';
}


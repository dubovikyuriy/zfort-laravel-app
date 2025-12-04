<?php

namespace App\Exceptions;

use Exception;

class IncompleteActorDataException extends Exception
{
    public static function missingFields(): self
    {
        return new self("Please add first name, last name, and address to your description.");
    }
}

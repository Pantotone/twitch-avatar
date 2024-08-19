<?php

namespace App\Clients;

use Exception;

class TwitchException extends Exception
{
    public static function userNotFound(string $username): self
    {
        $message = sprintf('User %s doesn\'t exists.', $username);

        return new self($message, 404);
    }

    public static function categoryNotFound(string $category): self
    {
        $message = sprintf('Category %s doesn\'t exists.', $category);

        return new self($message, 404);
    }
}

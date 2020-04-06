<?php

namespace App\Application\Shared\Request;

use Symfony\Component\HttpFoundation\Request;

trait JsonRequest
{
    public static function fromBody(Request $request)
    {
        $requestContent = $request->getContent();
        return self::getRequestInstance(json_decode($requestContent));
    }

    public static function getRequestInstance($attributes)
    {
        $self = new self;

        $requestSelfAttributes = get_object_vars($self);

        foreach ($attributes as $key => $value) {
            if (array_key_exists($key, $requestSelfAttributes)) {
                $self->$key = $value;
            }
        }

        return $self;
    }
}

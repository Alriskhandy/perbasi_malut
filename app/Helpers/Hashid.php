<?php

namespace App\Helpers;

use Hashids\Hashids;

class Hashid
{
    private static function make(): Hashids
    {
        return new Hashids(config('app.key'), 8);
    }

    public static function encode(int $id): string
    {
        return self::make()->encode($id);
    }

    public static function decode(string $hash): ?int
    {
        $decoded = self::make()->decode($hash);
        return isset($decoded[0]) ? (int) $decoded[0] : null;
    }
}

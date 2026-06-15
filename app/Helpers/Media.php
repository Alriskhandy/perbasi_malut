<?php

namespace App\Helpers;

class Media
{
    /**
     * Build a public URL for a path stored on the "public" disk.
     * Accepts relative paths (e.g. "clubs/pjr/logo.png") as well as
     * legacy absolute URLs already saved with a host baked in.
     */
    public static function url(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    /**
     * Normalize a value coming from the file manager (often a full URL
     * with the app host baked in) down to a path relative to the
     * "public" disk root, e.g. "clubs/pjr/logo.png".
     */
    public static function toRelativePath(?string $value): ?string
    {
        if (!$value) {
            return $value;
        }

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            $position = strpos($value, '/storage/');
            if ($position !== false) {
                return substr($value, $position + strlen('/storage/'));
            }
        }

        return $value;
    }
}

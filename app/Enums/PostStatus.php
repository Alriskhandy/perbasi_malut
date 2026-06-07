<?php


namespace App\Enums;

enum PostStatus : string
{
    case Draft = 'draft';
    case Published = 'published';
    case Trashed = 'trashed';

    public static function isPublished(self $status): bool
    {
        return $status === self::Published;
    }
    public static function isDraft(self $status): bool
    {
        return $status === self::Draft;
    }
}

<?php

namespace App\Filament\Resources\Generates\Actions;

class GenerateAction
{
    public static function getReviewId(string $prefix, string $separator, int $queue): ?string
    {
        if (! $prefix || ! $separator || ! $queue) {
            return null;
        }

        return $prefix.substr($separator, 0, 4).str_pad((string) $queue, 4, '0', STR_PAD_LEFT).substr($separator, 4, 2);
    }
}

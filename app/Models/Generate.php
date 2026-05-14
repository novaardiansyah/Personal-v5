<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'alias', 'prefix', 'suffix', 'separator', 'queue'])]
class Generate extends Model
{
    use SoftDeletes;

    public function getNextId(): string
    {
        return self::getPreviewId($this->alias, false);
    }

    public static function getPreviewId(?string $alias, bool $isIncrement = true): string
    {
        $generate = static::withTrashed()->where('alias', $alias)->first();
        $date = now()->translatedFormat('ymd');

        if (! $generate) {
            $queue = substr($date, 0, 4).substr((string) time(), -4).substr($date, 4, 2);

            return 'ER-'.$queue;
        }

        $separator = $generate->separator;
        $diffMonthAndYear = substr($date, 0, 4) !== substr($separator, 0, 4);
        $maxLimitQueue = 9999;

        if ((int) $generate->queue >= $maxLimitQueue || $diffMonthAndYear) {
            $generate->queue = 1;
            $generate->separator = $date;
        }

        $queue = substr($date, 0, 4).str_pad((string) $generate->queue, 4, '0', STR_PAD_LEFT).substr($date, 4, 2);

        if ($generate->prefix) {
            $queue = $generate->prefix.$queue;
        }

        if ($generate->suffix) {
            $queue .= $generate->suffix;
        }

        if ($isIncrement) {
            $generate->queue += 1;
            $generate->save();
        }

        return $queue;
    }
}

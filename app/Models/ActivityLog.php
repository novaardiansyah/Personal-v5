<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ActivityLog extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'prev_properties' => 'array',
        'properties' => 'array',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function causer(): MorphTo
    {
        return $this->morphTo();
    }

    public function getEventColor(string $event): string
    {
        return match ($event) {
            'Updated' => 'info',
            'Created' => 'success',
            'Deleted', 'Force Deleted' => 'danger',
            'Restored' => 'warning',
            'Login' => 'danger',
            default => 'primary',
        };
    }

    public function getLognameColor(string $logName): string
    {
        return match ($logName) {
            'Resource' => 'primary',
            'Notification' => 'success',
            'Console' => 'warning',
            default => 'primary',
        };
    }

    protected function propertiesStr(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->properties) {
                    return null;
                }

                $properties = $this->properties;

                return collect($properties)->mapWithKeys(function ($value, $key) {
                    $label = str_replace('_', ' ', $key);
                    $label = ucwords($label);

                    if (is_array($value)) {
                        $value = json_encode($value);
                    }

                    return [$label => $value];
                })->toArray();
            }
        );
    }

    protected function prevPropertiesStr(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->prev_properties) {
                    return null;
                }

                $properties = $this->prev_properties;

                return collect($properties)->mapWithKeys(function ($value, $key) {
                    $label = str_replace('_', ' ', $key);
                    $label = ucwords($label);

                    if (is_array($value)) {
                        $value = json_encode($value);
                    }

                    return [$label => $value];
                })->toArray();
            }
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\SettingObserver;

#[ObservedBy([SettingObserver::class])]
class Setting extends Model
{
	use SoftDeletes;

	protected $guarded = ['id'];

	protected $casts = [
		'has_options' => 'boolean',
		'options' => 'array',
	];
}

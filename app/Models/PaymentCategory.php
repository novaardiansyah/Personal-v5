<?php

namespace App\Models;

use App\Observers\PaymentCategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(PaymentCategoryObserver::class)]
class PaymentCategory extends Model
{
	use SoftDeletes;

	protected $fillable = ['name', 'user_id', 'code', 'is_default'];

	protected $casts = [
		'is_default' => 'boolean',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function payments(): HasMany
	{
		return $this->hasMany(Payment::class, 'category_id');
	}
}

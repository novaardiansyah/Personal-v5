<?php

namespace App\Models;

use App\Observers\PaymentTypeObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(PaymentTypeObserver::class)]
class PaymentType extends Model
{
	use SoftDeletes;

	protected $fillable = ['name', 'code'];

	public const EXPENSE = 1;
	public const INCOME = 2;
	public const TRANSFER = 3;
	public const WITHDRAWAL = 4;

	public function getPaymentTypeNameAttribute(): string
	{
		return $this->name ?? 'Unknown';
	}
}

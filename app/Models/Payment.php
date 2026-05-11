<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
	use SoftDeletes;

	protected $guarded = ['id'];

	protected $casts = [
		'attachments'  => 'array',
		'has_items'    => 'boolean',
		'is_scheduled' => 'boolean',
		'is_draft'     => 'boolean'
	];

	public function payment_account(): BelongsTo
	{
		return $this->belongsTo(PaymentAccount::class, 'payment_account_id');
	}

	public function payment_type(): BelongsTo
	{
		return $this->belongsTo(PaymentType::class, 'type_id');
	}

	public function category(): BelongsTo
	{
		return $this->belongsTo(PaymentCategory::class, 'category_id');
	}
}

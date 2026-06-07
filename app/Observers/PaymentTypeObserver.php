<?php

namespace App\Observers;

use App\Models\PaymentType;

class PaymentTypeObserver
{
	public function saving(PaymentType $paymentType): void
	{
		if (!$paymentType->code) {
			$paymentType->code = getCode('payment_type');
		}
	}

	public function created(PaymentType $paymentType): void
	{
		saveActivityLog([
			'event'       => 'Created',
			'description' => "Created payment type {$paymentType->name}",
		], $paymentType);
	}

	public function updated(PaymentType $paymentType): void
	{
		saveActivityLog([
			'event'       => 'Updated',
			'description' => "Updated payment type {$paymentType->name}",
		], $paymentType);
	}

	public function deleted(PaymentType $paymentType): void
	{
		saveActivityLog([
			'event'       => 'Deleted',
			'description' => "Deleted payment type {$paymentType->name}",
		], $paymentType);
	}

	public function restored(PaymentType $paymentType): void
	{
		saveActivityLog([
			'event'       => 'Restored',
			'description' => "Restored payment type {$paymentType->name}",
		], $paymentType);
	}

	public function forceDeleted(PaymentType $paymentType): void
	{
		saveActivityLog([
			'event'       => 'Force Deleted',
			'description' => "Force deleted payment type {$paymentType->name}",
		], $paymentType);
	}
}

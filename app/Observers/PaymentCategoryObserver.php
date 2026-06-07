<?php

namespace App\Observers;

use App\Models\PaymentCategory;

class PaymentCategoryObserver
{
	public function creating(PaymentCategory $paymentCategory): void
	{
		if (!$paymentCategory->user_id) {
			$paymentCategory->user_id = auth()->id();
		}

		if (!$paymentCategory->code) {
			$paymentCategory->code = getCode('payment_category');
		}
	}

	public function updating(PaymentCategory $paymentCategory): void
	{
		if (!$paymentCategory->code) {
			$paymentCategory->code = getCode('payment_category');
		}
	}

	public function created(PaymentCategory $paymentCategory): void
	{
		saveActivityLog([
			'event'       => 'Created',
			'description' => "Created payment category {$paymentCategory->name}",
		], $paymentCategory);
	}

	public function updated(PaymentCategory $paymentCategory): void
	{
		saveActivityLog([
			'event'       => 'Updated',
			'description' => "Updated payment category {$paymentCategory->name}",
		], $paymentCategory);
	}

	public function deleted(PaymentCategory $paymentCategory): void
	{
		saveActivityLog([
			'event'       => 'Deleted',
			'description' => "Deleted payment category {$paymentCategory->name}",
		], $paymentCategory);
	}

	public function restored(PaymentCategory $paymentCategory): void
	{
		saveActivityLog([
			'event'       => 'Restored',
			'description' => "Restored payment category {$paymentCategory->name}",
		], $paymentCategory);
	}

	public function forceDeleted(PaymentCategory $paymentCategory): void
	{
		saveActivityLog([
			'event'       => 'Force Deleted',
			'description' => "Force deleted payment category {$paymentCategory->name}",
		], $paymentCategory);
	}
}

<?php

/*
 * Project Name: personal-v5
 * File: PaymentAccountObserver.php
 * Created Date: May 11, 2026
 * 
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 * 
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Observers;

use App\Models\PaymentAccount;

class PaymentAccountObserver
{
	public function creating(PaymentAccount $paymentAccount): void
	{
		if (!$paymentAccount->user_id) {
			$paymentAccount->user_id = auth()->id();
		}
	}

	public function created(PaymentAccount $paymentAccount): void
	{
		saveActivityLog([
			'event'       => 'Created',
			'description' => "Created payment account {$paymentAccount->name}",
		], $paymentAccount);
	}

	public function updated(PaymentAccount $paymentAccount): void
	{
		saveActivityLog([
			'event'       => 'Updated',
			'description' => "Updated payment account {$paymentAccount->name}",
		], $paymentAccount);
	}

	public function deleted(PaymentAccount $paymentAccount): void
	{
		saveActivityLog([
			'event'       => 'Deleted',
			'description' => "Deleted payment account {$paymentAccount->name}",
		], $paymentAccount);
	}

	public function restored(PaymentAccount $paymentAccount): void
	{
		saveActivityLog([
			'event'       => 'Restored',
			'description' => "Restored payment account {$paymentAccount->name}",
		], $paymentAccount);
	}

	public function forceDeleted(PaymentAccount $paymentAccount): void
	{
		saveActivityLog([
			'event'       => 'Force Deleted',
			'description' => "Force deleted payment account {$paymentAccount->name}",
		], $paymentAccount);
	}
}

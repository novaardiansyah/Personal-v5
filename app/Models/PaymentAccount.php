<?php

/*
 * Project Name: personal-v5
 * File: PaymentAccount.php
 * Created Date: May 11, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Models;

use App\Observers\PaymentAccountObserver;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

#[Fillable(['user_id', 'name', 'code', 'deposit', 'logo'])]
#[Appends(['logo_url'])]
#[ObservedBy([PaymentAccountObserver::class])]
class PaymentAccount extends Model
{
	use SoftDeletes;

	public function getLogoUrlAttribute(): ?string
	{
		return $this->logo ? Storage::disk('public')->url($this->logo) : null;
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}

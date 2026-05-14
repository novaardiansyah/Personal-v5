<?php

/*
 * Project Name: personal-v5
 * File: Generate.php
 * Created Date: May 14, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Models;

use App\Observers\GenerateObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'alias', 'prefix', 'suffix', 'separator', 'queue'])]
#[ObservedBy([GenerateObserver::class])]
class Generate extends Model
{
	use SoftDeletes;

	public function getNextId(): string
	{
		return getCode($this->alias, false);
	}
}

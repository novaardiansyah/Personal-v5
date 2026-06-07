<?php

/*
 * Project Name: personal-v5
 * File: ItemType.php
 * Created Date: June 7, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Models;

use App\Observers\ItemTypeObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['code', 'name'])]
#[ObservedBy([ItemTypeObserver::class])]
class ItemType extends Model
{
	use SoftDeletes;
}

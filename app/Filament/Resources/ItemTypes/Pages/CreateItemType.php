<?php

/*
 * Project Name: personal-v5
 * File: CreateItemType.php
 * Created Date: June 7, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Filament\Resources\ItemTypes\Pages;

use App\Filament\Resources\ItemTypes\ItemTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateItemType extends CreateRecord
{
    protected static string $resource = ItemTypeResource::class;
}

<?php

/*
 * Project Name: personal-v5
 * File: ItemTypeForm.php
 * Created Date: June 7, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Filament\Resources\ItemTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ItemTypeForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextInput::make('code')
						->label(__('item_type.fields.code'))
						->disabled()
						->placeholder('Auto generated')
						->copyable(),

					TextInput::make('name')
						->label(__('item_type.fields.name'))
						->required(),
				])
					->columns(1),
			])
			->columns(1);
	}
}

<?php

/*
 * Project Name: personal-v5
 * File: ItemForm.php
 * Created Date: June 7, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Filament\Resources\Items\Schemas;

use App\Models\ItemType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ItemForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextInput::make('code')
						->label(__('item.fields.code'))
						->disabled()
						->placeholder('Auto generated')
						->copyable(),

					Select::make('type_id')
						->label(__('item.fields.type_id'))
						->options(ItemType::all()->pluck('name', 'id'))
						->searchable()
						->native(false),

					TextInput::make('name')
						->label(__('item.fields.name'))
						->required(),

					TextInput::make('amount')
						->label(__('item.fields.amount'))
						->numeric()
						->required()
						->default(0)
						->live(onBlur: true)
						->hint(fn ($state) => $state ? money((float) $state) : null),
				])
					->columns(1),
			])
			->columns(1);
	}
}

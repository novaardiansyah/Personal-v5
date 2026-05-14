<?php

/*
 * Project Name: personal-v5
 * File: GenerateForm.php
 * Created Date: May 14, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Filament\Resources\Generates\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GenerateForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextInput::make('prefix')
						->label(__('generate.fields.prefix'))
						->required()
						->maxLength(5),

					TextInput::make('separator')
						->label(__('generate.fields.separator'))
						->readOnly()
						->default(now()->format('ymd')),

					TextInput::make('queue')
						->label(__('generate.fields.queue'))
						->required()
						->numeric()
						->minValue(1)
						->default(1)
						->maxValue(999999),

					TextInput::make('next_id')
						->label(__('generate.fields.preview'))
						->disabled()
						->visibleOn('edit'),
				])
					->description(__('generate.descriptions.format_configuration'))
					->columns(2)
					->collapsible(),

				Section::make([
					TextInput::make('name')
						->label(__('generate.fields.name'))
						->required()
						->maxLength(255)
						->live(onBlur: true)
						->afterStateUpdated(fn($set, $get) => $set('alias', Str::slug($get('name'), '_'))),

					TextInput::make('alias')
						->label(__('generate.fields.alias'))
						->required()
						->maxLength(25)
						->readOnly()
						->unique(ignoreRecord: true),
				])
					->description(__('generate.descriptions.basic_information'))
					->columns(2)
					->collapsible(),
			]);
	}
}

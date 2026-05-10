<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SettingForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextInput::make('name')
						->label(__('setting.fields.name'))
						->required()
						->live(onBlur: true)
						->afterStateUpdated(function (Set $set, Get $get) {
							$name = $get('name') ?? '';
							$slug = Str::of($name)->slug('_');
							$set('key', $slug);
						}),

					TextInput::make('key')
						->label(__('setting.fields.key'))
						->required()
						->maxLength(255)
						->unique(ignoreRecord: true),

					Grid::make([
						'default' => 3,
					])
						->schema([
							TagsInput::make('options')
								->label(__('setting.fields.options'))
								->placeholder('Enter option values, separated by commas.')
								->separator(',')
								->visible(fn (Get $get) => $get('has_options'))
								->live(onBlur: true)
								->columnSpan(2),

							Toggle::make('has_options')
								->label(__('setting.fields.has_options'))
								->inline(false)
								->live(),
						]),
				])
					->columns(1),

				Section::make([
					Textarea::make('value')
						->label(__('setting.fields.value'))
						->required()
						->rows(3)
						->visible(fn (Get $get) => ! $get('has_options'))
						->maxLength(255),

					Select::make('value_option')
						->label(__('setting.fields.value_option'))
						->required()
						->visible(fn (Get $get) => $get('has_options'))
						->native(false)
						->searchable()
						->options(function (Get $get) {
							$options = $get('options') ?? [];

							return collect($options)->mapWithKeys(function ($option) {
								return [$option => $option];
							});
						}),

					Textarea::make('description')
						->label(__('setting.fields.description'))
						->maxLength(1000)
						->rows(4),
				]),
			])
			->columns(2);
	}
}

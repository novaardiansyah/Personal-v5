<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingInfolist
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextEntry::make('name')
						->label(__('setting.fields.name')),
					TextEntry::make('key')
						->label(__('setting.fields.key'))
						->badge()
						->copyable(),
					TextEntry::make('value')
						->label(__('setting.fields.value'))
						->badge(),
					IconEntry::make('has_options')
						->label(__('setting.fields.has_options'))
						->boolean(),
					TextEntry::make('description')
						->label(__('setting.fields.description'))
						->columnSpanFull(),
				])
					->description(__('general.labels.general_information'))
					->columns(2)
					->collapsible(),

				Section::make([
					TextEntry::make('deleted_at')
						->label(__('general.labels.deleted_at'))
						->dateTime(),
					TextEntry::make('created_at')
						->label(__('general.labels.created_at'))
						->dateTime(),
					TextEntry::make('updated_at')
						->label(__('general.labels.updated_at'))
						->dateTime()
						->sinceTooltip(),
				])
					->description(__('general.labels.timestamps_description'))
					->collapsible()
					->columns(3),
			])
			->columns(1);
	}
}

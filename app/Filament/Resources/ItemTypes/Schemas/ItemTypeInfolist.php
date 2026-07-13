<?php

/*
 * Project Name: personal-v5
 * File: ItemTypeInfolist.php
 * Created Date: June 7, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Filament\Resources\ItemTypes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ItemTypeInfolist
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextEntry::make('code')
						->label(__('item_type.fields.code'))
						->badge()
						->copyable(),
					TextEntry::make('name')
						->label(__('item_type.fields.name')),
				])
					->description(__('general.labels.general_information'))
					->columns(2)
					->collapsible(),

				Section::make([
					TextEntry::make('created_at')
						->label(__('general.labels.created_at'))
						->dateTime()
						->sinceTooltip(),
					TextEntry::make('updated_at')
						->label(__('general.labels.updated_at'))
						->dateTime()
						->sinceTooltip(),
					TextEntry::make('deleted_at')
						->label(__('general.labels.deleted_at'))
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

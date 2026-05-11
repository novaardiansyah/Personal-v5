<?php

/*
 * Project Name: personal-v5
 * File: PaymentAccountInfolist.php
 * Created Date: May 11, 2026
 * 
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 * 
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Filament\Resources\PaymentAccounts\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentAccountInfolist
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextEntry::make('name')
						->label(__('payment_account.fields.name')),
					TextEntry::make('deposit')
						->label(__('payment_account.fields.deposit'))
						->numeric(),
					ImageEntry::make('logo_url')
						->label(__('payment_account.fields.logo_url'))
						->checkFileExistence(false)
						->circular()
						->size(70),
				])
					->description(__('general.labels.general_information'))
					->columns(3)
					->collapsible(),

				Section::make([
					Grid::make(3)
						->columnSpanFull()
						->schema([
							TextEntry::make('created_at')
								->label(__('general.labels.created_at'))
								->dateTime(),
							TextEntry::make('updated_at')
								->label(__('general.labels.updated_at'))
								->dateTime()
								->sinceTooltip(),
							TextEntry::make('deleted_at')
								->label(__('general.labels.deleted_at'))
								->dateTime(),
						]),
				])
					->description(__('general.labels.timestamps_description'))
					->collapsible()
					->columns(3),
			])
			->columns(1);
	}
}

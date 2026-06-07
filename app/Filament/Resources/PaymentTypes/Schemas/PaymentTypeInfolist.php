<?php

namespace App\Filament\Resources\PaymentTypes\Schemas;

use App\Models\PaymentType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentTypeInfolist
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextEntry::make('code')
						->label(__('payment_type.fields.code'))
						->badge()
						->copyable(),
					TextEntry::make('name')
						->label(__('payment_type.fields.name')),
				])
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

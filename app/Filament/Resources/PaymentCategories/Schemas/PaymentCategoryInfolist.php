<?php

namespace App\Filament\Resources\PaymentCategories\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentCategoryInfolist
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextEntry::make('code')
						->label(__('payment_category.fields.code'))
						->badge()
						->copyable(),
					TextEntry::make('user.name')
						->label(__('payment_category.fields.user_id'))
						->placeholder('-'),
					TextEntry::make('name')
						->label(__('payment_category.fields.name')),
					IconEntry::make('is_default')
						->label(__('payment_category.fields.is_default'))
						->boolean(),
				])
					->description(__('general.labels.general_information'))
					->columns(4)
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
						->sinceTooltip()
						->placeholder('-'),
				])
					->description(__('general.labels.timestamps_description'))
					->collapsible()
					->columns(3),
			])
			->columns(1);
	}
}

<?php

namespace App\Filament\Resources\PaymentCategories\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentCategoryForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextInput::make('code')
						->label(__('payment_category.fields.code'))
						->disabled()
						->placeholder('Auto generated')
						->copyable(),

					Select::make('user_id')
						->label(__('payment_category.fields.user_id'))
						->relationship('user', 'name')
						->getOptionLabelFromRecordUsing(fn (User $record): string => $record->name . ' (' . $record->email . ')')
						->searchable()
						->preload()
						->native(false)
						->required()
						->default(auth()->id()),

					TextInput::make('name')
						->label(__('payment_category.fields.name'))
						->required()
						->maxLength(255),

					Toggle::make('is_default')
						->label(__('payment_category.fields.is_default'))
						->default(false),
				])
					->columns(1),
			])
			->columns(1);
	}
}

<?php

namespace App\Filament\Resources\PaymentTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentTypeForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextInput::make('code')
						->label(__('payment_type.fields.code'))
						->disabled()
						->placeholder('Auto generated')
						->copyable(),

					TextInput::make('uid')
						->label(__('payment_type.fields.uid'))
						->disabled()
						->placeholder('Auto generated')
						->copyable(),

					TextInput::make('name')
						->label(__('payment_type.fields.name'))
						->required(),
				])
					->columns(1),
			])
			->columns(1);
	}
}

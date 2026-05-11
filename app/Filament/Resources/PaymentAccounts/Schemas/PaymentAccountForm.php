<?php

namespace App\Filament\Resources\PaymentAccounts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentAccountForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextInput::make('name')
						->label(__('payment_account.fields.name'))
						->required(),

					FileUpload::make('logo')
						->label(__('payment_account.fields.logo'))
						->disk('public')
						->directory('images/payment_account')
						->image()
						->imageEditor(),
				])
					->columns(1),
			])
			->columns(1);
	}
}

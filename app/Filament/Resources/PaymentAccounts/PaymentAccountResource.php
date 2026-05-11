<?php

namespace App\Filament\Resources\PaymentAccounts;

use App\Filament\Resources\PaymentAccounts\Pages\CreatePaymentAccount;
use App\Filament\Resources\PaymentAccounts\Pages\EditPaymentAccount;
use App\Filament\Resources\PaymentAccounts\Pages\ListPaymentAccounts;
use App\Filament\Resources\PaymentAccounts\Pages\ViewPaymentAccount;
use App\Filament\Resources\PaymentAccounts\Schemas\PaymentAccountForm;
use App\Filament\Resources\PaymentAccounts\Schemas\PaymentAccountInfolist;
use App\Filament\Resources\PaymentAccounts\Tables\PaymentAccountsTable;
use App\Models\PaymentAccount;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentAccountResource extends Resource
{
	protected static ?string $model = PaymentAccount::class;

	protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;

	protected static ?int $navigationSort = 10;

	protected static ?string $recordTitleAttribute = 'name';

	public static function getNavigationGroup(): string
	{
		return __('general.navigation_groups.payments');
	}

	public static function getNavigationLabel(): string
	{
		return __('payment_account.plural_label');
	}

	public static function getModelLabel(): string
	{
		return __('payment_account.label');
	}

	public static function getPluralModelLabel(): string
	{
		return __('payment_account.plural_label');
	}

	public static function getBreadcrumb(): string
	{
		return __('payment_account.label');
	}

	public static function getEloquentQuery(): Builder
	{
		return parent::getEloquentQuery()->where('user_id', auth()->id());
	}

	public static function form(Schema $schema): Schema
	{
		return PaymentAccountForm::configure($schema);
	}

	public static function infolist(Schema $schema): Schema
	{
		return PaymentAccountInfolist::configure($schema);
	}

	public static function table(Table $table): Table
	{
		return PaymentAccountsTable::configure($table);
	}

	public static function getRelations(): array
	{
		return [];
	}

	public static function getPages(): array
	{
		return [
			'index' => ListPaymentAccounts::route('/'),
			'create' => CreatePaymentAccount::route('/create'),
			'view' => ViewPaymentAccount::route('/{record}'),
			'edit' => EditPaymentAccount::route('/{record}/edit'),
		];
	}

	public static function getRecordRouteBindingEloquentQuery(): Builder
	{
		return parent::getRecordRouteBindingEloquentQuery()
			->withoutGlobalScopes([
				SoftDeletingScope::class,
			]);
	}
}

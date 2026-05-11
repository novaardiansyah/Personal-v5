<?php

namespace App\Filament\Resources\PaymentTypes;

use App\Filament\Resources\PaymentTypes\Pages\CreatePaymentType;
use App\Filament\Resources\PaymentTypes\Pages\EditPaymentType;
use App\Filament\Resources\PaymentTypes\Pages\ListPaymentTypes;
use App\Filament\Resources\PaymentTypes\Pages\ViewPaymentType;
use App\Filament\Resources\PaymentTypes\Schemas\PaymentTypeForm;
use App\Filament\Resources\PaymentTypes\Schemas\PaymentTypeInfolist;
use App\Filament\Resources\PaymentTypes\Tables\PaymentTypesTable;
use App\Models\PaymentType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentTypeResource extends Resource
{
	protected static ?string $model = PaymentType::class;

	protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;

	protected static ?int $navigationSort = 100;

	protected static ?string $recordTitleAttribute = 'name';

	public static function getNavigationGroup(): string
	{
		return __('general.navigation_groups.payments');
	}

	public static function getNavigationLabel(): string
	{
		return __('payment_type.plural_label');
	}

	public static function getModelLabel(): string
	{
		return __('payment_type.label');
	}

	public static function getPluralModelLabel(): string
	{
		return __('payment_type.plural_label');
	}

	public static function getBreadcrumb(): string
	{
		return __('payment_type.label');
	}

	public static function form(Schema $schema): Schema
	{
		return PaymentTypeForm::configure($schema);
	}

	public static function infolist(Schema $schema): Schema
	{
		return PaymentTypeInfolist::configure($schema);
	}

	public static function table(Table $table): Table
	{
		return PaymentTypesTable::configure($table);
	}

	public static function getRelations(): array
	{
		return [];
	}

	public static function getPages(): array
	{
		return [
			'index' => ListPaymentTypes::route('/'),
			'create' => CreatePaymentType::route('/create'),
			'view' => ViewPaymentType::route('/{record}'),
			'edit' => EditPaymentType::route('/{record}/edit'),
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

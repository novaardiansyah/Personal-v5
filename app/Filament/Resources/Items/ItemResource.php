<?php

/*
 * Project Name: personal-v5
 * File: ItemResource.php
 * Created Date: June 7, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Filament\Resources\Items;

use App\Filament\Resources\Items\Pages\CreateItem;
use App\Filament\Resources\Items\Pages\EditItem;
use App\Filament\Resources\Items\Pages\ListItems;
use App\Filament\Resources\Items\Pages\ViewItem;
use App\Filament\Resources\Items\Schemas\ItemForm;
use App\Filament\Resources\Items\Schemas\ItemInfolist;
use App\Filament\Resources\Items\Tables\ItemsTable;
use App\Models\Item;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
	protected static ?string $model = Item::class;

	protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquare3Stack3d;

	protected static ?string $recordTitleAttribute = 'name';

	public static function getNavigationGroup(): string
	{
		return __('general.navigation_groups.items');
	}

	public static function getNavigationLabel(): string
	{
		return __('item.plural_label');
	}

	public static function getModelLabel(): string
	{
		return __('item.label');
	}

	public static function getPluralModelLabel(): string
	{
		return __('item.plural_label');
	}

	public static function getBreadcrumb(): string
	{
		return __('item.label');
	}

	public static function form(Schema $schema): Schema
	{
		return ItemForm::configure($schema);
	}

	public static function infolist(Schema $schema): Schema
	{
		return ItemInfolist::configure($schema);
	}

	public static function table(Table $table): Table
	{
		return ItemsTable::configure($table);
	}

	public static function getRelations(): array
	{
		return [];
	}

	public static function getPages(): array
	{
		return [
			'index' => ListItems::route('/'),
			'create' => CreateItem::route('/create'),
			'view' => ViewItem::route('/{record}'),
			'edit' => EditItem::route('/{record}/edit'),
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

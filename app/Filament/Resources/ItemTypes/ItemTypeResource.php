<?php

/*
 * Project Name: personal-v5
 * File: ItemTypeResource.php
 * Created Date: June 7, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Filament\Resources\ItemTypes;

use App\Filament\Resources\ItemTypes\Pages\CreateItemType;
use App\Filament\Resources\ItemTypes\Pages\EditItemType;
use App\Filament\Resources\ItemTypes\Pages\ListItemTypes;
use App\Filament\Resources\ItemTypes\Pages\ViewItemType;
use App\Filament\Resources\ItemTypes\Schemas\ItemTypeForm;
use App\Filament\Resources\ItemTypes\Schemas\ItemTypeInfolist;
use App\Filament\Resources\ItemTypes\Tables\ItemTypesTable;
use App\Models\ItemType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemTypeResource extends Resource
{
    protected static ?string $model = ItemType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;

    protected static ?string $recordTitleAttribute = 'name';

	public static function getNavigationGroup(): string
	{
		return __('general.navigation_groups.items');
	}

	public static function getNavigationLabel(): string
	{
		return __('item_type.plural_label');
	}

	public static function getModelLabel(): string
	{
		return __('item_type.label');
	}

	public static function getPluralModelLabel(): string
	{
		return __('item_type.plural_label');
	}

	public static function getBreadcrumb(): string
	{
		return __('item_type.label');
	}

    public static function form(Schema $schema): Schema
    {
        return ItemTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ItemTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItemTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListItemTypes::route('/'),
            'create' => CreateItemType::route('/create'),
            'view' => ViewItemType::route('/{record}'),
            'edit' => EditItemType::route('/{record}/edit'),
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

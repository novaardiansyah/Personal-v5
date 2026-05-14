<?php

namespace App\Filament\Resources\Generates\Schemas;

use App\Models\Generate;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GenerateInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextEntry::make('name')
                        ->label(__('generate.fields.name')),
                    TextEntry::make('alias')
                        ->label(__('generate.fields.alias'))
                        ->copyable()
                        ->badge()
                        ->color('info'),
                    TextEntry::make('prefix')
                        ->label(__('generate.fields.prefix'))
                        ->badge()
                        ->color('info'),
                    TextEntry::make('separator')
                        ->label(__('generate.fields.separator'))
                        ->badge()
                        ->color('info'),
                    TextEntry::make('queue')
                        ->label(__('generate.fields.queue'))
                        ->badge()
                        ->color('info')
                        ->numeric(),
                    TextEntry::make('preview')
                        ->label(__('generate.fields.preview'))
                        ->copyable()
                        ->badge()
                        ->color('info')
                        ->state(fn (Generate $record) => $record->getNextId()),
                ])
                    ->description(__('generate.descriptions.detail_information'))
                    ->columns(3)
                    ->columnSpan(2)
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
            ->columns(3);
    }
}

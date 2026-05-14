<?php

namespace App\Filament\Resources\Generates\Schemas;

use App\Filament\Resources\Generates\Actions\GenerateAction;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GenerateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('prefix')
                        ->label(__('generate.fields.prefix'))
                        ->required()
                        ->maxLength(5)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (callable $set, callable $get) => self::handleReviewId($set, $get)),
                    TextInput::make('separator')
                        ->label(__('generate.fields.separator'))
                        ->readOnly()
                        ->default(now()->format('ymd')),
                    TextInput::make('queue')
                        ->label(__('generate.fields.queue'))
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->default(1)
                        ->maxValue(999999)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (callable $set, callable $get) => self::handleReviewId($set, $get)),
                    TextInput::make('next_id')
                        ->label(__('generate.fields.preview'))
                        ->disabled(),
                ])
                    ->description(__('generate.descriptions.format_configuration'))
                    ->columns(2)
                    ->collapsible(),

                Section::make([
                    TextInput::make('name')
                        ->label(__('generate.fields.name'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (callable $set, callable $get) => self::handleAlias($set, $get)),
                    TextInput::make('alias')
                        ->label(__('generate.fields.alias'))
                        ->required()
                        ->maxLength(25),
                ])
                    ->description(__('generate.descriptions.basic_information'))
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function handleReviewId(callable $set, callable $get): void
    {
        $prefix = $get('prefix');
        $separator = $get('separator');
        $queue = $get('queue');

        $result = GenerateAction::getReviewId($prefix, $separator, $queue);

        if ($result) {
            $set('next_id', $result);
        }
    }

    public static function handleAlias(callable $set, callable $get): void
    {
        $name = $get('name');

        if ($name) {
            $set('alias', str()->slug($name, '_'));
        }
    }
}

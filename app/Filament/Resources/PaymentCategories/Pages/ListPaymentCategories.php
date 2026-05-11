<?php

namespace App\Filament\Resources\PaymentCategories\Pages;

use App\Filament\Resources\PaymentCategories\PaymentCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPaymentCategories extends ListRecords
{
    protected static string $resource = PaymentCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

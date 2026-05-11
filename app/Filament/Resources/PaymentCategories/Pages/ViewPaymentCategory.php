<?php

namespace App\Filament\Resources\PaymentCategories\Pages;

use App\Filament\Resources\PaymentCategories\PaymentCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPaymentCategory extends ViewRecord
{
    protected static string $resource = PaymentCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

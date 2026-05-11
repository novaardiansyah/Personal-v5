<?php

namespace App\Filament\Resources\PaymentCategories\Pages;

use App\Filament\Resources\PaymentCategories\PaymentCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentCategory extends CreateRecord
{
    protected static string $resource = PaymentCategoryResource::class;
}

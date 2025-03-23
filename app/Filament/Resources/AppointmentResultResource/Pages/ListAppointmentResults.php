<?php

namespace App\Filament\Resources\AppointmentResultResource\Pages;

use App\Filament\Resources\AppointmentResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppointmentResults extends ListRecords
{
    protected static string $resource = AppointmentResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

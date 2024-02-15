<?php

namespace App\Filament\Resources\ParticipateResource\Pages;

use App\Filament\Resources\ParticipateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParticipates extends ListRecords
{
    protected static string $resource = ParticipateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ParticipateResource\Pages;

use App\Filament\Resources\ParticipateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParticipate extends EditRecord
{
    protected static string $resource = ParticipateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

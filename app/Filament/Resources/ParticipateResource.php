<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParticipateResource\Pages;
use App\Filament\Resources\ParticipateResource\RelationManagers;
use App\Models\Participants;
use App\Models\Participate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParticipateResource extends Resource
{
    protected static ?string $model = Participants::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('is_admin')
                    ->label('Administrateur'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event.title')
                    ->label('Event')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_admin')
                    ->label('Administrateur')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListParticipates::route('/'),
            'create' => Pages\CreateParticipate::route('/create'),
            'edit' => Pages\EditParticipate::route('/{record}/edit'),
        ];
    }
}

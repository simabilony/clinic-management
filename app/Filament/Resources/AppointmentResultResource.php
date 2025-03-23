<?php
namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResultResource\Pages;
use App\Models\AppointmentResult;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class AppointmentResultResource extends Resource
{
    protected static ?string $model = AppointmentResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('appointment_id')
                    ->relationship('appointment', 'id')
                    ->required(),
                Forms\Components\Textarea::make('drugs'),
                Forms\Components\Textarea::make('medical_tests'),
                Forms\Components\Textarea::make('medical_images'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('appointment.id'),
                Tables\Columns\TextColumn::make('drugs'),
                Tables\Columns\TextColumn::make('medical_tests'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointmentResults::route('/'),
            'create' => Pages\CreateAppointmentResult::route('/create'),
            'edit' => Pages\EditAppointmentResult::route('/{record}/edit'),
        ];
    }
}

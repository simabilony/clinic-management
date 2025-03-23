<?php
namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('specialization_id')
                    ->relationship('specialization', 'name')
                    ->required(),
                Forms\Components\Textarea::make('bio'),
                Forms\Components\TextInput::make('cost')->numeric()->required(),
                Forms\Components\TextInput::make('experience')->numeric()->required(),
                Forms\Components\TextInput::make('work_days')->required(),
                Forms\Components\TimePicker::make('start_time')->required(),
                Forms\Components\TimePicker::make('end_time')->required(),
                Forms\Components\TextInput::make('instagram'),
                Forms\Components\TextInput::make('whatsapp'),
                Forms\Components\TextInput::make('facebook'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('specialization.name'),
                Tables\Columns\TextColumn::make('cost'),
                Tables\Columns\TextColumn::make('experience'),
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
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}

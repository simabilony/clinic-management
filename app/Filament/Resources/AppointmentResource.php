<?php
namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Notifications\AppointmentReminder;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('doctor_id')
                    ->relationship('doctor', 'user.name')
                    ->required(),
                Forms\Components\DatePicker::make('date')->required(),
                Forms\Components\TimePicker::make('time')->required(),
                Forms\Components\Select::make('status')
                    ->options(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'cancelled' => 'Cancelled'])
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('doctor.user.name'),
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\TextColumn::make('status'),
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
    public static function create(array $data): void
    {
        $appointment = Appointment::create($data);

        // إرسال إشعار للمريض
        $appointment->user->notify(new AppointmentReminder($appointment));

        // إرسال إشعار للطبيب
        $appointment->doctor->user->notify(new AppointmentReminder($appointment));
    }
}

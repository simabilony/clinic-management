<?php
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            BaseWidget\Stat::make('Total Users', User::count()),
            BaseWidget\Stat::make('Total Doctors', Doctor::count()),
            BaseWidget\Stat::make('Total Appointments', Appointment::count()),
        ];
    }
}

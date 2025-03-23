<?php
namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('Clinic Management')
                    ->items([
                        NavigationItem::make('Calculus')
                            ->url(fn () => Calendar::getUrl())
                            ->icon('heroicon-o-calendar'),
                    ]),
            ]);
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Validator::extend('date_range_format', function ($attribute, $value, $parameters, $validator) {
            $format = 'Y-m-d - Y-m-d'; // Sesuaikan dengan format yang Anda inginkan
        
            $dateParts = explode(' - ', $value);
            if (count($dateParts) !== 2) {
                return false;
            }
        
            $startDate = \DateTime::createFromFormat('Y-m-d', $dateParts[0]);
            $endDate = \DateTime::createFromFormat('Y-m-d', $dateParts[1]);
        
            return $startDate && $endDate && $startDate <= $endDate;
        });
    }
}

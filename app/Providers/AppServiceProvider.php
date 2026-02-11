<?php

namespace App\Providers;

use App\Domain\AppointmentRepository;
use App\Domain\AppointmentRequest\AppointmentRequestRepository;
use App\Domain\Doctor\DoctorRepository;
use App\Infrastructure\AppointmentEloquentRepository;
use App\Infrastructure\AppointmentRequestEloquentRepository;
use App\Infrastructure\DoctorEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AppointmentRequestRepository::class,
            AppointmentRequestEloquentRepository::class
        );
        $this->app->bind(
            DoctorRepository::class,
            DoctorEloquentRepository::class
        );
        $this->app->bind(
            AppointmentRepository::class,
            AppointmentEloquentRepository::class
        );


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
<?php

namespace App\Providers;

use App\Contracts\Repositories\ActorRepository as ActorRepositoryContract;
use App\Contracts\Repositories\CinemaRepository as CinemaRepositoryContract;
use App\Contracts\Repositories\DirectorRepository as DirectorRepositoryContract;
use App\Contracts\Repositories\GenreRepository as GenreRepositoryContract;
use App\Contracts\Repositories\HallRepository as HallRepositoryContract;
use App\Contracts\Repositories\MovieRepository as MovieRepositoryContract;
use App\Contracts\Repositories\ScreeningRepository as ScreeningRepositoryContract;
use App\Contracts\Repositories\TicketRepository as TicketRepositoryContract;
use App\Contracts\Repositories\UserRepository as UserRepositoryContract;
use App\Contracts\Services\ActorService as ActorServiceContract;
use App\Contracts\Services\Auth\JwtServiceContract;
use App\Contracts\Services\CinemaService as CinemaServiceContract;
use App\Contracts\Services\DirectorService as DirectorServiceContract;
use App\Contracts\Services\GenreService as GenreServiceContract;
use App\Contracts\Services\HallService as HallServiceContract;
use App\Contracts\Services\MovieService as MovieServiceContract;
use App\Contracts\Services\ScreeningService as ScreeningServiceContract;
use App\Contracts\Services\TicketService as TicketServiceContract;
use App\Contracts\Services\UserService as UserServiceContract;
use App\Repositories\ActorRepository;
use App\Repositories\CinemaRepository;
use App\Repositories\DirectorRepository;
use App\Repositories\GenreRepository;
use App\Repositories\HallRepository;
use App\Repositories\MovieRepository;
use App\Repositories\ScreeningRepository;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;
use App\Services\ActorService;
use App\Services\Auth\JwtService;
use App\Services\CinemaService;
use App\Services\DirectorService;
use App\Services\GenreService;
use App\Services\HallService;
use App\Services\MovieService;
use App\Services\ScreeningService;
use App\Services\TicketService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    public function boot(): void
    {
        //
    }

    private function registerRepositories(): void
    {
        $this->app->bind(
            CinemaRepositoryContract::class,
            CinemaRepository::class
        );

        $this->app->bind(
            ActorRepositoryContract::class,
            ActorRepository::class
        );

        $this->app->bind(
            DirectorRepositoryContract::class,
            DirectorRepository::class
        );

        $this->app->bind(
            GenreRepositoryContract::class,
            GenreRepository::class
        );

        $this->app->bind(
            HallRepositoryContract::class,
            HallRepository::class
        );

        $this->app->bind(
            MovieRepositoryContract::class,
            MovieRepository::class
        );

        $this->app->bind(
            ScreeningRepositoryContract::class,
            ScreeningRepository::class
        );

        $this->app->bind(
            TicketRepositoryContract::class,
            TicketRepository::class
        );

        $this->app->bind(
            UserRepositoryContract::class,
            UserRepository::class
        );
    }

    private function registerServices(): void
    {
        $this->app->bind(
            ActorServiceContract::class,
            ActorService::class
        );

        $this->app->bind(
            CinemaServiceContract::class,
            CinemaService::class
        );

        $this->app->bind(
            DirectorServiceContract::class,
            DirectorService::class
        );

        $this->app->bind(
            GenreServiceContract::class,
            GenreService::class
        );

        $this->app->bind(
            HallServiceContract::class,
            HallService::class
        );

        $this->app->bind(
            MovieServiceContract::class,
            MovieService::class
        );

        $this->app->bind(
            ScreeningServiceContract::class,
            ScreeningService::class
        );

        $this->app->bind(
            TicketServiceContract::class,
            TicketService::class
        );

        $this->app->bind(
            UserServiceContract::class,
            UserService::class
        );

        $this->app->bind(
            JwtServiceContract::class,
            JwtService::class
        );
    }
}

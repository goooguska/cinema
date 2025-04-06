<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\ActorResource;
use App\MoonShine\Resources\CinemaResource;
use App\MoonShine\Resources\CountryResource;
use App\MoonShine\Resources\DirectorResource;
use App\MoonShine\Resources\GenreResource;
use App\MoonShine\Resources\HallResource;
use App\MoonShine\Resources\MovieResource;
use App\MoonShine\Resources\RoleResource;
use App\MoonShine\Resources\ScreeningResource;
use App\MoonShine\Resources\TicketResource;
use App\MoonShine\Resources\UserResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        // $config->authEnable();

        $core
            ->resources([
                ActorResource::class,
                CinemaResource::class,
                CountryResource::class,
                DirectorResource::class,
                GenreResource::class,
                HallResource::class,
                MovieResource::class,
                RoleResource::class,
                ScreeningResource::class,
                TicketResource::class,
                UserResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}

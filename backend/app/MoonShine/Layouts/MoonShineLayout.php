<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\CompactLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\UI\Components\{Breadcrumbs,
    Components,
    Layout\Flash,
    Layout\Div,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Footer,
    Layout\Head,
    Layout\Favicon,
    Layout\Assets,
    Layout\Meta,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\TopBar,
    Layout\Wrapper,
    When};
use App\MoonShine\Resources\ActorResource;
use MoonShine\MenuManager\MenuItem;
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

final class MoonShineLayout extends CompactLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            MenuItem::make('Actors', ActorResource::class),
            MenuItem::make('Cinemas', CinemaResource::class),
            MenuItem::make('Countries', CountryResource::class),
            MenuItem::make('Directors', DirectorResource::class),
            MenuItem::make('Genres', GenreResource::class),
            MenuItem::make('Halls', HallResource::class),
            MenuItem::make('Movies', MovieResource::class),
            MenuItem::make('Roles', RoleResource::class),
            MenuItem::make('Screenings', ScreeningResource::class),
            MenuItem::make('Tickets', TicketResource::class),
            MenuItem::make('Users', UserResource::class),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    public function build(): Layout
    {
        return parent::build();
    }
}

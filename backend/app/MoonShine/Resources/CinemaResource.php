<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cinema;
use App\MoonShine\Pages\Cinema\CinemaIndexPage;
use App\MoonShine\Pages\Cinema\CinemaFormPage;
use App\MoonShine\Pages\Cinema\CinemaDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Cinema, CinemaIndexPage, CinemaFormPage, CinemaDetailPage>
 */
class CinemaResource extends ModelResource
{
    protected string $model = Cinema::class;

    protected string $title = 'Cinemas';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected int $itemsPerPage = 10;

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            CinemaIndexPage::class,
            CinemaFormPage::class,
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Text::make('name'),
            Text::make('address'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('name'),
                Text::make('address'),
            ]),
        ];
    }

    /**
     * @param Cinema $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

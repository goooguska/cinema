<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\MoonShine\Pages\Country\CountryIndexPage;
use App\MoonShine\Pages\Country\CountryFormPage;
use App\MoonShine\Pages\Country\CountryDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Country, CountryIndexPage, CountryFormPage, CountryDetailPage>
 */
class CountryResource extends ModelResource
{
    protected string $model = Country::class;

    protected string $title = 'Countries';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected int $itemsPerPage = 10;

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            CountryIndexPage::class,
            CountryFormPage::class,
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Text::make('name'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('name'),
            ]),
        ];
    }

    /**
     * @param Country $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

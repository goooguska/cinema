<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Screening;
use App\MoonShine\Pages\Screening\ScreeningIndexPage;
use App\MoonShine\Pages\Screening\ScreeningFormPage;
use App\MoonShine\Pages\Screening\ScreeningDetailPage;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Screening, ScreeningIndexPage, ScreeningFormPage, ScreeningDetailPage>
 */
class ScreeningResource extends ModelResource
{
    protected string $model = Screening::class;

    protected string $title = 'Screenings';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected int $itemsPerPage = 10;

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            ScreeningIndexPage::class,
            ScreeningFormPage::class,
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Number::make('price'),
            BelongsTo::make('Hall', 'hall', fn($item) => "Зал $item->number"),
            BelongsTo::make('Movie', 'Movie', fn($item) => $item->title ?? 'Нет названия')
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Number::make('price'),
                BelongsTo::make('Hall', 'hall', fn($item) => "Зал $item->number"),
                BelongsTo::make('Movie', 'Movie', fn($item) => $item->title ?? 'Нет названия')
            ]),
        ];
    }

    /**
     * @param Screening $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hall;
use App\MoonShine\Pages\Hall\HallIndexPage;
use App\MoonShine\Pages\Hall\HallFormPage;
use App\MoonShine\Pages\Hall\HallDetailPage;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Hall, HallIndexPage, HallFormPage, HallDetailPage>
 */
class HallResource extends ModelResource
{
    protected string $model = Hall::class;

    protected string $title = 'Halls';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected int $itemsPerPage = 10;

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            HallIndexPage::class,
            HallFormPage::class,
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Number::make('number', formatted: fn($item) => "Зал $item->number"),
            Number::make('capacity'),
            BelongsTo::make('Cinema', 'cinema', fn($item) => $item->name)
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Number::make('number', formatted: fn($item) => "Зал $item->number"),
                Number::make('capacity'),
                BelongsTo::make('Cinema', 'cinema', fn($item) => $item->name)
            ]),
        ];
    }

    /**
     * @param Hall $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

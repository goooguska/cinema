<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
use App\MoonShine\Pages\Movie\MovieIndexPage;
use App\MoonShine\Pages\Movie\MovieFormPage;
use App\MoonShine\Pages\Movie\MovieDetailPage;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Movie, MovieIndexPage, MovieFormPage, MovieDetailPage>
 */
class MovieResource extends ModelResource
{
    protected string $model = Movie::class;

    protected string $title = 'Movies';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected int $itemsPerPage = 10;

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            MovieIndexPage::class,
            MovieFormPage::class,
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Text::make('title', formatted: fn($item) => $item->title ?? 'Нет названия'),
            Text::make('description', formatted: fn($item) => $item->description ?? 'Нет описания'),
            Number::make('duration', formatted: fn($item) => $item->duration ?? 'Нет длительности'),
            Image::make('poster_url'),
            Number::make('year'),
            Number::make('kp_id'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('title'),
                Text::make('description'),
                Number::make('duration'),
                Image::make('poster_url'),
                Number::make('year'),
                Number::make('kp_id'),
            ]),
        ];
    }
    /**
     * @param Movie $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

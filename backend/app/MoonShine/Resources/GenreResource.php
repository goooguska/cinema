<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use App\MoonShine\Pages\Genre\GenreIndexPage;
use App\MoonShine\Pages\Genre\GenreFormPage;
use App\MoonShine\Pages\Genre\GenreDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use PhpParser\Node\Stmt\Block;

/**
 * @extends ModelResource<Genre, GenreIndexPage, GenreFormPage, GenreDetailPage>
 */
class GenreResource extends ModelResource
{
    protected string $model = Genre::class;

    protected string $title = 'Genres';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected int $itemsPerPage = 10;

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            GenreIndexPage::class,
            GenreFormPage::class,
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
     * @param Genre $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

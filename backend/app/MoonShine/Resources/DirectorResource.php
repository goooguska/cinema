<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Director;
use App\MoonShine\Pages\Director\DirectorIndexPage;
use App\MoonShine\Pages\Director\DirectorFormPage;
use App\MoonShine\Pages\Director\DirectorDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Director, DirectorIndexPage, DirectorFormPage, DirectorDetailPage>
 */
class DirectorResource extends ModelResource
{
    protected string $model = Director::class;

    protected string $title = 'Directors';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected int $itemsPerPage = 10;

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            DirectorIndexPage::class,
            DirectorFormPage::class,
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
     * @param Director $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

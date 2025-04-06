<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Actor;
use App\MoonShine\Pages\Actor\ActorIndexPage;
use App\MoonShine\Pages\Actor\ActorFormPage;
use App\MoonShine\Pages\Actor\ActorDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use PhpParser\Node\Stmt\Block;

/**
 * @extends ModelResource<Actor, ActorIndexPage, ActorFormPage, ActorDetailPage>
 */
class ActorResource extends ModelResource
{
    protected string $model = Actor::class;

    protected string $title = 'Actors';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected int $itemsPerPage = 10;

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            ActorIndexPage::class,
            ActorFormPage::class,
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
     * @param Actor $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

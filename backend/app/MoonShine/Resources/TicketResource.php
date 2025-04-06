<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;
use App\MoonShine\Pages\Ticket\TicketIndexPage;
use App\MoonShine\Pages\Ticket\TicketFormPage;
use App\MoonShine\Pages\Ticket\TicketDetailPage;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Enums\SortDirection;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Ticket, TicketIndexPage, TicketFormPage, TicketDetailPage>
 */
class TicketResource extends ModelResource
{
    protected string $model = Ticket::class;

    protected string $title = 'Tickets';

    protected SortDirection $sortDirection = SortDirection::ASC;

    protected int $itemsPerPage = 10;

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            TicketIndexPage::class,
            TicketFormPage::class,
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Number::make('seat_number'),
            Text::make('status'),
            BelongsTo::make('Screening', 'screening'),
            BelongsTo::make('User', 'user', fn($item) => $item->name),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Number::make('seat_number'),
                Text::make('status'),
                BelongsTo::make('Screening', 'screening'),
                BelongsTo::make('User', 'user', fn($item) => $item->name),
            ]),
        ];
    }

    /**
     * @param Ticket $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}

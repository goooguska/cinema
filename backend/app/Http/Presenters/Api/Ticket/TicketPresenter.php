<?php

namespace App\Http\Presenters\Api\Ticket;

class TicketPresenter
{
    public function __construct(private readonly array $tickets) {}

    public static function make(array $tickets): array
    {
        return (new self($tickets))->present();
    }

    public function present(): array
    {
        return $this->tickets;
    }
}

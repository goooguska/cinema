<?php

namespace App\Http\Presenters\Api\Movie;

class MoviePresenter
{
    public function __construct(private readonly array $movie) {}

    public static function make(array $movie): array
    {
        return (new self($movie))->present();
    }

    private function present(): array
    {
        return [
            'id' => $this->movie['id'],
            'title' => $this->movie['title'] ?? 'Без названия',
            'description' => $this->movie['description'] ?? 'Без описания',
            'duration' => $this->movie['duration'],
            'poster_url' => $this->movie['poster_url'],
            'year' => $this->movie['year'],
            'actors' => $this->presentList('actors'),
            'directors' => $this->presentList('directors'),
            'genres' => $this->presentNames('genres'),
            'countries' => $this->presentNames('countries'),
            'screenings' => $this->presentScreenings(),
        ];
    }

    private function presentList(string $key): array
    {
        return $this->movie[$key] ?? [];
    }

    private function presentNames(string $key): array
    {
        return array_map(fn ($item) => mb_ucfirst($item['name']), $this->movie[$key]);
    }

    private function presentScreenings(): array
    {
        return array_map(
            fn($screening) => [
                'id' => $screening['id'],
                'start_time' => $screening['start_time'],
                'end_time' => $screening['end_time'],
                'hall' => $this->formatHall($screening['hall'] ?? []),
                'cinema' => $this->formatCinema($screening['hall']['cinema'] ?? []),
                'price' => $screening['price'] ?? 0,
            ],
            $this->movie['screenings'] ?? []
        );
    }

    private function formatHall(array $hall): array
    {
        return [
            'number' => $hall['number'] ?? 0,
            'capacity' => $hall['capacity'] ?? 0,
        ];
    }

    private function formatCinema(array $cinema): array
    {
        return [
            'id' => $cinema['id'],
            'name' => $cinema['name'] ?? 'Неизвестный кинотеатр',
            'address' => $this->formatAddress($cinema['address'] ?? ''),
        ];
    }

    private function formatAddress(string $address): string
    {
        return trim(preg_replace('/\s+/', ' ', $address));
    }
}

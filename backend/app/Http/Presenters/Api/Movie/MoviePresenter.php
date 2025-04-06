<?php

namespace App\Http\Presenters\Api\Movie;

class MoviePresenter
{
    public function __construct(private readonly array $movies) {}

    public static function make(array $movies): array
    {
        return (new self($movies))->present();
    }

    private function present(): array
    {

        return array_map(function ($movie) {
            return [
                'id' => $movie['id'],
                'title' => $movie['title'] ?? 'Без названия',
                'description' => $movie['description'] ?? 'Без описания',
                'duration' => $movie['duration'],
                'poster_url' => $movie['poster_url'],
                'year' => $movie['year'],
                'actors' => $this->presentList($movie, 'actors'),
                'directors' => $this->presentList($movie, 'directors'),
                'genres' => $this->presentNames($movie, 'genres'),
                'countries' => $this->presentNames($movie, 'countries'),
                'screenings' => $this->presentScreenings($movie),
            ];
        }, $this->movies);
    }

    private function presentList(array $movie, string $key): array
    {
        return $movie[$key] ?? [];
    }

    private function presentNames(array $movie, string $key): array
    {
        return array_map(
            fn ($item) => mb_ucfirst($item['name']),
            $movie[$key] ?? []
        );
    }

    private function presentScreenings(array $movie): array
    {
        return array_map(
            fn($screening) => [
                'id' => $screening['id'],
                'start_time' => $screening['start_time'],
                'end_time' => $screening['end_time'],
                'hall' => $this->formatHall($screening['hall'] ?? []),
                'cinema' => $this->formatCinema($screening['hall']['cinema'] ?? []),
                'price' => intval($screening['price']) ?? 0,
            ],
            $movie['screenings'] ?? []
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
            'id' => $cinema['id'] ?? 0,
            'name' => $cinema['name'] ?? 'Неизвестный кинотеатр',
            'address' => $this->formatAddress($cinema['address'] ?? ''),
        ];
    }

    private function formatAddress(string $address): string
    {
        return trim(preg_replace('/\s+/', ' ', $address));
    }
}

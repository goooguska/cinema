<?php

namespace App\Repositories;

use App\Contracts\Repositories\MovieRepository as MovieRepositoryContract;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @template TModel of Model
 */
class MovieRepository extends BaseRepository implements MovieRepositoryContract
{
    public function __construct(Movie $model)
    {
        parent::__construct($model);
    }

    public function getMovies(): Collection
    {
        return $this->getModel()
            ->with('genres')
            ->get();
    }

    public function getDailyMovies(string $date): Collection
    {
        return $this->getModel()->newQuery()
            ->whereHas('screenings', function ($query) use ($date) {
                $query->whereDate('start_time', $date);
            })
            ->with(['screenings' => function ($query) use ($date) {
                $query->whereDate('start_time', $date)
                    ->orderBy('start_time');
            }])
            ->with([
                'actors',
                'directors',
                'genres',
                'countries',
            ])
            ->get();
    }

    /**
     * @return TModel
     */
    public function findMovieById(int $id): ?Movie
    {
        return $this->getModel()
            ->with([
                'actors',
                'directors',
                'genres',
                'countries',
                'screenings.hall.cinema'
            ])
            ->find($id);
    }
}

<?php

namespace App\Http\Controllers\Api\Movie;

use App\Contracts\Services\MovieService;
use App\Http\Controllers\Controller;
use App\Http\Presenters\Api\Movie\MoviePresenter;
use App\Http\Requests\Movie\DailyMovieRequest;

class ListController extends Controller
{
    public function __construct(private readonly MovieService $movieService) {}

    public function allMovies()
    {
        return $this->movieService->getMovies();
    }

    public function getDailyMovies(DailyMovieRequest $request)
    {
        $date = $request->input('date');

        $movies = $this->movieService->getDailyMovies($date)?->toArray();

        return MoviePresenter::make($movies);
    }

}

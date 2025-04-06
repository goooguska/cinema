<?php

namespace App\Http\Controllers\Api\Movie;

use App\Contracts\Services\MovieService;
use App\Http\Controllers\Controller;
use App\Http\Presenters\Api\Movie\MoviePresenter;
use Illuminate\Http\JsonResponse;

class DetailController extends Controller
{
    public function __construct(private readonly MovieService $movieService) {}

    public function getMovie(int $movieId)
    {
        $movie = $this->movieService->getMovieById($movieId);

        if (empty($movie)) {
            return new JsonResponse(['message' => 'Не найдено'], 404);
        }

        return MoviePresenter::make([$movie->toArray()]);
    }
}

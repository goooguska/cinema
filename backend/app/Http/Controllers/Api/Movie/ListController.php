<?php

namespace App\Http\Controllers\Api\Movie;

use App\Contracts\Services\MovieService;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function __construct(private readonly MovieService $movieService) {}

    public function allMovies()
    {
        return $this->movieService->getMovies();
    }
}

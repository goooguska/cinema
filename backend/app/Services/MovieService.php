<?php

namespace App\Services;

use App\Contracts\Repositories\MovieRepository;
use App\Contracts\Services\MovieService as MovieServiceContract;
use App\Http\Clients\MovieApiClient;
use App\Models\Movie;
use Illuminate\Support\Collection;

class MovieService implements MovieServiceContract
{
    public function __construct(
        private readonly MovieRepository $movieRepository,
        private readonly MovieApiClient $movieApiClient,
    ) {}

    public function getMovies(): Collection
    {
       return $this->movieRepository->getMovies();
    }

    public function getMovieById(int $id): array
    {
        return $this->movieRepository->findMovieById($id)->toArray();
    }

    public function fetchMovies(int $page = 1, int $limit = 50): array
    {
        return $this->movieApiClient->fetchMovies($page, $limit);
    }

    public function createMovie(array $fields): Movie
    {
        return $this->movieRepository->create($fields);
    }

    public function updateOrCreate(array $fields, array $values = [])
    {
        return $this->movieRepository->updateOrCreate($fields, $values);
    }

    public function prepareMovieData(array $movieData): array
    {
        return [
            'title' => $movieData['name'] ?? null,
            'description' => $movieData['description'] ?? null,
            'duration' => $movieData['movieLength'] ?? null,
            'year' => $movieData['year'] ?? null,
            'poster_url' => $movieData['poster']['url'] ?? null,
            'kp_id' => $movieData['id'] ?? null,
        ];
    }

    public function addGenres(Movie $movie, array $genreIds): void
    {
        $movie->genres()->sync($genreIds);
    }

    public function addDirectors(Movie $movie, array $directorIds): void
    {
        $movie->directors()->sync($directorIds);
    }

    public function addActors(Movie $movie, array $actorIds): void
    {
        $movie->actors()->sync($actorIds);
    }

    public function addCountries(Movie $movie, array $countryIds): void
    {
        $movie->countries()->sync($countryIds);
    }
}

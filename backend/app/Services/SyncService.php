<?php

namespace App\Services;

use App\Contracts\Services\CountryService;
use App\Contracts\Services\GenreService;
use App\Contracts\Services\MovieService;
use App\Contracts\Services\ActorService;
use App\Contracts\Services\DirectorService;
use App\Contracts\Services\SyncService as SyncServiceContract;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncService implements SyncServiceContract
{
    public function __construct(
        private readonly MovieService $movieService,
        private readonly GenreService $genreService,
        private readonly ActorService $actorService,
        private readonly DirectorService $directorService,
        private readonly CountryService $countryService,
    ){}

    public function syncMovie(Movie $movie, array $data): bool
    {
        try {
            DB::beginTransaction();

            $movieAttributes = [
                'genreIds' => $this->processGenres($data['genres'] ?? []),
                'actorIds' => $this->processActors($data['actors'] ?? []),
                'directorIds' => $this->processDirectors($data['directors'] ?? []),
                'countryIds' => $this->processCountries($data['countries'] ?? []),
            ];

            $this->syncMovieAttributes($movie, $movieAttributes);
            DB::commit();
            Log::info('Movie synced successfully', ['kp_id' => $data['id']]);
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            return false;
        }
    }

    private function processGenres(array $genres): array
    {
        return collect($genres)->map(function ($genreName) {
            return $this->genreService->updateOrCreate($genreName)->id;
        })->toArray();
    }

    private function processActors(array $actors): array
    {
        return collect($actors)->map(function ($actorName) {
            return $this->actorService->updateOrCreate($actorName)->id;
        })->toArray();
    }

    private function processDirectors(array $directors): array
    {
        return collect($directors)->map(function ($directorName) {
            return $this->directorService->updateOrCreate($directorName)->id;
        })->toArray();
    }

    private function processCountries(array $countries): array
    {
        return collect($countries)->map(function ($countryName) {
            return $this->countryService->updateOrCreate($countryName)->id;
        })->toArray();
    }

    private function syncMovieAttributes(Movie $movie, array $attributes): void
    {
        $this->movieService->addGenres($movie, $attributes['genreIds']);
        $this->movieService->addActors($movie, $attributes['actorIds']);
        $this->movieService->addDirectors($movie, $attributes['directorIds']);
        $this->movieService->addCountries($movie, $attributes['countryIds']);
    }
}

<?php

namespace App\UseCases\Movie;

use App\Contracts\Services\MovieService;
use App\Services\SyncService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncMovieUseCase
{
    public function execute(array $movies)
    {

        try {
            DB::beginTransaction();
            $movieService = $this->getMovieService();
            $syncService = $this->getSyncService();

            foreach ($movies as $movieData) {
                $fields = $movieService->prepareMovieData($movieData);
                $movie = $movieService->updateOrCreate($fields);

                $syncService->syncMovie($movie, $movieData);
            }
            DB::commit();
            Log::info('Movie synced successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
        }

    }

    private function getMovieService(): MovieService
    {
        return app(MovieService::class);
    }

    private function getSyncService(): SyncService
    {
        return app(SyncService::class);
    }

}

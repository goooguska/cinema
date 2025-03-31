<?php

namespace App\Jobs;

use App\Contracts\Services\MovieService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchMoviesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly int $pages,
        private readonly int $perPage,
    ) {
        $this->onQueue('fetch-movies');
    }

    public function handle(): void
    {
        try {
            $movieService = $this->getMovieService();

            $response = $movieService->fetchMovies($this->pages, $this->perPage);

            dispatch(new SyncMoviesJob($response['docs']));

        } catch (\Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);
            $this->fail($e);
        }
    }

    private function getMovieService(): MovieService
    {
        return app(MovieService::class);
    }
}

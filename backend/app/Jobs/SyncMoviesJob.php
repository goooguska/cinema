<?php

namespace App\Jobs;

use App\Contracts\Services\MovieService;
use App\UseCases\Movie\SyncMovieUseCase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncMoviesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly array $movies,
    ) {
        $this->onQueue('sync-movies');
    }

    public function handle(SyncMovieUseCase $useCase): void
    {
        try {
            $useCase->execute($this->movies);
        } catch (\Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);
            $this->fail($e);
        }
    }



}

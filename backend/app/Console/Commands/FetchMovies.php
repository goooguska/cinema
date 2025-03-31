<?php

namespace App\Console\Commands;

use App\Jobs\FetchMoviesJob;
use App\Services\MovieService;
use Illuminate\Console\Command;

class FetchMovies extends Command
{
    protected $signature = 'app:fetch-movies
        {--pages=5 : Number of pages to fetch}
        {--per-page=50 : Items per page}';

    protected $description = 'Fetch movies from API';

    public function handle()
    {
        $pages = $this->option('pages');
        $perPage = $this->option('per-page');

        dispatch(new FetchMoviesJob($pages, $perPage));

        $this->info('Загрузка запущена');;
    }
}

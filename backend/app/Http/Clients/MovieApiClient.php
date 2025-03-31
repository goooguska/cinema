<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class MovieApiClient
{
    private Client $client;
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.kinopoisk.key');

        $this->client = new Client([
            'base_uri' => 'https://api.kinopoisk.dev/v1.4/',
            'headers' => [
                'Accept' => 'application/json',
                'X-API-KEY' => $this->apiKey,
                'User-Agent' => 'Laravel Movie App/1.0'
            ],
            'timeout' => 20,
            'connect_timeout' => 15,
            'http_errors' => false
        ]);
    }

    public function fetchMovies(int $page = 1, int $limit = 50): array
    {
        try {
            $response = $this->client->get('movie', [
                'query' => [
                    'page' => $page,
                    'limit' => $limit,
                    'selectFields' => [
                        'id',
                        'name',
                        'alternativeName',
                        'year',
                        'description',
                        'rating',
                        'poster',
                        'movieLength',
                        'genres',
                        'persons',
                        'countries'
                    ],
                    'sortField' => 'rating.kp',
                    'sortType' => '-1'
                ]
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new \Exception("API request failed with status code: " . $response->getStatusCode());
            }

            $data = json_decode($response->getBody(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("JSON parsing error: " . json_last_error_msg());
            }

            return $data;
        } catch (GuzzleException $e) {
            Log::error('Kinopoisk API connection error: ' . $e->getMessage());
            throw new \RuntimeException('Failed to connect to Kinopoisk API');
        } catch (\Exception $e) {
            Log::error('Kinopoisk API processing error: ' . $e->getMessage());
            throw new \RuntimeException('Failed to process API response');
        }
    }

    public function fetchMovieDetails(int $movieId): array
    {
        try {
            $response = $this->client->get("movie/{$movieId}", [
                'query' => [
                    'selectFields' => [
                        'id',
                        'name',
                        'alternativeName',
                        'year',
                        'description',
                        'rating',
                        'poster',
                        'movieLength',
                        'genres',
                        'persons',
                        'similarMovies',
                        'sequelsAndPrequels'
                    ]
                ]
            ]);


            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            Log::error('Kinopoisk API connection error: ' . $e->getMessage());
            throw new \RuntimeException('Failed to connect to Kinopoisk API');
        } catch (\Exception $e) {
            Log::error('Kinopoisk API processing error: ' . $e->getMessage());
            throw new \RuntimeException('Failed to process API response');
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('actors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('directors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->string('poster_url')->nullable();
            $table->integer('year')->nullable();
            $table->bigInteger('kp_id')->unique()->nullable();
            $table->timestamps();
        });

        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->unsignedSmallInteger('capacity')->default(60);;
            $table->foreignId('cinema_id');
            $table->timestamps();

            $table->unique(['cinema_id', 'number']);
        });

        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->decimal('price');
            $table->foreignId('hall_id');
            $table->foreignId('movie_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('seat_number');
            $table->enum('status', ['active', 'canceled', 'reserved'])->default('active');

            $table->foreignId('screening_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->index(['screening_id', 'seat_number']);

            $table->timestamps();
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->unique(['screening_id', 'seat_number'], 'unique_seat_per_screening');
        });

        Schema::create('movie_actors', function (Blueprint $table) {
            $table->foreignId('movie_id');
            $table->foreignId('actor_id');
            $table->primary(['movie_id', 'actor_id']);
        });

        Schema::create('movie_directors', function (Blueprint $table) {
            $table->foreignId('movie_id');
            $table->foreignId('director_id');
            $table->primary(['movie_id', 'director_id']);
        });

        Schema::create('movie_genres', function (Blueprint $table) {
            $table->foreignId('movie_id');
            $table->foreignId('genre_id');
            $table->primary(['movie_id', 'genre_id']);
        });

        Schema::create('movie_countries', function (Blueprint $table) {
            $table->foreignId('movie_id');
            $table->foreignId('country_id');
            $table->primary(['movie_id', 'country_id']);
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('cinemas');
        Schema::dropIfExists('actors');
        Schema::dropIfExists('directors');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('movies');
        Schema::dropIfExists('halls');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('screenings');
        Schema::dropIfExists('movie_actors');
        Schema::dropIfExists('movie_directors');
        Schema::dropIfExists('movie_genres');
        Schema::dropIfExists('movie_countries');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('countries');

    }
};

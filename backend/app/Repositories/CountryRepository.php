<?php

namespace App\Repositories;

use App\Contracts\Repositories\CountryRepository as CountryRepositoryContract;
use App\Models\Country;

class CountryRepository extends BaseRepository implements CountryRepositoryContract
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }
}

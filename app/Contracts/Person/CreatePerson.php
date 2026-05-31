<?php

namespace App\Contracts\Person;

use Illuminate\Support\Facades\Auth;

interface CreatePerson {

    public function create(array $inputs);

}

<?php

namespace App\Contracts\Requisition;

use App\Models\Person;

interface CreateRequisition {

    public function create(array $inputs, int $type, Person $person);

}

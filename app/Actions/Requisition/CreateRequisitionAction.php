<?php

namespace App\Actions\Requisition;

use App\Contracts\Requisition\CreateRequisition;
use App\Models\Person;
use App\Models\Requisition;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Validation\ValidationException;
use function PHPSTORM_META\type;
use function PHPUnit\Framework\returnSelf;

class CreateRequisitionAction implements CreateRequisition{

    protected array $rules;

    public function __construct()
    {
        $this->rules = [
            'destination' => ['required'],
            'authorized_tasks' => ['required'],
        ];
    }

    public function create(array $inputs, int $type, Person $person = null) : ?Requisition
    {

        $types = [
            0 => "has_preparation",
            1 => "has_management",
        ];

        $type_string = $types[$type];

        if ( is_null($person) ) return null;

        if ($person->$type_string)
            return null;

        try {
            $validated_data = Validator::make($inputs, $this->rules)->validate();
        } catch (ValidationException $e) {
            dd($e->errors());
        }

        return $person->requisitions()->create(array_merge($validated_data, [
            "type" => $type,
        ]));
    }
}

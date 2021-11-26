<?php

namespace App\Actions\Person;

use App\Contracts\Person\CreatePerson;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreatePersonAction implements CreatePerson {


    protected array $rules;

    public function __construct()
    {
        $this->rules = [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'birthdate' => 'required|date',
            'birth_place' => 'max:50',
            'rank' => 'required',
            'commission' => 'required',
            'original_job' => 'required',
            'requisition_date' => 'required|date',
        ];
    }


    public function create(array $inputs) : Person
    {
        try {
            $validated_data = Validator::make($inputs, $this->rules)->validate();
        }catch (ValidationException $exception){
            dd($exception->errors());
        }


        return Person::updateOrCreate(
            ['first_name'=>$inputs['first_name'],'last_name'=>$inputs['last_name']],
            array_merge($validated_data, ["user_id" => Auth::id()])
        );
    }

}

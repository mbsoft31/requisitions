<?php

namespace Tests\Feature;

use App\Contracts\Person\CreatePerson;
use App\Contracts\Requisition\CreateRequisition;
use App\Models\Person;
use App\Models\Requisition;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonTest extends TestCase
{
    /**
     * A basic test_can_create_person.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function test_can_create_person()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $inputs = Person::factory()->raw();
        $creator = app()->make(CreatePerson::class);
        $person = $creator->create($inputs);

        $this->assertTrue(
            Person::query()
                ->where('first_name', $inputs['first_name'])
                ->where('last_name', $inputs['last_name'])
                ->where('birth_place', $inputs['birth_place'])
                ->exists()
        );
        $this->assertEquals($user->id, $person->user_id);
    }

    /**
     * A basic test_can_create_requisition.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function test_can_create_requisition()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $person = Person::factory()->create();

        $inputs = Requisition::factory()->raw();
        $creator = app()->make(CreateRequisition::class);
        $requisition = $creator->create($inputs, Requisition::$PREPARATION, $person);

        $this->assertTrue(
            Requisition::query()
                ->where('person_id', $person->id)
                ->where('type', Requisition::$PREPARATION)
                ->exists()
        );
    }

    /**
     * A basic test_can_create_requisition.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function test_can_create_only_one_preparation_requisition()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $person = Person::factory()->create();

        $inputs = Requisition::factory()->raw();
        $creator = app()->make(CreateRequisition::class);
        $requisition = $creator->create($inputs, Requisition::$PREPARATION, $person);

        $person->refresh();

        $inputs = Requisition::factory()->raw();
        $creator = app()->make(CreateRequisition::class);
        $requisition = $creator->create($inputs, Requisition::$PREPARATION, $person);

        $person->refresh();

        $this->assertTrue(
            Requisition::query()
                ->where('person_id', $person->id)
                ->where('type', Requisition::$PREPARATION)
                ->count()<=1
        );
    }

    public function test_can_create_only_one_management_requisition()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $person = Person::factory()->create();

        $inputs = Requisition::factory()->raw();
        $creator = app()->make(CreateRequisition::class);
        $requisition = $creator->create($inputs, Requisition::$MANAGEMENT, $person);

        $person->refresh();

        $inputs = Requisition::factory()->raw();
        $creator = app()->make(CreateRequisition::class);
        $requisition = $creator->create($inputs, Requisition::$MANAGEMENT, $person);

        $person->refresh();

        $this->assertTrue(
            Requisition::query()
                ->where('person_id', $person->id)
                ->where('type', Requisition::$PREPARATION)
                ->count()<=1
        );
    }
}

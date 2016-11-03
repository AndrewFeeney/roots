<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Name;

class CreatePersonTest extends TestCase
{
    use CreatesModels;
    use DatabaseTransactions;

    /** @test */
    public function a_user_can_create_a_person()
    {
        // Create user
        $user = $this->getTestObject('user');

        // Create parents
        $father = $this->getTestObject('person', ['gender' => 'male']);
        $mother = $this->getTestObject('person', ['gender' => 'female']);

        // Create places
        $placeOfBirth = $this->getTestObject('place');
        $placeOfDeath = $this->getTestObject('place');

        // Sign user in
        Auth::login($user);

        // Visit create person page
        $this->visit(route('person.create'));

        // Fill in form
        $this->type('John', 'first_name')
            ->type('Arthur', 'second_name')
            ->type('Edward', 'third_name')
            ->type('Doe', 'last_name')
            ->type('1900-01-01', 'date_of_birth')
            ->type('2000-01-01', 'date_of_death')
            ->select($placeOfBirth->id, 'place_of_birth_id')
            ->select($placeOfDeath->id, 'place_of_death_id')
            ->select($father->id, 'father_id')
            ->select($mother->id, 'mother_id')
            ->press('Add Person');

        // See new person in database
        $this->seeInDatabase('people', [
            'first_name_id' => Name::where('name', 'John')->first()->id,
            'second_name_id' => Name::where('name', 'Arthur')->first()->id,
            'third_name_id' => Name::where('name', 'Edward')->first()->id,
            'last_name_id' => Name::where('name', 'Doe')->first()->id,
            'date_of_birth' => '1900-01-01',
            'date_of_death' => '2000-01-01',
            'father_id' => $father->id,
            'mother_id' => $mother->id,
            'place_of_birth_id' => $placeOfBirth->id,
            'place_of_death_id' => $placeOfDeath->id
        ]);
    }
}

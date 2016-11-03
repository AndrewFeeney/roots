<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Person;
use App\Models\Place;
use App\Models\Name;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('person.create', [
            'people' => Person::all()->keyBy('id')->map(function ($person) {
                return $person->getName();
            }, 'id'),
            'places' => Place::all()->keyBy('id')->map(function ($place) {
                return $place->getName();
            }, 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request
        $this->validate($request, [
            'date_of_birth' => 'date',
            'date_of_death' => 'date',
            'father_id' => 'exists:people,id',
            'mother_id' => 'exists:people,id',
        ]);

        // Get name ids if they exist or create if not
        $nameIds = collect(['first', 'second', 'third', 'last'])
            ->keyBy(function ($value) {
                return $value . 'Name';
            })->map(function ($namePrefix) use ($request) {

                // Skip if no name provided
                if (empty($request->{$namePrefix . '_name'})) {
                    return;
                }
                
                return Name::firstOrCreate([
                    'name' => $request->{$namePrefix . '_name'}
                ])->id;
            }); 
        
        // Save new person
        $person = Person::create([
            'first_name_id' => $nameIds['firstName'],
            'second_name_id' => $nameIds['secondName'],
            'third_name_id' => $nameIds['thirdName'],
            'last_name_id' => $nameIds['lastName'],
            'date_of_birth' => $request->date_of_birth,
            'date_of_death' => $request->date_of_death,
            'father_id' => $request->father_id,
            'mother_id' => $request->mother_id,
            'place_of_birth_id' => $request->place_of_birth_id,
            'place_of_death_id' => $request->place_of_death_id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

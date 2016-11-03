<?php

/*
 |--------------------------------------------------------------------------------
 |  Add this trait to tests to provide a simple API to create models and their
 |  dependencies for testing purposes
 |--------------------------------------------------------------------------------
 */
trait CreatesModels
{
    /**
     * The Person being used for test purposes
     * @var App\Models\Person
     **/
    private $person;

    /**
     * The Place being used for test purposes
     * @var App\Models\Place
     **/
    private $place;

    /**
     * The User being used for test purposes
     * @var App\Models\User
     **/
    private $user;

    /**
     * Creates a random Person and returns it
     *
     * @param array $attributes
     * @return \App\Models\Person
     **/
    public function createPerson($attributes = [])
    {
        return factory(App\Models\Person::class)->create($attributes);
    }

    /**
     * Creates a random Place and returns it
     *
     * @param array $attributes
     * @return \App\Models\Place
     **/
    public function createPlace($attributes = [])
    {
        return factory(App\Models\Place::class)->create($attributes);
    }

    /**
     * Creates a random user and returns it
     *
     * @param array $attributes
     * @return \App\Models\User
     **/
    public function createUser($attributes = [])
    {
        return factory(App\Models\User::class)->create($attributes);
    }

    /**
     * Returns the given attribute if it is set. If it is not set, thet set method will be returned.
     *
     * @param string $propertyName
     * @param array $attributes
     * @return mixed
     **/
    public function getTestObject($propertyName, $attributes = [])
    {
        // If the given property has not already been set
        if (is_null($this->$propertyName)) {

            // Generate new object
            $object = $this->{'create' . ucfirst($propertyName)}();

            // Set the property as the new object
            $this->setTestObject($propertyName, $object);
        }

        // If any attributes have been provided we'll set them on the object
        if (!empty($attributes)) {
            collect($attributes)->each( function($value, $key) use ($propertyName) {
                $this->$propertyName->$key = $value;
                $this->$propertyName->save();
            });
        }
        return $this->$propertyName;
    }

    /**
     * Sets the given property to the given object. If none is provided, a new one will be generated.
     *
     * @param string $propertyName
     * @param mixed $object (optional)
     **/
    public function setTestObject($propertyName, $object = null)
    {
        // If no object is provided we'll just generate a new one
        if (is_null($object)) {

            // Generate new object
            $object = $this->{'create' . ucfirst($propertyName)}();
        }

        // Set object
        $this->$propertyName = $object;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $guarded = [];

    /**
     * Returns all names as a concatenated string
     *
     * @return string
     **/
    public function getName()
    {
        return trim(implode([
            $this->getFirstName(),
            $this->getSecondName(),
            $this->getThirdName(),
            $this->getLastName(),
        ], ' ')); 
    }

    /**
     * Returns the first name if it is set or null if not
     *
     * @return string
     **/
    public function getFirstName()
    {
        if (is_null($this->firstName)) {
            return null;
        }
        return $this->firstName->name;
    }

    /**
     * A person belongs to a first name
     **/
    public function firstName()
    {
        return $this->belongsTo('App\Models\Name');
    }

    /**
     * Returns the second name if it is set or null if not
     *
     * @return string
     **/
    public function getSecondName()
    {
        if (is_null($this->secondName)) {
            return null;
        }
        return $this->secondName->name;
    }

    /**
     * A person belongs to a second name
     **/
    public function secondName()
    {
        return $this->belongsTo('App\Models\Name');
    }

    /**
     * Returns the third name if it is set or null if not
     *
     * @return string
     **/
    public function getThirdName()
    {
        if (is_null($this->thirdName)) {
            return null;
        }
        return $this->thirdName->name;
    }

    /**
     * A person belongs to a third name
     **/
    public function thirdName()
    {
        return $this->belongsTo('App\Models\Name');
    }

    /**
     * Returns the last name if it is set or null if not
     *
     * @return string
     **/
    public function getLastName()
    {
        if (is_null($this->lastName)) {
            return null;
        }
        return $this->lastName->name;
    }

    /**
     * A person belongs to a last name
     **/
    public function lastName()
    {
        return $this->belongsTo('App\Models\Name');
    }
}

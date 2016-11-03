<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    /**
     * Returns all names as a concatenated string
     *
     * @return string
     **/
    public function getName()
    {
        return trim(implode([
            $this->locality,
            $this->district,
            $this->country,
        ], ' ')); 
    }
}

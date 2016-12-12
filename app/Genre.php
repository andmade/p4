<?php

namespace P4;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    /**
     * Associate Genre with Movie
     *
     * @return void
     */
    public function movies()
    {
        return $this->belongsToMany('P4\Movie')->withTimestamps();
    }

}

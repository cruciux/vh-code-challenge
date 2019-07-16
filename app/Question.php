<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['value'];

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    protected $fillable = [
        'nome'
    ];

    public $rules = [
        'nome'  =>  'required|min:2|max:150'
    ];
}

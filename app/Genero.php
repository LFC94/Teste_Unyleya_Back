<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $fillable = [
        'descricao'
    ];
    
    public $rules = [
        'descricao'    =>  'required|min:2|max:150',
       
    ];
}

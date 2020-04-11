<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompactDisc extends Model
{
    protected $fillable = [
        'titulo', 'genero_id', 'artista_id'
    ];
    
    public $rules = [
        'titulo'    =>  'required|min:2|max:150',
        'genero_id' =>  'required|numeric',
        'artista_id'=>  'required|numeric'
    ];
}

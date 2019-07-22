<?php

namespace LosPlatanos\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $table="categorias";
    protected $fillable = ['nombre'];
    public $timestamp= false;
    //
}

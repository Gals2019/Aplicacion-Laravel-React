<?php

namespace LosPlatanos\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table="productos"; //Especificar nombre de tabla tal como esta en la BD
    protected $fillable = ['nombre','precio','cantidad'];
    /*
    EN CASO QUE LA TABLA NO TENGA TIMESTAMPS SE AGREGA LA SIGUIENTE LINEA DE CÓDIGO
    public $timestamps=false;*/

    

    

}

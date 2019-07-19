<?php

namespace LosPlatanos\Http\Controllers;

use Illuminate\Http\Request;
use LosPlatanos\Models\Productos;


class ProductoController extends Controller
{
    public function index(){
        $producto = Productos::all();

        return view("producto.index", compact("producto"));
    }
    public function crear(){
        return view("producto.crear");
    }
    public function guardar(Request $request){

        $datos=$request->all();

        Productos::create([
            "nombre"=>$datos["nombre"],
            "precio"=>$datos["precio"],
            "cantidad"=>$datos["cantidad"],
        ]);

        return redirect("/producto");


    }
}

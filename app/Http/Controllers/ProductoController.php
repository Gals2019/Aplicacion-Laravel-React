<?php

namespace LosPlatanos\Http\Controllers;

use Illuminate\Http\Request;
use LosPlatanos\Models\Productos;
use LosPlatanos\Models\Categoria;
use Validator;

class ProductoController extends Controller
{


    public function store(Request $request)
    {
        $producto = $request->all();
        
        $validator = Validator::make($producto, [
            'nombre' => 'required|unique:productos|max:60',
            'precio' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }

    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

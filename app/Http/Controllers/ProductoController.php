<?php

namespace LosPlatanos\Http\Controllers;

use Illuminate\Http\Request;
use LosPlatanos\Models\Productos;
use LosPlatanos\Models\Categoria;
use Validator;
use League\Flysystem\Exception;

class ProductoController extends Controller
{

    public function index()
    {
        
        $productos = Productos::select("productos.*","categorias.nombre as nombre_categoria")
        ->join("categorias", "productos.categoria_id","=","categorias.id")
        ->get();

        return response()->json(['success'=>true,
        'data'=>$productos]);
    }

    public function store(Request $request)
    {
        $producto = $request->all();
        
        $validator = Validator::make($producto, [
            'nombre' => 'required|unique:productos|max:60',
            'precio' => 'required|numeric',
            'categoria_id'=>'required|numeric',
            'cantidad'=>'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>false, 'error'=> $validator->messages()]);
        }

        try {
            Productos::create($producto);
            return response()->json(['success'=>true, 'error'=>'Producto registrado con exito']);
        } catch (Exception $ex) {
            return response()->json(['success'=>false, 'error'=>$ex->getMessage()]);
        }



    }

    public function show($id)
    {
        $productos = Productos::select("productos.*","categorias.nombre as nombre_categoria")
        ->join("categorias", "productos.categoria_id","=","categorias.id")
        ->where("productos.id",$id)
        ->first();

        return response()->json(['success'=>true,
        'data'=>$productos]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'nombre' => 'required|unique:productos|max:60',
            'precio' => 'required|numeric',
            'categoria_id'=>'required|numeric',
            'cantidad'=>'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>false, 'error'=> $validator->messages()]);
        }

        try {
            $producto= Productos::find($id);

            if ($producto==false) {
                
                return response()->json(['success'=>false, 'error'=>"No se encontro el producto solicitado."]);

            }
            
            $producto->update($input);
            
            return response()->json(['success'=>true, 'error'=>"Producto modificado."]);

        } catch (Exception $ex) {
            return response()->json(['success'=>false, 'error'=>$ex->getMessage()]);
        }

    }

    public function destroy($id)
    {
       
        try {
            $producto= Productos::find($id);

            if ($producto==false) {
                
                return response()->json(['success'=>false, 'error'=>"No se encontro el producto solicitado."]);

            }
            
            $producto->update([
                'estado'=> $producto->estado==1?0:1
            ]);
            
            return response()->json(['success'=>true, 'error'=>"Producto modificado."]);

        } catch (Exception $ex) {
            return response()->json(['success'=>false, 'error'=>$ex->getMessage()]);
        }

    }
}

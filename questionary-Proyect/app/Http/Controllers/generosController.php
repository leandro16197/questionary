<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Generos;
use Illuminate\Support\Facades\Validator;

class generosController extends Controller
{
    function getGeneros(){
        
        $generos=Generos::all();
        return view('dashboard', [
            'generos'=>$generos,
        ]);
    }
    public function index(Request $request)
    {
        $query = Generos::query();
    
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $search = $request->input('search.value', '');
        $draw = (int) $request->input('draw', 1);
    

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
    
 
        $recordsFiltered = $query->count();
    
        $data = $query->skip($start)->take($length)->get();
    
        return response()->json([
            'draw' => $draw, 
            'recordsTotal' => Generos::count(),
            'recordsFiltered' => $recordsFiltered, 
            'data' => $data, 
        ]);
    }
    
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255', 
        ]);
    

        if ($validator->fails()) {
            $data = [
                'message' => 'Error al validar los datos',
                'errors' => $validator->errors(),
                'status' => '422'
            ];
            return response()->json($data, 422); 
        }
    

        $genero = Generos::create([
            'name' => $request->name
        ]);
    

        if (!$genero) {
            $data = [
                'message' => 'Error al crear el género',
                'status' => '500'
            ];
            return response()->json($data, 500); 
        }
    
        $data = [
            'message' => 'Género creado exitosamente',
            'genero' => $genero, 
            'status' => '201'  
        ];
    
        return response()->json($data, 201);  
    }

    function show($id){
        $genero=Generos::find($id);

        if (!$genero) {
            $data = [
                'message' => 'genero no encontrado',
                'status' => '400'
            ];
            return response()->json($data, 400); 
        }
        $data = [
            'genero' =>$genero,
            'status' => '200'
        ];
        return response()->json($data,200);
    }

    public function delete($id)
    {

        $genero = Generos::find($id);
    

        if (!$genero) {
            $data = [
                'message' => 'Género no encontrado',
                'status' => '400'
            ];
            return response()->json($data, 400); 
        }

        $genero->delete();
    

        $data = [
            'message' => 'Género eliminado',
            'status' => '200'
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
{
    $genero = Generos::find($id);

    if (!$genero) {
        return response()->json(['message' => 'Género no encontrado'], 404);
    }

    $genero->name = $request->input('nombre');
    $genero->save();

    return response()->json(['message' => 'Género actualizado con éxito', 'genero' => $genero]);
}

}

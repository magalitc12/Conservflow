<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Utilidades;
use Illuminate\Http\Request;
use App\TipoResguardo;
use Illuminate\Support\Facades\Validator;

class TipoResguardoController extends Controller
{
  /*Valida que el campo nombre no contenga nulos o vacíos*/
  protected $rules = array(
    'nombre' => 'required|max:45',
  );
  /******************************************************/

  public function index(Request $request)
  {
    /*Obtiene todos los registros del tipo de resguardo*/
    $tipoResguardo = TipoResguardo::orderBy('id', 'desc')->get()->toArray();
    return response()->json($tipoResguardo);
  }

  public function store(Request $request)
  {
    /*Inserta un nuevo registro en la BD*/
    //Valida si la peticion del request es por ajax
    if (!$request->ajax()) return redirect('/');
    //Valida que el campo no sea nulo o vacío
    $this->rules['nombre'] = 'required|unique:tipo_resguardo,nombre,0,id|max:45';
    $validator = Validator::make($request->all(), $this->rules);

    if ($validator->fails())
    {
      return response()->json(array(
        'status' => false,
        'errors' => $validator->errors()->all()
      ));
    }

    $tipoResguardo = new TipoResguardo();
    $tipoResguardo->nombre =  $request->nombre;
    Utilidades::auditar($tipoResguardo, $tipoResguardo->id);
    $tipoResguardo->save();

    return response()->json(array(
      'status' => true
    ));
    /**********************************/
  }

  public function update(Request $request)
  {
    /*Actualiza el registro en la BD*/
    if (!$request->ajax()) return redirect('/');

    $this->rules['nombre'] = 'required|unique:tipo_resguardo,nombre,' . $request->id . ',id|max:45';
    $validator = Validator::make($request->all(), $this->rules);

    if ($validator->fails())
    {
      return response()->json(array(
        'status' => false,
        'errors' => $validator->errors()->all()
      ));
    }

    $tipoResguardo = TipoResguardo::findOrFail($request->id);
    $tipoResguardo->nombre = $request->nombre;
    $tipoResguardo->save();

    return response()->json(array(
      'status' => true
    ));
    /*******************************/
  }

  public function show($id)
  {
    // code...
    $tipoResguardo = TipoResguardo::where('id', '=', $id)->first();
    return response()->json($tipoResguardo);
  }
}

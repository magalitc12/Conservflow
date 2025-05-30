<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Utilidades;
use Illuminate\Http\Request;
use App\TipoAdquisicion;
use App\TipoEntrada;
use Illuminate\Support\Facades\Validator;

class TipoAdquisicionController extends Controller
{
    protected $rules = array(
        'nombre' => 'required|max:45',
    );

    public function index(Request $request)
    {
        $tiposDescuento = TipoAdquisicion::orderBy('id', 'desc')->get()->toArray();
        return response()->json($tiposDescuento);
    }

    public function store(Request $request)
    {
        try
        {
            if (!$request->ajax()) return redirect('/');

            $this->rules['nombre'] = 'required|unique:tipo_descuentos,nombre,0,id|max:45';
            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails())
            {
                return response()->json(array(
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ));
            }

            $tipoDescuento = new TipoEntrada();
            $tipoDescuento->nombre = $request->nombre;
            Utilidades::auditar($tipoDescuento, $tipoDescuento->id);
            $tipoDescuento->save();

            return response()->json(array(
                'status' => true
            ));
        }
        catch (\Throwable $e)
        {
            Utilidades::errors($e);
        }
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $this->rules['nombre'] = 'required|unique:tipo_descuentos,nombre,' . $request->id . ',id|max:45';
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails())
        {
            return response()->json(array(
                'status' => false,
                'errors' => $validator->errors()->all()
            ));
        }

        $tipoDescuento = TipoEntrada::findOrFail($request->id);
        $tipoDescuento->nombre = $request->nombre;
        Utilidades::auditar($tipoDescuento, $tipoDescuento->id);
        $tipoDescuento->save();

        return response()->json(array(
            'status' => true
        ));
    }

    public function getList(Request $request)
    {
        $tiposDescuento = TipoEntrada::select('id', 'nombre')->orderBy('id', 'desc')->get()->toArray();
        return response()->json($tiposDescuento);
    }
}

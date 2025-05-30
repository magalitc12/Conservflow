<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Helpers\Utilidades;
use App\RHModels\Departamento;
use Illuminate\Support\Facades\Validator;

class SoftwareController extends Controller
{
    protected $rules = array(
        'nombre' => 'required|max:100'
    );

    public function index()
    {
        $deptos = DB::table('departamentos')
            ->leftJoin('direcciones_administrativas', 'departamentos.direccion_administrativa_id', '=', 'direcciones_administrativas.id')
            ->select('departamentos.*', 'direcciones_administrativas.nombre AS direccion')
            ->get();

        return response()->json(
            $deptos->toArray()
        );
    }

    public function store(Request $request)
    {
        try
        {
            if (!$request->ajax()) return redirect('/');
            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails())
            {
                return response()->json(array(
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ));
            }

            $depto = new Departamento();
            $depto->nombre = $request->nombre;
            $depto->direccion_administrativa_id = $request->direccion_administrativa_id;
            $depto->condicion = '1';
            Utilidades::auditar($depto, $depto->id);
            $depto->save();

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
        try
        {

            if (!$request->ajax()) return redirect('/');

            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails())
            {
                return response()->json(array(
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ));
            }

            $depto = Departamento::findOrFail($request->id);
            $depto->nombre = $request->nombre;
            $depto->direccion_administrativa_id = $request->direccion_administrativa_id;
            $depto->condicion = '1';
            Utilidades::auditar($depto, $depto->id);
            $depto->save();

            return response()->json(array(
                'status' => true
            ));
        }
        catch (\Throwable $e)
        {
            Utilidades::errors($e);
        }
    }

    public function desactivar(Request $request)
    {
        try
        {
            if (!$request->ajax()) return redirect('/');
            $depto = Departamento::findOrFail($request->id);
            $depto->condicion = '0';
            Utilidades::auditar($depto, $depto->id);
            $depto->save();
        }
        catch (\Throwable $e)
        {
            Utilidades::errors($e);
        }
    }

    public function activar(Request $request)
    {
        try
        {
            if (!$request->ajax()) return redirect('/');
            $depto = Departamento::findOrFail($request->id);
            $depto->condicion = '1';
            Utilidades::auditar($depto, $depto->id);
            $depto->save();
        }
        catch (\Throwable $e)
        {
            Utilidades::errors($e);
        }
    }

    public function getList(Request $request)
    {
        $deptos = Departamento::select('id', 'nombre')->orderBy('id', 'desc')->get()->toArray();
        return response()->json($deptos);
    }
}

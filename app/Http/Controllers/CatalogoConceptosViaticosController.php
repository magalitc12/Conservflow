<?php

namespace App\Http\Controllers;

class CatalogoConceptosViaticosController extends Controller
{
  /**
   * Obtiene el listado de todos los catalogos de la BD
   * @return \Illuminate\Http\Response
   **/

  public function listaConceptos()
  {
    $conceptos = \App\CatalogoConceptosViaticos::all();
    return response()->json($conceptos);
  }
}

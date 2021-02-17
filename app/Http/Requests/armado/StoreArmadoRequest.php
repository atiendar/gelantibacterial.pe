<?php
namespace App\Http\Requests\armado;
use Illuminate\Foundation\Http\FormRequest;

class StoreArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'tipo'                => 'required|max:150|exists:catalogos,value',
      'nombre'              => 'required|max:60|unique:armados,nom',
      'sku'                 => 'required|max:30|unique:armados,sku',
      'gama'                => 'required|max:150|exists:catalogos,value',
      'destacado'           => 'required|in:Si,No',
      'cantidad_minima_de_stock'  => 'required|min:0|numeric|max:9999999999',
      'maximo'                    => 'required|min:0|numeric|max:9999999999',
      'pedido_a_planta'           => 'required|min:0|numeric|max:9999999999',
      'imagen_del_armado'   => 'nullable|max:1024|image',
      'url_pagina'          => 'max:150',
      'observaciones'       => 'nullable|max:30000|string',
    ];
  }
}
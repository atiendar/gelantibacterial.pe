<?php
namespace App\Http\Requests\armado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateArmadoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_armado = Crypt::decrypt($this->id_armado);
    return [
      'tipo'                => 'required|max:150|exists:catalogos,value',
      'nombre'              => 'required|max:60|unique:armados,nom,' . $id_armado,
      'sku'                 => 'required|max:30|unique:armados,sku,' . $id_armado,
      'gama'                => 'required|max:150|exists:catalogos,value',
      'destacado'           => 'required|in:Si,No',
      'cantidad_minima_de_stock'  => 'required|min:0|numeric|max:9999999999',
      'maximo'                    => 'required|min:0|numeric|max:9999999999',
      'pedido_a_planta'           => 'required|min:0|numeric|max:9999999999',
      'imagen_del_armado'   => 'nullable|max:1024|image',
      'url_pagina'          => 'max:150',
      'descuento_especial'  => 'required|numeric|alpha_decimal15|alpha_total_armado:' . $id_armado,
      'observaciones'       => 'nullable|max:30000|string',
    ];
  }
}
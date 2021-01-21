<?php
namespace App\Http\Requests\pago\individual;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StorePagoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_pedido = Crypt::decrypt($this->id_pedido);
    $pedido = \App\Models\Pedido::select('id', 'mont_tot_de_ped')->with('pagos')->findOrFail($id_pedido);
    $sum_mont_de_pag = $pedido->pagos()->sum('mont_de_pag');
    $max_monto = $pedido->mont_tot_de_ped - $sum_mont_de_pag;
    $max_monto = number_format($max_monto, 2, '.', '');
GFJ PRODUCTS AND SERVICES SA DE CV
    return [
      'comprobante_de_pago'                 => 'nullable|mimes:pdf,jpg,jpeg,png|max:1024',
   //   'ultimos_8_digitos_del_folio_de_pago' => 'nullable|required_if:forma_de_pago,Cheque,Paypal,Tarjeta de credito (Pagina),Tarjeta de credito (Clip),Tarjeta de debito,Transferencia RUTH Yolanda,Transferencia GFJ PRODUCTS AND SERVICES SA DE CV|unique:pagos,fol|nullable|min:8|max:8',
      'ultimos_8_digitos_del_folio_de_pago' => 'nullable|unique:pagos,fol|nullable|min:8|max:8',
      'forma_de_pago'                       => 'required|in:Cheque,Efectivo (Jonathan),Efectivo (Gabriel),Efectivo (Fernando),Paypal,Tarjeta de credito (Pagina),Tarjeta de credito (Clip),Tarjeta de debito,Transferencia RUTH Yolanda,Transferencia GFJ PRODUCTS AND SERVICES SA DE CV',
      'copia_de_identificacion'             => 'nullable|mimes:pdf,jpg,jpeg,png|max:1024',
      'monto_del_pago'                      => 'required|numeric|min:0|max:'.$max_monto.'|alpha_decimal15',
      'comentarios_ventas'                  => 'nullable|max:30000|string',
    ];
  }
}
// |required_if:forma_de_pago,Paypal,Tarjeta de credito (Pagina)
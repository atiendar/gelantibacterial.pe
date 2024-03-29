<?php
namespace App\Http\Requests\cotizacion\armadoCotizacion\productoArmado;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUtilidadRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'utilidad'   => 'required|in:.01,.02,.03,.04,.05,.06,.07,.08,.09,.1,.11,.12,.13,.14,.15,.16,.17,.18,.19,.2,.21,.22,.23,.24,.25,.26,.27,.28,.29,.3,.31,.32,.33,.34,.35,.36,.37,.38,.39,.4,.41,.42,.43,.44,.45,.46,.47,.48,.49,.5,.51,.52,.53,.54,.55,.56,.57,.58,.59,.6,.61,.62,.63,.64,.65,.66,.67,.68,.69,.7,.71,.72,.73,.74,.75,.76,.77,.78,.79,.8,.81,.82,.83,.84,.85,.86,.87,.88,.89,.9,',
    ];
  }
}
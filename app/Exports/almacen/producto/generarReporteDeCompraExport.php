<?php
namespace App\Exports\almacen\producto;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models
use App\Models\Producto;

class generarReporteDeCompraExport implements FromView {
    use Exportable;
    public function view(): View {
        return view('almacen.producto.exports.alm_pro_exp_generarReporteDeCompra', [
            'productos' => Producto::with(['sustitutos', 'productos_pedido' => function($query) {
                $query->with(['armado' => function($query) {
                    $query->whereBetween('created_at', [date("Y-m-d", strtotime('-110 day', strtotime(date("Y-m-d")))), date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))]);
                }]);
            }])->orderBy('id', 'DESC')->get()
        ]);
    }
}
<?php
use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedoresTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      Proveedor::create([
        'id'                => 1,
        'raz_soc'           => 'GFJ PRODUCTS AND SERVICES SA DE CV',
        'nom_comerc'        => 'GFJ PRODUCTS AND SERVICES SA DE CV',
        'fab_distri'        => 'Fabricante',
        'lad_mov'  			    => '55',
        'tel_mov'           => '00000000',
        'call'              => 'BLVD. MANUEL AVILA CAMACHO',
        'no_ext'            => '80',
        'ciudad'            => 'ESTADO DE MÉXICO',
        'col'               => 'EL PARQUE',
        'del_o_munic'       => 'Naucalpan',
        'cod_post'          => '53398',
        'asignado_prov'     => 'desarrolloweb.ewmx@gmail.com',
        'created_at_prov'   => 'desarrolloweb.ewmx@gmail.com'
      ]);
    //  factory(App\Models\Proveedor::class, 100)->create(); // min
      // factory(App\Models\Proveedor::class, 10000)->create(); // max
    }
}
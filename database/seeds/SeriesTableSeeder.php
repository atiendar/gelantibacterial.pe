<?php
use Illuminate\Database\Seeder;
use App\Models\Serie;

class SeriesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      Serie::create([
        'input'             => 'Cotizaciones (Serie)',
        'value'             => 'COT-',
        'vista'             => 'COT-',
        'asignado_ser'  	  => 'desarrolloweb.ewmx@gmail.com',
        'created_at_ser'    => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Serie::create([
        'input'             => 'Pedidos (Serie)',
        'value'             => 'GEL-',
        'vista'             => 'GEL-',
        'asignado_ser'  	  => 'desarrolloweb.ewmx@gmail.com',
        'created_at_ser'    => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Serie::create([
        'id'                => 4,
        'input'             => 'Pedidos (Serie)',
        'value'             => 'STOCK-',
        'vista'             => 'STOCK-',
        'asignado_ser'  	  => 'desarrolloweb.ewmx@gmail.com',
        'created_at_ser'    => 'desarrolloweb.ewmx@gmail.com',
      ]);
      factory(Serie::class, 300)->create(); // min
      //factory(Serie::class, 10000)->create(); // max
    }
}
<?php
use Illuminate\Database\Seeder;
use App\Models\Armado;

class ArmadosTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      $arm1 = Armado::create([
        'id'                => 1,
        'stock'             => 100,
        'min_stock'         => 50,
        'max'               => 100,
        'ped_a_plant'       => 50,
        'clon'              => '0',
        'num_clon'          => 0,
        'sku'               => 'GEL-01',
        'tip'               => 'Gel',
        'nom'               => 'GEL ANTIBACTERIAL MAIZ 60 ml',
        'gama'              => 'Económica',
        'dest'              => 'No',
        'prec_de_comp'      => 7.00,
        'prec_origin'       => 10.00,
        'prec_redond'       => 10.00,
        'created_at_arm'    => 'desarrolloweb.ewmx@gmail.com',
        'asignado_arm'      => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $arm1->productos()->attach(1);
      $arm2 = Armado::create([
        'id'                => 2,
        'stock'             => 100,
        'min_stock'         => 50,
        'max'               => 100,
        'ped_a_plant'       => 50,
        'clon'              => '0',
        'num_clon'          => 0,
        'sku'               => 'GEL-02',
        'tip'               => 'Gel',
        'nom'               => 'GEL ANTIBACTERIAL MAIZ 120 ml',
        'gama'              => 'Económica',
        'dest'              => 'No',
        'prec_de_comp'      => 25.90,
        'prec_origin'       => 37.00,
        'prec_redond'       => 37.00,
        'created_at_arm'    => 'desarrolloweb.ewmx@gmail.com',
        'asignado_arm'      => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $arm2->productos()->attach(2);
      $arm3 = Armado::create([
        'id'                => 3,
        'stock'             => 100,
        'min_stock'         => 50,
        'max'               => 100,
        'ped_a_plant'       => 50,
        'clon'              => '0',
        'num_clon'          => 0,
        'sku'               => 'GEL-03',
        'tip'               => 'Gel',
        'nom'               => 'GEL ANTIBACTERIAL MAIZ 250 ml',
        'gama'              => 'Económica',
        'dest'              => 'No',
        'prec_de_comp'      => 11.20,
        'prec_origin'       => 16.00,
        'prec_redond'       => 16.00,
        'created_at_arm'    => 'desarrolloweb.ewmx@gmail.com',
        'asignado_arm'      => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $arm3->productos()->attach(3);
      $arm4 = Armado::create([
        'id'                => 4,
        'stock'             => 150,
        'min_stock'         => 50,
        'max'               => 150,
        'ped_a_plant'       => 100,
        'clon'              => '0',
        'num_clon'          => 0,
        'sku'               => 'GEL-04',
        'tip'               => 'Gel',
        'nom'               => 'GEL ANTIBACTERIAL MAIZ 500 ml',
        'gama'              => 'Económica',
        'dest'              => 'No',
        'prec_de_comp'      => 18.20,
        'prec_origin'       => 26.00,
        'prec_redond'       => 26.00,
        'created_at_arm'    => 'desarrolloweb.ewmx@gmail.com',
        'asignado_arm'      => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $arm4->productos()->attach(4);
      $arm5 = Armado::create([
        'id'                => 5,
        'stock'             => 75,
        'min_stock'         => 50,
        'max'               => 75,
        'ped_a_plant'       => 25,
        'clon'              => '0',
        'num_clon'          => 0,
        'sku'               => 'GEL-05',
        'tip'               => 'Gel',
        'nom'               => 'GEL ANTIBACTERIAL MAIZ 750 ml',
        'gama'              => 'Económica',
        'dest'              => 'No',
        'prec_de_comp'      => 23.80,
        'prec_origin'       => 34.00,
        'prec_redond'       => 34.00,
        'created_at_arm'    => 'desarrolloweb.ewmx@gmail.com',
        'asignado_arm'      => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $arm5->productos()->attach(5);
      $arm6 = Armado::create([
        'id'                => 6,
        'stock'             => 150,
        'min_stock'         => 30,
        'max'               => 150,
        'ped_a_plant'       => 120,
        'clon'              => '0',
        'num_clon'          => 0,
        'sku'               => 'GEL-06',
        'tip'               => 'Gel',
        'nom'               => 'GEL ANTIBACTERIAL MAIZ 1 L',
        'gama'              => 'Económica',
        'dest'              => 'No',
        'prec_de_comp'      => 30.10,
        'prec_origin'       => 43.00,
        'prec_redond'       => 43.00,
        'created_at_arm'    => 'desarrolloweb.ewmx@gmail.com',
        'asignado_arm'      => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $arm6->productos()->attach(6);
      $arm7 = Armado::create([
        'id'                => 7,
        'stock'             => 20,
        'min_stock'         => 5,
        'max'               => 20,
        'ped_a_plant'       => 15,
        'clon'              => '0',
        'num_clon'          => 0,
        'sku'               => 'GEL-07',
        'tip'               => 'Gel',
        'nom'               => 'GEL ANTIBACTERIAL MAIZ 5 L',
        'gama'              => 'Económica',
        'dest'              => 'No',
        'prec_de_comp'      => 25.90,
        'prec_origin'       => 37.00,
        'prec_redond'       => 37.00,
        'created_at_arm'    => 'desarrolloweb.ewmx@gmail.com',
        'asignado_arm'      => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $arm7->productos()->attach(7);
      $arm8 = Armado::create([
        'id'                => 8,
        'stock'             => 50,
        'min_stock'         => 20,
        'max'               => 50,
        'ped_a_plant'       => 30,
        'clon'              => '0',
        'num_clon'          => 0,
        'sku'               => 'GEL-08',
        'tip'               => 'Gel',
        'nom'               => 'GEL ANTIBACTERIAL MAIZ 3.78 L',
        'gama'              => 'Económica',
        'dest'              => 'No',
        'prec_de_comp'      => 105.00,
        'prec_origin'       => 150.00,
        'prec_redond'       => 150.00,
        'created_at_arm'    => 'desarrolloweb.ewmx@gmail.com',
        'asignado_arm'      => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $arm8->productos()->attach(8);
      $arm9 = Armado::create([
        'id'                => 9,
        'stock'             => 30,
        'min_stock'         => 10,
        'max'               => 30,
        'ped_a_plant'       => 20,
        'clon'              => '0',
        'num_clon'          => 0,
        'sku'               => 'GEL-09',
        'tip'               => 'Gel',
        'nom'               => 'GEL ANTIBACTERIAL MAIZ 20 L',
        'gama'              => 'Económica',
        'dest'              => 'No',
        'prec_de_comp'      => 518.00,
        'prec_origin'       => 740.00,
        'prec_redond'       => 740.00,
        'created_at_arm'    => 'desarrolloweb.ewmx@gmail.com',
        'asignado_arm'      => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $arm9->productos()->attach(9);
      $arm10 = Armado::create([
        'id'                => 10,
        'stock'             => 0,
        'min_stock'         => 0,
        'max'               => 0,
        'ped_a_plant'       => 0,
        'clon'              => '0',
        'num_clon'          => 0,
        'sku'               => 'GEL-10',
        'tip'               => 'Gel',
        'nom'               => 'GEL ANTIBACTERIAL MAIZ 200 L',
        'gama'              => 'Económica',
        'dest'              => 'No',
        'prec_de_comp'      => 5109.30,
        'prec_origin'       => 7299.00,
        'prec_redond'       => 7299.00,
        'created_at_arm'    => 'desarrolloweb.ewmx@gmail.com',
        'asignado_arm'      => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $arm10->productos()->attach(10);
      $arm11 = Armado::create([
        'id'                => 11,
        'stock'             => 0,
        'min_stock'         => 0,
        'max'               => 0,
        'ped_a_plant'       => 0,
        'clon'              => '0',
        'num_clon'          => 0,
        'sku'               => 'GEL-11',
        'tip'               => 'Gel',
        'nom'               => 'GEL ANTIBACTERIAL MAIZ 1000 L',
        'gama'              => 'Económica',
        'dest'              => 'No',
        'prec_de_comp'      => 23655.80,
        'prec_origin'       => 33794.00,
        'prec_redond'       => 33794.00,
        'created_at_arm'    => 'desarrolloweb.ewmx@gmail.com',
        'asignado_arm'      => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $arm11->productos()->attach(11);
    //  factory(App\Models\Armado::class, 1000)->create(); // min
      // factory(App\Models\Armado::class, 10000)->create(); // max
    }
}
<?php

use Illuminate\Database\Seeder;

class CostosDeEnvioTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      factory(App\Models\CostoDeEnvio::class, 350)->create();
    }
}

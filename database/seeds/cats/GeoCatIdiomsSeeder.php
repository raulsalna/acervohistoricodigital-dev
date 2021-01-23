<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Cats\GeoCatIdioms;

class GeoCatIdiomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languag = new GeoCatIdioms();
        $languag->name = 'Español';
        $languag->save();

        $languag = new GeoCatIdioms();
        $languag->name = 'Inglés';
        $languag->save();

        $languag = new GeoCatIdioms();
        $languag->name = 'Chino Mandarín';
        $languag->save();

        $languag = new GeoCatIdioms();
        $languag->name = 'Francés';
        $languag->save();

        $languag = new GeoCatIdioms();
        $languag->name = 'Ruso';
        $languag->save();

        $languag = new GeoCatIdioms();
        $languag->name = 'Árabe';
        $languag->save();

        $languag = new GeoCatIdioms();
        $languag->name = 'Alemán';
        $languag->save();

        $languag = new GeoCatIdioms();
        $languag->name = 'Portugués';
        $languag->save();

        $languag = new GeoCatIdioms();
        $languag->name = 'Japonés';
        $languag->save();

        $languag = new GeoCatIdioms();
        $languag->name = 'Italiano';
        $languag->save();


    }
}

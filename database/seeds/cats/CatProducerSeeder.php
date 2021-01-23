<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Cats\CatProducer;

class CatProducerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $producer = new CatProducer();
        $producer->name = 'Londres1';
        $producer->save();

        $producer = new CatProducer();
        $producer->name = 'Londres2';
        $producer->save();

        $producer = new CatProducer();
        $producer->name = 'Londres3';
        $producer->save();

        // $producer = new CatProducer();
        // $producer->name = 'Londres3';
        // $producer->save();
    }
}

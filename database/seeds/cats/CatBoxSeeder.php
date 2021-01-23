<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Cats\CatBox;

class CatBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $box = new CatBox();
        $box->name = 'Caja OCX 001A';
        $box->save();

        $box = new CatBox();
        $box->name = 'Caja OCX 001B';
        $box->save();

        $box = new CatBox();
        $box->name = 'Caja OCX 001C';
        $box->save();

        $box = new CatBox();
        $box->name = 'Caja OCX 002A';
        $box->save();

        $box = new CatBox();
        $box->name = 'Caja OCX 002B';
        $box->save();

        $file = new CatBox();
        $file->name = 'Caja OCX 003B';
        $file->save();
    }
}

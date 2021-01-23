<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Cats\CatFiles;

class CatFilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = new CatFiles();
        $file->name = 'Archivo 1A';
        $file->save();

        $file = new CatFiles();
        $file->name = 'Archivo 1B';
        $file->save();

        $file = new CatFiles();
        $file->name = 'Archivo 1C';
        $file->save();

        $file = new CatFiles();
        $file->name = 'Archivo 2A';
        $file->save();

        $file = new CatFiles();
        $file->name = 'Archivo 2B';
        $file->save();

        $file = new CatFiles();
        $file->name = 'Archivo 3B';
        $file->save();
    }
}

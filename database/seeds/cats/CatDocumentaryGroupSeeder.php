<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Cats\CatDocumentaryGroup;

class CatDocumentaryGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catDocument = new CatDocumentaryGroup();
        $catDocument->name = 'Grupo documental 001A';
        $catDocument->save();

        $catDocument = new CatDocumentaryGroup();
        $catDocument->name = 'Grupo documental 001B';
        $catDocument->save();

        $catDocument = new CatDocumentaryGroup();
        $catDocument->name = 'Grupo documental 001C';
        $catDocument->save();

        $catDocument = new CatDocumentaryGroup();
        $catDocument->name = 'Grupo documental 002A';
        $catDocument->save();

        $catDocument = new CatDocumentaryGroup();
        $catDocument->name = 'Grupo documental 002B';
        $catDocument->save();

        $catDocument = new CatDocumentaryGroup();
        $catDocument->name = 'Grupo documental 003B';
        $catDocument->save();
    }
}

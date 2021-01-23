<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Cats\CatDocumentaryTradition;

class CatDocumentaryTraditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $document = new CatDocumentaryTradition();
        $document->name = 'Original';
        $document->save();

        $document = new CatDocumentaryTradition();
        $document->name = 'Fotocopia';
        $document->save();    
    }
}

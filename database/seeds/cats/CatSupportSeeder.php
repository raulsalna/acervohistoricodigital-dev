<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Cats\CatSupport;

class CatSupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $support = new CatSupport();
        $support->name = 'Papel';
        $support->save();

        $support = new CatSupport();
        $support->name = 'Vidrio';
        $support->save();

        $support = new CatSupport();
        $support->name = 'Fotografia digital';
        $support->save();

        $support = new CatSupport();
        $support->name = 'Video';
        $support->save();

        $support = new CatSupport();
        $support->name = 'Audio';
        $support->save();
    }
}

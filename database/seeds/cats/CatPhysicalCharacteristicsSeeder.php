<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Cats\CatPhysicalCharacteristics;

class CatPhysicalCharacteristicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $physic = new CatPhysicalCharacteristics();
        $physic->name = 'Buen estado';
        $physic->save();

        $physic = new CatPhysicalCharacteristics();
        $physic->name = 'Mutilado';
        $physic->save();
    }
}

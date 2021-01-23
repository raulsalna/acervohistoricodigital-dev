<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            'id'                => 1,
            'username'          =>'yrodrigueza',
            'cat_profile_id'    => 1,
            'cat_transaction_id'    => null,
            'name'              => 'yair',
            'firstName'         => 'rodriguez',
            'secondName'        => 'aparicio',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'id'                => 2,
            'username'          =>'igomez',
            'cat_profile_id'    => 2,
            'cat_transaction_id'    => 341,
            'name'              => 'ivan',
            'firstName'         => 'perdomo',
            'secondName'        => 'gomez',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'id'                => 3,
            'username'          =>'jrojo',
            'cat_profile_id'    => 2,
            'cat_transaction_id'    => 341,
            'name'              => 'juan',
            'firstName'         => 'rojo',
            'secondName'        => 'marquez',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'id'                => 4,
            'username'          =>'jfloreso',
            'cat_profile_id'    => 1,
            'cat_transaction_id'    => 341,
            'name'              => 'jorge',
            'firstName'         => 'flores',
            'secondName'        => 'o',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'id'                => 5,
            'username'          =>'anavia',
            'cat_profile_id'    => 1,
            'cat_transaction_id'    => null,
            'name'              => 'alberto',
            'firstName'         => 'navia',
            'secondName'        => 'roa',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'id'                => 6,
            'username'          =>'marcosp',
            'cat_profile_id'    => 1,
            'cat_transaction_id'    => null,
            'name'              => 'marcos',
            'firstName'         => 'piñeiro',
            'secondName'        => 'villegas',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'id'                => 7,
            'username'          =>'adrianr',
            'cat_profile_id'    => 1,
            'cat_transaction_id'    => null,
            'name'              => 'adrian',
            'firstName'         => 'ramirez',
            'secondName'        => 'padilla',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'id'                => 8,
            'username'          =>'jessicat',
            'cat_profile_id'    => 1,
            'cat_transaction_id'    => null,
            'name'              => 'Jessica Magalli',
            'firstName'         => 'Torres',
            'secondName'        => 'Mejía',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'id'                => 9,
            'username'          =>'cibersoc_6tin',
            'cat_profile_id'    => 2,
            'cat_transaction_id'    => 341,
            'name'              => 'cibersoc',
            'firstName'         => '6',
            'secondName'        => 'tin',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'id'                => 10,
            'username'          =>'cibersoc_5tin',
            'cat_profile_id'    => 2,
            'cat_transaction_id'    => 341,
            'name'              => 'cibersoc',
            'firstName'         => '5',
            'secondName'        => 'tin',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        [
            'id'                => 11,
            'username'          =>'cibersoc_4tin',
            'cat_profile_id'    => 1,
            'cat_transaction_id'    => null,
            'name'              => 'cibersoc',
            'firstName'         => 'cibersoc',
            'secondName'        => 'cibersoc',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ],
        ]);

    }
}

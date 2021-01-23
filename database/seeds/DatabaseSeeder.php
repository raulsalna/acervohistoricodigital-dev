<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      CatProfileSeeder::class,
      UsersTableSeeder::class,
      CatDocumentaryTraditionSeeder::class,
      CatPhysicalCharacteristicsSeeder::class,
      CatProducerSeeder::class,
      CatSupportSeeder::class,
      GeoCatIdiomsSeeder::class,
      CatDocumentaryGroupSeeder::class,
      CatBoxSeeder::class,
      CatFilesSeeder::class,
      CatTransactionTypeSeeder::class,


    ]);
  }
}

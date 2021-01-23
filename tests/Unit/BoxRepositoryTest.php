<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Box\Box;
use App\Repositories\Box\BoxRepository;
use App\Repositories\BaseRepository;
use SebastianBergmann\CodeCoverage\Report\Xml\Tests;
// use Tests\TestCase;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BoxRepositoryTest extends \Tests\TestCase
{
  //DatabaseTransactions to make test only on transactions
use DatabaseTransactions;
  /**
   * A basic unit test example.
   *
   * @return void
   */
  public function testShowBox()
  {
    $repository = new BoxRepository(new Box());
    $result = $repository->show(encrypt(1));
    $this->assertEquals(1, $result['id']);
  }

  public function testCreateBox()
  {
    $faker = \Faker\Factory::create('es_MX');
    $data = [
      'fileName' => $faker->firstname,
      'place' => $faker->country,
      'depositRoom' => 'depositRoom ' . $faker->randomNumber($nbDigits = 3, $strict = true),
      'corridor' => 'corridor ' . $faker->randomLetter,
      'shelf' => 'shelf ' . $faker->randomLetter,
      'strep' => 'strep ' . $faker->randomLetter,
      'box' => 'box ' . $faker->randomNumber($nbDigits = 3, $strict = true),
    ];
    $dataEdit = [
      'fileName' => $faker->firstname,
      'place' => $faker->country,
      'depositRoom' => 'depositRoom ' . $faker->randomNumber($nbDigits = 3, $strict = true),
      'corridor' => 'corridor ' . $faker->randomLetter,
      'shelf' => 'shelf ' . $faker->randomLetter,
      'strep' => 'strep ' . $faker->randomLetter,
      'box' => 'box ' . $faker->randomNumber($nbDigits = 3, $strict = true),
    ];
    $repository = new BoxRepository(new Box());
    $result = $repository->create($data);
    $this->assertEquals(true, $result->wasRecentlyCreated);
    //Update
    $resultEdit = $repository->update(encrypt($result['id']), $dataEdit);
    $this->assertNotEquals($result['fileName'], $resultEdit['fileName']);
    //TestDelete
    $resultDelete = $repository->delete(encrypt($result['id']));
    $this->assertEquals(true, $resultDelete);
  }

  public function testDatabase()
  {
    $this->assertDatabaseHas('boxes', ['id' => 1]);
  }
  public function testApiBox()
  {
    $faker = \Faker\Factory::create('es_MX');


    $data = [
      'fileName' => $faker->firstname,
      'place' => $faker->country,
      'depositRoom' => 'depositRoom ' . $faker->randomNumber($nbDigits = 3, $strict = true),
      'corridor' => 'corridor ' . $faker->randomLetter,
      'shelf' => 'shelf ' . $faker->randomLetter,
      'strep' => 'strep ' . $faker->randomLetter,
      'box' => 'box ' . $faker->randomNumber($nbDigits = 3, $strict = true),
    ];
    $dataEdit = [
      'fileName' => $faker->firstname,
      'place' => $faker->country,
      'depositRoom' => 'depositRoom ' . $faker->randomNumber($nbDigits = 3, $strict = true),
      'corridor' => 'corridor ' . $faker->randomLetter,
      'shelf' => 'shelf ' . $faker->randomLetter,
      'strep' => 'strep ' . $faker->randomLetter,
      'box' => 'box ' . $faker->randomNumber($nbDigits = 3, $strict = true),
    ];
    //Test api Create Box
    $user = User::where('username', 'yrodrigueza')->first();
    $this->withExceptionHandling();
    $this->actingAs($user, 'api');
    $resultCreate = $this->json('POST', route('box.store'), $data)->assertStatus(200);
    //Test api Show Box
    $boxlast = Box::get()->last();
    $resultShow = $this->json('GET', route('box.show', encrypt($boxlast->id)))->assertStatus(200);
    //Test api Edit Box
    $boxlast = Box::get()->last();
    $resultEdit = $this->json('PUT', route('box.update', encrypt($boxlast->id)), $dataEdit)->assertStatus(200);
    //Test api Delete Box
    $resultDelete = $this->json('DELETE', route('box.destroy', encrypt($boxlast->id)))->assertStatus(200);
  }
}

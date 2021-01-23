<?php

namespace App\Http\Controllers;

ini_set('memory_limit', '-1');
set_time_limit(0);
ini_set('max_execution_time',0);

use App\Imports\ArchiveImport;
use Maatwebsite\Excel\Validators\Failure;
use App\Imports\SheetImport;
use App\Imports\SheetImport2;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archive\StoreArchiveRequest;
use App\Http\Requests\Archive\UpdateArchiveRequest;
use App\Repositories\Archive\ArchiveRepository;
use App\Http\Models\Archive\Archive;
use App\Http\Models\Archive\Languages;
use App\Http\Models\Archive\Support;
use App\Http\Models\Archive\Producer;
use ErrorException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel;

class ArchiveController extends Controller
{

  protected $archiveRepo;

  public function __construct(ArchiveRepository $rchiveRepository)
  {
    $this->archiveRepo = $rchiveRepository;
  }

  public function index()
  {
    $relations = [];

    try {
      $archives = $this->archiveRepo->getAll($relations);

      return response()->json([
        'archives' => $archives
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'No se pudo completar la acción : ' . $e->getMessage()
      ], 500);
    }
  }


  public function store(StoreArchiveRequest $request)
  {
    //valida que no existe registrro del titulo
    $titleToFind = $request->get('title');
    $existTitle  = $this->archiveRepo->findTitleArchive($titleToFind);
    if ($existTitle == true) {
      return response()->json([
        'titulo_existe' => true
      ]);
    }
    //valida que no existe registrro del titulo FIN

    try {
      $data = $request->all();
      $archive = $this->archiveRepo->create($data);

      foreach ($request->languages as $language) {
        $languages = new Languages;
        $languages['form_archives_id'] = $archive->id;
        $languages['geo_cat_idioms_id'] = $language;
        $languages->save();
      }
      foreach ($request->support as $support) {
        $supports = new Support;
        $supports['form_archives_id'] = $archive->id;
        $supports['cat_support_id'] = $support;
        $supports->save();
      }
      foreach ($request->producer as $producer) {
        $producers = new Producer;
        $producers['form_archives_id'] = $archive->id;
        $producers['cat_producer_id'] = $producer;
        $producers->save();
      }

      return response()->json([
        'success' => true,
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => "Error..... {$e->getMessage()} ",
        'errorcode' => $e->getCode(),
      ], 500);
    }
  }


  public function update(UpdateArchiveRequest $archive, $hash)
  {
    try {

      $data = $archive->all();
      $archive = $this->archiveRepo->update($hash, $data);


      DB::table('form_archives_languages')
        ->where('form_archives_id', $data['id'])
        ->delete();

      foreach ($data['languages'] as $language) {
        $languages = new Languages;
        $languages['form_archives_id'] = $archive->id;
        $languages['geo_cat_idioms_id'] = $language;
        $languages->save();
      }

      DB::table('form_archives_supports')
        ->where('form_archives_id', $data['id'])
        ->delete();

      foreach ($data['support'] as $support) {
        $supports = new Support;
        $supports['form_archives_id'] = $archive->id;
        $supports['cat_support_id'] = $support;
        $supports->save();
      }

      DB::table('form_archives_producers')
        ->where('form_archives_id', $data['id'])
        ->delete();

      foreach ($data['producer'] as $producer) {
        $producers = new Producer;
        $producers['form_archives_id'] = $archive->id;
        $producers['cat_producer_id'] = $producer;
        $producers->save();
      }

      return response()->json([
        'success' => true,
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage()
      ]);
    }
  }


  public function show($archive)
  {

    $relations = [];
    try {
      $archive = $this->archiveRepo->find($archive, $relations);

      return response()->json([
        'archive' => $archive
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'No se pudo completar la acción: ' . $e->getMessage()
      ], 500);
    }
  }

  public function destroy($archive)
  {
    try {
      $this->archiveRepo->delete($archive);
      return response()->json([
        'success' => true,
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'No se pudo completar la acción',
      ], 500);
    }
  }

  public function listAndFilterArchive(Request $request)
  {
    $relations = [];

    $placement = $request->get('filePlace');
    $title = $request->get('title ');
    $openingDate = $request->get('startDate');
    $search = $request->get('search');
    $data = $request;
    try {
      $archives = Archive::orderBy('id', 'desc')
        ->with($relations)
        ->search($search)
        ->placement($placement)
        ->title($title)
        ->openingDate($openingDate)
        ->paginate($data['perPage']);
      return response()->json([
        'archives' => $archives
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'No se pudo completar la acción  ' . $e->getMessage()
      ], 500);
    }
  }

  public function importExcel(Request $request)
  {
    try {
      DB::beginTransaction();
      Excel::import(new SheetImport, $request->document);
      Excel::import(new SheetImport2, $request->document);
      DB::commit();
      return response()->json([
        'success'    => true,
      ]);
    } catch (\Maatwebsite\Excel\Validators\ValidationException $ex) {
      $failures = $ex->failures();

      foreach ($failures as $failure) {
        $failure->row(); // row that went wrong
        $failure->attribute(); // either heading key (if using heading row concern) or column index
        $failure->errors(); // Actual error messages from Laravel validator
        $failure->values(); // The values of the row that has failed.
      }
      return response()->json([
        'success' => false,
        'row' => $failure->row(),
        'attribute' => $failure->attribute(),
        'errors' => $failure->errors(),
        'values' =>  $failure->values()
      ]);
    }
  }
}

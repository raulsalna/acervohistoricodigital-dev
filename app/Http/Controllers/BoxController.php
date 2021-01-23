<?php

namespace App\Http\Controllers;

use App\Http\Models\Box\Box;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Event;
use App\Http\Requests\Box\StoreBoxRequest;
use App\Http\Requests\Box\UpdateBoxRequest;
use App\Repositories\Box\BoxRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BoxController extends Controller
{
  protected $boxRepo;

  public function __construct(BoxRepository $boxRepository)
  {
    $this->boxRepo = $boxRepository;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $relations = [];
    try {
      $boxs = $this->boxRepo->getAll($relations);
      return response()->json([
        'boxs' => $boxs
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'No se pudo completar la acción Boxs: ' . $e->getMessage()
      ], 500);
    }
  }
  public function listAndFilterBox(Request $request)
  {
    $relations = [];
    $depositRoom = $request->get('depositRoom');
    $corridor = $request->get('corridor');
    $placebox = $request->get('placeBox');
    $namebox = $request->get('nameBox');
    $startdate = $request->get('startDate');
    $search = $request->get('search');
    $data = $request;
    try {
      $boxs = Box::orderBy('id', 'desc')
        ->with($relations)
        ->search($search)
        ->placebox($placebox)
        ->depositRoom($depositRoom)
        ->corridor($corridor)
        ->namebox($namebox)
        ->startdate($startdate)
        ->paginate($data['perPage']);
      return response()->json([
        'boxs' => $boxs
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'No se pudo completar la acción listAndFilterBox with ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreBoxRequest $request)
  {
    //  $validated = $request->validated();
    //valida que no existe registrro de la caja
    $boxToFind = $request->get('box');
    $existBox  = $this->boxRepo->findBox($boxToFind);
    if ($existBox == true) {
      return response()->json([
        'box_existe' => true
      ]);
    }
    //valida que no existe registrro de la caja FIN

    //valida que no existe registrro del titulo
    $titleToFind = $request->get('fileName');
    $existTitle  = $this->boxRepo->findTitle($titleToFind);
    if ($existTitle == true) {
      return response()->json([
        'titulo_existe' => true
      ]);
    }
    //valida que no existe registrro del titulo FIN

    try {
      $data = $request->all();
      // $data['usuario_id'] = Auth::id();
      // $data['status_id'] = 1;
      $box = $this->boxRepo->create($data);
      return response()->json([
        'success' => true,
        'box'     => $box->id,
      ]);
    } catch (\Exception $e) {

      return response()->json([
        'success' => false,
        'message' => "No se pudo GuardarBoxs. {$e->getMessage()} ",
        'errorcode' => $e->getMessage(),
      ], 500);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Box  $box
   * @return \Illuminate\Http\Response
   */
  // public function show(Box $box)
  // {
  //   //
  // }

  public function show($box)
  {
    $relations = [];

    try {
      $boxs = $this->boxRepo->find($box, $relations);
      return response()->json([
        'boxs' => $boxs
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'No se pudo completar la acción mostrar la Caja: ' . $e->getMessage()
      ], 500);
    }
  }
  /**
   * Search Title
   */
  public function searchTitle($titleToSearch)
  {
    try {
      $boxTitle = $this->boxRepo->findTitle($titleToSearch);
      return response()->json([
        'boxTitle' => $boxTitle
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'No se pudo completar la acción buscar titulo de la Caja: ' . $e->getMessage()
      ], 500);
    }
  }




  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Box  $box
   * @return \Illuminate\Http\Response
   */
  public function edit($box)
  {
    //
    $relations = [];

    try {
      $boxs = $this->boxRepo->find($box, $relations);

      return response()->json([
        'boxs' => $boxs
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'No se pudo completar la acción: ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Box  $box
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateBoxRequest $request, $hash)
  {
    //valida que no existe registrro del titulo
    $titleToFind = $request->get('fileName');
    $existTitle  = $this->boxRepo->findTitleComplete($titleToFind);
      if ($existTitle && ($request->get('id') !=$existTitle['id'] )) {
      return response()->json([
        'titulo_existe' => true
      ]);
    }
    //valida que no existe registrro del titulo FIN

    try {
      $data = $request->all();
      // $data['user_id'] = Auth::id();
      $boxs = $this->boxRepo->update($hash, $data);
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

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Box  $box
   * @return \Illuminate\Http\Response
   */
  public function destroy($box)
  {
    try {
      $this->boxRepo->delete($box);
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
}

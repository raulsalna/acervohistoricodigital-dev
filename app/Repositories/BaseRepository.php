<?php

namespace app\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Event;




abstract class BaseRepository
{
  //abstract public function getModel();
  protected $model;

  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  public function find($id, $relations = '')
  {
    if (!empty($relations)) return $this->model::with($relations)->find(decrypt($id));
    else return $this->model->find(decrypt($id));
  }
  public function findTitle($titleToSearch)
  {
    $title = $this->model::where('fileName', $titleToSearch)->exists();
    return ($title);
  }
  public function findTitleArchive($titleToSearch)
  {
    $title = $this->model::where('title', $titleToSearch)->exists();
    return ($title);
  }
  public function findTitleComplete($titleToSearch)
  {
    $title = $this->model::where('fileName', $titleToSearch)->first();
    return ($title);
  }
  public function findBox($boxToFind)
  {
    $box = $this->model::where('box', $boxToFind)->exists();
    return ($box);
  }

  public function getAll($relations = '')
  {
    if (!empty($relations)) {
      return $this->model->with($relations)->get();
    } else {
      return $this->model->get();
    }
  }


  public function create($data)
  {
    // try {
      $createBox = $this->model->create($data);
      return $createBox;
    // } catch (\Exception $e) {
    //   return response()->json([
    //     'success' => false,
    //     'message' => "No se puede guardar el registro. {$e->getMessage()} ",
    //   ], 500);
    // }
  }

  public function update($id, $data)
  {
    $object = $this->model->find(decrypt($id));
    $object->update($data);
    return $object;
  }


  public function show($id, $relations = '')
  {
    if (!empty($relations)) return $this->model::with($relations)->find(decrypt($id));
    else return $this->model->find(decrypt($id));
  }

  public function delete($id)
  {
    $registry = $this->model->find(decrypt($id));
    return $registry->delete();
  }

  public function paginate($id)
  {
    return $this->model->paginate($id);
  }



}

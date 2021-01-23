<?php
namespace  app\Repositories\Box;

use App\Http\Models\Box\Box;
use App\Repositories\BaseRepository;
use App\Http\Models\UserRepresentation;
class BoxRepository extends BaseRepository
{

    protected $model;

    public function __construct(Box $model)
    {
        $this->model = $model;
    }

}

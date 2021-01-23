<?php
namespace  app\Repositories\Archive;

use App\Http\Models\Archive\Archive;
use App\Repositories\BaseRepository;
class ArchiveRepository extends BaseRepository
{

    protected $model;

    public function __construct(Archive $model)
    {
        $this->model = $model;
    }

}

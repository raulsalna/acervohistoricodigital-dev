<?php
namespace  app\Repositories\User;

use App\User;
use App\Repositories\BaseRepository;
use App\Http\Models\UserRepresentation;
class UserRepository extends BaseRepository
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function createUser($request)
    {

            if($request->cat_profile_id === 1){

                $data = $request->all();
                $user = new User;
                $user['username'] = $data['username'];
                $user['name'] = $data['name'];
                $user['firstName'] = $data['firstName'];
                $user['secondName'] = $data['secondName'];
                $user['cat_profile_id'] = $data['cat_profile_id'];
                $user->save();

            }else{
              $requestUserAttributes = $request->userAttributes;

                $data = $request->all();
                $user = new User;
                $user['username'] = $data['username'];
                $user['name'] = $data['name'];
                $user['firstName'] = $data['firstName'];
                $user['secondName'] = $data['secondName'];
                $user['cat_profile_id'] = $data['cat_profile_id'];
                $user['cat_transaction_id'] = $requestUserAttributes;
                $user->save();

                if($request->userRepresentation){
                    foreach ($request->userRepresentation as $representation){
                        $user_representation = new UserRepresentation;
                        $user_representation['user_id'] = $user->id;
                        $user_representation['representation_id'] = $representation;
                        $user_representation->save();
                    }
                }



            }


    }

    public function realSoftDelete($id) {
        $user = self::find($id);
        $user->delete();
    }
}

<?php
namespace App\Http\Controllers\Administrador;
//namespace App\Http\Controllers\Intgra;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneralController;
use App\Http\Models\Cats\CatProfile;
use App\Http\Models\Transaction;
use App\User;
use App\Http\Models\UserRepresentation;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\User\UserRepository;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UsersController extends Controller
{

    // protected donde quiero guardar
    protected $UserRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->UserRepo = $userRepository;
    }

    public function index(Request $request)
    {
        try
        {
            if ($request->wantsJson())
            {
                $data = $request->all();

                $users = User::with('profile')->search($data['search'])->orderBy('cat_profile_id', 'DESC')
                    ->paginate($data['perPage']);

                return response()->json(['users' => $users, 'success' => true]);
            }
            else
            {
                return response()->view('errors.404', [], 404);
            }

        }
        catch(Exception $e)
        {

            return response()->json(['success' => false, 'message' => $e->getMessage() ]);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try
        {
            $userExist = User::where('username', '=',$request->username)->first();
            if ($userExist !== null) {
                return response()->json(['exist' => true, ]);

            }else{

                DB::beginTransaction();
                $this->UserRepo->createUser($request);
                DB::commit();

                return response()->json(['success' => true, ]);
            }
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return response()->json(['success' => false]);
        }
    }


    public function listAndFilterUsers(Request $request)
    {
        $relations = ['profile'];

        $search= $request->get('search');
        $data = $request;

        if($search != null)
        {
            $users = User::with('profile')->search($data['search'])->orderBy('cat_profile_id', 'DESC')
            ->with($relations)
            ->paginate($data['perPage']);
                return response()->json([
                'users' => $users], 200);
        }

        try {
            $users=User::orderBy('id', 'desc')
            ->with($relations)
            ->paginate($data['perPage']);
                return response()->json([
              'users' => $users
            ], 200);
            } catch (\Exception $e) {
                return response()->json([
            'message' => 'No se pudo completar la acción listandfiltersactivity with ' . $e->getMessage()
          ], 500);
        }


    }


    public function edit(Request $request, $id)
    {

        try
        {
            if ($request->wantsJson())
            {

                $user = User::find(decrypt($id));
                $profiles = CatProfile::where('isActive', 1)->get(['id', 'name']);

                $userform = ['cat_profile_id' => $user->cat_profile_id, 'username' => $user->username, 'name' => $user->name, 'firstName' => $user->firstName, 'secondName' => $user->secondName, 'cat_transaction_id' => $user->cat_transaction_id];
                return response()->json(['profiles' => $profiles, 'userForm' => $userform,  'success' => true]);

            }
            else
            {
                return response()->view('errors.404', [], 404);
            }

        }
        catch(Exception $e)
        {

            return response()->json(['success' => false, 'message' => $e->getMessage() ]);
        }
    }

    public function update(Request $request, $id)
    {

        try
        {

            $requestUser = $request->userForm;
            $requestUserAttributes = $request->userAttributes;

            if ($requestUser)
            {
                DB::beginTransaction();
                $user = User::find(decrypt($id));
                $user['name'] = $requestUser['name'];
                $user['firstName'] = $requestUser['firstName'];
                $user['secondName'] = $requestUser['secondName'];
                $user['cat_profile_id'] = $requestUser['cat_profile_id'];
                $user['cat_transaction_id'] = $requestUserAttributes;
                $user->save();

                GeneralController::saveTransactionLog(3, 'Edita al usuario: ' . $user->username);

                DB::commit();

                return response()
                    ->json(['success' => true], 200);

            }
            else
            {
                return response()
                    ->view('errors.404', [], 404);
            }

        }

        catch(Exception $e)
        {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => $e->getMessage() ], 400);
        }
    }

    public function destroy($id)
    {

        $this
            ->UserRepo
            ->delete($id);
        return response()->json(['success' => true]);
    }

    public function getUserlog(Request $request)
    {
      // return $request->user();
      try
      {

          $user = DB::connection(static ::$connection)->table('users')
              ->join('employees', 'users.employee_id', '=', 'employees.id')
              ->select('users.username', 'employees.name', 'employees.firstName', 'secondName')
              ->where('users.username', $request->input('username'))
              ->first();
          return response()
              ->json(['userForm' => $user, ], 200);
      }
      catch(\Exception $e)
      {
          return response()->json(['message' => 'No se pudo completar la acción: ' . $e->getMessage() ], 300);
      }

    }

    private static $connection = 'intgra';
    /*Esta función trae la información del usuario desde de la base de datos de intgra*/
    public function getUser(Request $request)
    {
        try
        {

            $user = DB::connection(static ::$connection)->table('users')
                ->join('employees', 'users.employee_id', '=', 'employees.id')
                ->select('users.username', 'employees.name', 'employees.firstName', 'secondName')
                ->where('users.username', $request->input('username'))
                ->first();
            return response()
                ->json(['userForm' => $user, ], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['message' => 'No se pudo completar la acción: ' . $e->getMessage() ], 300);
        }
    }

}


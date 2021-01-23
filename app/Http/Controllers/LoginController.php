<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function callAPI($method, $url, $data, $headers = false)
    {

        $curl = curl_init();

        switch ( $method ) {
            case 'POST':
                curl_setopt( $curl, CURLOPT_POST, 1 );
                if ( $data )
                    curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
                break;
            case 'PUT':
                curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
                if ( $data )
                    curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
                break;
            default:
                if ( $data )
                    $url = sprintf( "%s?%s", $url, http_build_query( $data ) );
        }

        // OPTIONS:
        curl_setopt( $curl, CURLOPT_URL, $url );
        if ( !$headers ) {
            curl_setopt( $curl, CURLOPT_HTTPHEADER, [
                'APIKEY: 111111111111111111111',
                'Content-Type: application/json',
            ] );
        }
        else {
            curl_setopt( $curl, CURLOPT_HTTPHEADER, [
                'APIKEY: 111111111111111111111',
                'Content-Type: application/json',
                $headers
            ] );
        }

        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );

        // EXECUTE:
        $result = curl_exec( $curl );
        if ( !$result ) {
            die('Connection Failure');
        }
        curl_close( $curl );
        return $result;

    }

    //Login QA
//     public function login(Request $request)
//     {
//         try {
// //            if (trim($request->key) != '' && trim($request->token) != '') {
//              if (trim($request->key) != '' && trim($request->token) != '') {

//                 $data      = ["key" => $request->key, "token" => $request->token];
//                 $make_call = $this->callAPI('POST', 'https://intgraqa.sre.gob.mx/api/checkKey', json_encode($data));
//                 $response  = json_decode($make_call, true);

//                 if (isset($response) && isset($response['authenticated']) && $response['authenticated'] === true) {
//                 //if ( true ) {

//                     auth()->loginUsingId( User::where( 'username', $response['username'] )->first()->id );

//                     $user = auth()->user();
//                     $token = $user->createToken( 'ACERVO_session' )->accessToken;

//                     if ( $token ) {

//                         /* CHECK IF THE USER HAS AN ACTIVE SESSIÓN */
//                         $sessions = \DB::table('oauth_access_tokens')->where('user_id', $user->id)
//                         ->where('revoked', false)
//                         ->count();

//                         \DB::table('oauth_access_tokens')->where('user_id', $user->id)
//                             ->update(['revoked' => true]);
//                         Auth::loginUsingId($user->id);

//                         return response()->json( [
//                             'authenticated'             => true,
//                             'ACERVO_session'            => $token,
//                             'ACERVO_hash'               => $user->hash,
//                             'user'                      => static::getSessionInfo( $user->id ),
//                             'ACERVO_session_expiration' => date( 'D M d Y H:i:s', strtotime( "+8 hours" ) ),
//                         ], 200 );
//                     }
//                     else {
//                         return response()->json( [
//                             'authenticated' => false,
//                         ], 200 );
//                     }
//                 }
//                 else {
//                     return response()->json( [
//                         'authenticated' => false,
//                     ], 200 );
//                 }
//             }
//             else {
//                 return response()->json( [
//                     'authenticated' => false,
//                 ], 200 );
//             }
//         }
//         catch ( \Exception $e ) {
//             return response()->json( [
//                 'success' => false,
//                 'message' => $e->getMessage()
//             ] );
//         }
//     }

// login desarrollo
public function login(Request $request)
    {

        try {
//            if (trim($request->key) != '' && trim($request->token) != '') {
            if ( true ) {

//                $data      = ["key" => $request->key, "token" => $request->token];
//                $make_call = $this->callAPI('POST', 'https://intgraqa.sre.gob.mx/api/checkKey', json_encode($data));
//                $response  = json_decode($make_call, true);

//                if (isset($response) && isset($response['authenticated']) && $response['authenticated'] === true) {
                if ( true ) {

                    auth()->loginUsingId( User::where( 'username', $request->user )->first()->id );

                    $user = auth()->user();
                    $token = $user->createToken( 'ACERVO_session' )->accessToken;

                    if ( $token ) {
                        //GeneralController::saveTransactionLog(1,
                          //  'El usuario ' . $user->username . ' ingreso al sistema');

                        return response()->json( [
                            'authenticated'             => true,
                            'ACERVO_session'            => $token,
                            'ACERVO_hash'               => $user->hash,
                            'user'                      => static::getSessionInfo( $user->id ),
                            'ACERVO_session_expiration' => date( 'D M d Y H:i:s', strtotime( "+8 hours" ) ),
                        ], 200 );
                    }
                    else {
                        return response()->json( [
                            'authenticated' => false,
                        ], 200 );
                    }
                }
                else {
                    return response()->json( [
                        'authenticated' => false,
                    ], 200 );
                }
            }
            else {
                return response()->json( [
                    'authenticated' => false,
                ], 200 );
            }
        }
        catch ( \Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ] );
        }
    }


    public function user($id)
    {
        try {
            return response()->json( [
                'user' => static::getSessionInfo( decrypt( $id ) )
            ], 200 );

        }
        catch ( \Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ] );
        }
    }

    public function logout()
    {

        $authenticated = true;
        auth()->logout();

        if ( !auth()->check() ) {
            $authenticated = false;
        }

        return response()->json( [
            'authenticated' => $authenticated
        ], 200 );
    }

    public static function getSessionInfo($id)
    {
        $user = User::find( $id );

        return (object)[
            'hash_id'    => $user->hash,
            'fullname'   => $user->full_name,
            'name'       => $user->name,
            'firstName'  => $user->firstName,
            'secondName' => $user->secondName,
            'profile'    => $user->cat_profile_id,
            'cat_transaction_id' =>$user->cat_transaction_id,
        ];
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class CacheControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $valid = true;

        foreach ($request->server as $key => $value){
            if ($key == 'REQUEST_URI' ){
                if ($value != "/"){

                    if (strpos($value,"api/get-lang/") !=false){
                        $valid = false;
                    }
                    if(strpos($value,'responseType=blob')!=false){
                        $valid = false;
                    }
                    if ($value == "/api/get-langs" || $value == "/administracion/panel"){
                        $valid = false;
                    }
                }

            }
        }
       /*foreach ($request->server as $key => $value){
           if ($key == 'REQUEST_URI' && $value == "/api/get-lang/es"){
               $valid = false;
           }
           if ($key == 'REQUEST_URI' && $value == "/api/get-langs") {
               $valid = false;
           }
           if ($key == 'REQUEST_URI' && $value == "/administracion/panel") {
               $valid = false;
           }
           if ($key == 'REQUEST_URI'){
               if(strpos($value,'responseType=blob')){
                   $valid = false;
               }
           }
        }*/

        if ($valid==true){
            $response->headers->set('Cache-Control', "no-cache='Set-Cookie', no-store, must-revalidate");
            $response->headers->set('pragma', "no-cache");
            $response->headers->set('no-cache', "Set-Cookie, Set-Directiva Cookie2");

            // $response->header('pragma', 'no-cache');
            // $response->header('no-cache', 'Set-Cookie, Set-Directiva Cookie2');
        }

        return $response;
    }
}

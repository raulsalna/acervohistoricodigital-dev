<?php namespace App\Http\Controllers;



use App\Http\Models\Transaction;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public static function saveTransactionLog($type, $action)
    {
        $transaction = new Transaction();

        $transaction->user_id = auth()->user()->id;
        $transaction->cat_transaction_type_id = $type;
        $transaction->action = $action;
        $transaction->save();
    }

   

    
}

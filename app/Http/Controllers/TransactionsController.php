<?php

namespace App\Http\Controllers;

use App\Http\Models\PublicTokens;
use App\Http\Models\Transaction;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $date = Carbon::now()->toDateString();
            PublicTokens::whereDate('limitDate','<', $date)->update(['isActive' => false]);

            $transaction = new Transaction();

            $transaction->user_id = auth()->user()->getAuthIdentifier();
            $transaction->fill($request->all());
            $transaction->save();

            DB::commit();

            return response()->json([
                'success' => true
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}

<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllCollection;
use App\Models\ExpenseDriver;
use App\Models\Expense;
use App\Models\Income;
use App\Models\ExpenseEmployee;
class WalletController extends Controller 
{
    public function wallet(){
        $expenses = array_sum(ExpenseDriver::get()->pluck('value')->toArray()) + 
        array_sum(ExpenseEmployee::get()->pluck('value')->toArray()) +  array_sum(Expense::get()->pluck('paid')->toArray());
        $allcolletions =  array_sum(AllCollection::get()->pluck('money_taken')->toArray()) + 
        array_sum(Income::get()->pluck('value')->toArray());
        $rest = $allcolletions - $expenses;
        return view('admindashboard.wallet.wallet',compact(["expenses","allcolletions","rest"]));
    }public function walletfilter(Request $request){
    $datepicker = explode(" - ",$request->get('datepicker'));
     $from = explode(" - ",$request->get('datepicker'))[0];
     $to = explode(" - ",$request->get('datepicker'))[1];
         $expenses = array_sum(ExpenseDriver::whereBetween("created_at",[$from,$to])
         ->get()->pluck('value')->toArray()) +  array_sum(Expense::whereBetween("created_at",[$from,$to])->get()->pluck('paid')->toArray()) +
        array_sum(ExpenseEmployee::whereBetween("created_at",[$from,$to])->get()->pluck('value')->toArray());
        $allcolletions =  array_sum(AllCollection::whereBetween("created_at",[$from,$to])->get()->pluck('money_taken')->toArray()) + 
         array_sum(Income::whereBetween("created_at",[$from,$to])->get()->pluck('value')->toArray());
        $rest = $allcolletions - $expenses;
          return response()->json(['status' => true,'expenses' => $expenses,'collections' => $allcolletions,
        'rest' => $allcolletions - $expenses]);
    }
}
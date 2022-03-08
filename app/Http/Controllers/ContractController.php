<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Contract;
class ContractController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    
    public function save(Request $request)
    {
    
        if($request->flg1 == 0){
            $con = new Contract;
            $con->contract_type_code = $request->contract_type_code;
            $con->contract_no = $request->contract_no;
            $con->begin_date = $request->begin_date;
            $con->end_date = $request->end_date;
            $con->contract_notes = $request->contract_notes;
            $con->company_id = $request->company_id;
            $con->save();
        }
        if($request->flg1 == 1){
            $con = DB::table('CONTRACT_INFO')
            ->where('contract_id', $request->hid1)
            ->update(['contract_type_code' => $request->contract_type_code,'contract_no' => $request->contract_no,'begin_date' => to_date('$request->begin_date'),'end_date' => to_date('$request->end_date'),
            'contract_notes' => $request->contract_notes]);
        }
      
        return back()->withInput();
    }
  
  
}

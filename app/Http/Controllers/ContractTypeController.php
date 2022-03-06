<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\ContractType;
class ContractTypeController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $id=Auth::user()->id;
        $types= DB::select("select * from SET_CONTRACT_TYPES t");
        return view('const.contracttype', compact('types'));
    }
    public function save(Request $request)
    {

        if($request->flg == 0){
            $con = new ContractType;
            $con->contract_name = $request->contract_name;
            $con->save();
        }
        if($request->flg == 1){
            $con = DB::table('SET_CONTRACT_TYPES')
            ->where('contract_type_code', $request->hid)
            ->update(['contract_name' => $request->contract_name]);
        }
      
        return Redirect('contractType');
    }
  
  
}

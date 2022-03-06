<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Wagon;
class CompanyController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $id=Auth::user()->id;
        $companies= DB::select("select * from COMPANY_INFO t");
        $categories= DB::select("select * from SET_WAGON_CATEGORIES t");
        $companies= DB::select("select * from COMPANY_INFO t");
        $company= DB::select("select * from COMPANY_INFO t where company_id = $id")[0];
        $contract_type= DB::select("select * from SET_CONTRACT_TYPES t");
        $countries= DB::select("select * from SET_COUNTRIES t");
        $factories= DB::select("select * from SET_FACTORIES t");
        $models= DB::select("select * from SET_WAGON_MODELS t");
        $railways= DB::select("select * from SET_RAILWAYS t");
        $wagon_depos= DB::select("select * from SET_DEPOS t");
        $wagons= DB::select("select * from COMPANY_WAGONS t where company_id = $id");
        return view('const.company', compact('companies','categories','companies','company','contract_type','countries','factories','models','railways','models','wagon_depos','wagons'));
    }
    public function save(Request $request)
    {
        if($request->type == 1){
            $company = new Company;
            $company->company_name = $request->rcode;
            $company->nmark = $request->wagno;
            $company->is_owner = $request->model_id;
            $company->is_arrender = $request->model_no;
            $company->note = $request->catcode;
            $company->address =$request->factory_code;
            $company->phone =$request->factory_date;
            $company->rcode = $request->axes;
            $company->company_code = $request->axe_capacity;
            $company->subway_name = $request->brutto;
            $company->registered_date = $request->netto;
            $company->save();
        }
        if($request->type == 2){
            $company = DB::table('COMPANY_INFO')
            ->where('company_id', $request->company_id)
            ->update(['company_name' => $request->company_name,'nmark' => $request->nmark,'is_owner' => $request->is_owner,
            'is_arrender' => $request->is_arrender,'note' => $request->note,
            'address' => $request->address,'phone' => $request->phone,'rcode' => $request->rcode,'company_code' => $request->company_code,
            'subway_name' => $request->subway_name,'registered_date' => $request->registered_date ]);
        }
      
        return Redirect('home');
    }
  
}

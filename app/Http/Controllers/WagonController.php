<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class WagonController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $id=Auth::user()->id;
        $categories= DB::select("select * from CATEGORIES t");
        $companies= DB::select("select * from COMPANIES t");
        $contract_type= DB::select("select * from CONTRACT_TYPES t");
        $countries= DB::select("select * from CONTRIES t");
        $factories= DB::select("select * from FACTORIES t");
        $models= DB::select("select * from MODELS t");
        $railways= DB::select("select * from RAILWAYS t");
        $wagon_depos= DB::select("select * from WAGON_DEPOS t");
        $wagons= DB::select("select * from WAGONS t");
        return view('home', compact('categories','companies','contract_type','countries','factories','models','railways','models','wagon_depos','wagons'));
    }
    public function save(Request $request)
    {
      
    }
    public function getDep($hid)
    {
        
    }
    public function delete(Request $request)
    {
        
    }
}

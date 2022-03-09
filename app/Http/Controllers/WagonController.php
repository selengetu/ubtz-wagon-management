<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Wagon;
class WagonController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $id=Auth::user()->id;
        $categories= DB::select("select * from SET_WAGON_CATEGORIES t");
        $companies= DB::select("select * from COMPANY_INFO t");
        $contract_type= DB::select("select * from SET_CONTRACT_TYPES t");
        $countries= DB::select("select * from SET_COUNTRIES t");
        $factories= DB::select("select * from SET_FACTORIES t");
        $models= DB::select("select * from SET_WAGON_MODELS t");
        $railways= DB::select("select * from SET_RAILWAYS t");
        $wagon_depos= DB::select("select * from SET_DEPOS t");
        $wagons= DB::select("select * from V_COMPANY_WAGONS t");
     
        return view('home', compact('categories','companies','contract_type','countries','factories','models','railways','models','wagon_depos','wagons'));
    }
    public function savewagon(Request $request)
    {
     
        if($request->flg2 == 0){
            $wag = new Wagon;
            $wag->rcode = $request->rcode;
            $wag->wagno = $request->wagno;
            $wag->catcode = $request->catcode;
            $wag->company_id = $request->company_id;
            $wag->wagtype = $request->wagtype;
            $wag->waggroup = $request->waggroup;
            $wag->axes = $request->company_id;
            $wag->weight = $request->wagtype;
            $wag->len = $request->waggroup;
            $wag->door = $request->door;
            $wag->volume = $request->volume;
            $wag->floor = $request->floor;
            $wag->company_id = $request->cid2;
            $wag->save();
        }
        if($request->flg2 == 1){
            $wag = DB::table('COMPANY_WAGONS')
            ->where('wagid', $request->hid2)
            ->update(['rcode' => $request->rcode,'wagno' => $request->wagno,'catcode' => $request->catcode,
            'wagtype' => $request->wagtype,'waggroup' => $request->waggroup,'axes' => $request->axes,'weight' => $request->weight,'len' => $request->len,'door' => $request->door,
            'volume' => $request->volume,'floor' => $request->floor]);
        }
        return back()->withInput();
    }
    public function comwagon($id)
    {
        $uid=Auth::user()->id;
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
        return view('com_wagon', compact('categories','companies','company','contract_type','countries','factories','models','railways','models','wagon_depos','wagons'));
    }
    public function type()
    {
       
        $models= DB::select("select * from SET_WAGON_MODELS t");
        $railways= DB::select("select * from SET_RAILWAYS t");
        return view('com_wagon', compact('models','railways'));
    }

    public function railway()
    {
       
        $models= DB::select("select * from SET_WAGON_MODELS t");
        $railways= DB::select("select * from SET_RAILWAYS t");
        return view('com_wagon', compact('models','railways'));
    }
}

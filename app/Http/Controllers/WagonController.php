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
        $categories= DB::select("select * from CATEGORIES t");
        $companies= DB::select("select * from COMPANIES t");
        $contract_type= DB::select("select * from CONTRACT_TYPES t");
        $countries= DB::select("select * from COUNTRIES t");
        $factories= DB::select("select * from FACTORIES t");
        $models= DB::select("select * from MODELS t");
        $railways= DB::select("select * from RAILWAYS t");
        $wagon_depos= DB::select("select * from WAGON_DEPOS t");
        $wagons= DB::select("select * from V_WAGONS t");
        return view('home', compact('categories','companies','contract_type','countries','factories','models','railways','models','wagon_depos','wagons'));
    }
    public function savewagon(Request $request)
    {
        if($request->type == 1){
            $wag = new Wagon;
            $wag->rcode = $request->rcode;
            $wag->wagno = $request->wagno;
            $wag->model_id = $request->model_id;
            $wag->model_no = $request->model_no;
            $wag->catcode = $request->catcode;
            $wag->factory_code =$request->factory_code;
            $wag->factory_date =$request->factory_date;
            $wag->axes = $request->axes;
            $wag->axe_capacity = $request->axe_capacity;
            $wag->brutto = $request->brutto;
            $wag->netto = $request->netto;
            $wag->base_length = $request->base_length;
            $wag->ram_length = $request->ram_length;
            $wag->carrying_capacity = $request->carrying_capacity;
            $wag->tare_weight = $request->tare_weight;
            $wag->volume = $request->volume;
            $wag->door = $request->door;
            $wag->number_of_hatches = $request->number_of_hatches;
            $wag->side_hatches = $request->side_hatches;
            $wag->roof_hatches = $request->roof_hatches;
            $wag->floor_area = $request->floor_area;
            $wag->number_of_side_boards = $request->number_of_side_boards;
            $wag->number_of_side_rack_brackets = $request->number_of_side_rack_brackets;
            $wag->purposed_cargoes = $request->purposed_cargoes;
            $wag->load_hatch = $request->load_hatch;
            $wag->unload_hatch = $request->unload_hatch;
            $wag->transfer_panel = $request->rcode;
            $wag->hand_stop = $request->hand_stop;
            $wag->stop_type = $request->stop_type;
            $wag->auto_hook_type = $request->auto_hook_type;
            $wag->auto_trigger_type = $request->auto_trigger_type;
            $wag->absorption_type = $request->absorption_type;
            $wag->absorption_category = $request->absorption_category;
            $wag->absorption_date = $request->absorption_date;
            $wag->vu4m_wagon_techinfo = $request->vu4m_wagon_techinfo;
            $wag->save();
        }
        if($request->type == 2){
            $wag = DB::table('wagons')
            ->where('wag_id', $request->wag_id)
            ->update(['rcode' => $request->rcode,'wagno' => $request->wagno,'model_id' => $request->model_id,'model_no' => $request->model_no,'catcode' => $request->catcode,
            'factory_code' => $request->factory_code,'factory_date' => $request->factory_date,'axes' => $request->axes,'axe_capacity' => $request->axe_capacity,'brutto' => $request->brutto,'netto' => $request->netto,
            'base_length' => $request->base_length,'ram_length' => $request->ram_length,'carrying_capacity' => $request->carrying_capacity,'tare_weight' => $request->tare_weight,'volume' => $request->volume,'door' => $request->door,
            'number_of_hatches' => $request->number_of_hatches,'side_hatches' => $request->side_hatches,'roof_hatches' => $request->roof_hatches,'floor_area' => $request->floor_area,
            'number_of_side_boards' => $request->number_of_side_boards,'number_of_side_rack_brackets' => $request->number_of_side_rack_brackets,'purposed_cargoes' => $request->purposed_cargoes,'load_hatch' => $request->load_hatch,'unload_hatch' => $request->unload_hatch,
            'transfer_panel' => $request->transfer_panel,'hand_stop' => $request->hand_stop,'stop_type' => $request->stop_type,'auto_hook_type' => $request->auto_hook_type,'auto_trigger_type' => $request->auto_trigger_type,
            'absorption_type' => $request->absorption_type,'absorption_category' => $request->absorption_category,'absorption_date' => $request->absorption_date]);
        }
      
        return Redirect('home');
    }
    public function getDep($hid)
    {
        
    }
    public function delete(Request $request)
    {
        
    }
}

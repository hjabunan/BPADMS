<?php

namespace App\Http\Controllers;

use App\Models\BPARating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BPARatingController extends Controller
{
    public function index(Request $request){
        $ratings = DB::TABLE('bpa_ratings')
                ->select('id', 'rating_name', 'rating_description', 'rating_gradefrom', 'rating_gradeto', 'rating_remarks', 'rating_colorcode', 'rating_status', 'key')
                ->where('is_deleted', 0)
                ->orderBy('id','asc')->get();
        return view('bpa-systemconfig.sc-ratings.index', compact('ratings'));
    }

    // GET DATA OF RATE
    public function getRateData(Request $request){
        $rate = BPARating::where('key', $request->keyRate)->first();
        $result = array(
            'rKey' => $rate->key,
            'rID' => $rate->id,
            'rname' => $rate->rating_name,
            'rdescription' => $rate->rating_description,
            'rgradefrom' => $rate->rating_gradefrom,
            'rgradeto' => $rate->rating_gradeto,
            'rremarks' => $rate->rating_remarks,
            'rcolor' => $rate->rating_colorcode,
            'rstatus' => $rate->rating_status,
        );

        return json_encode($result);
    }

    // SAVE RATE DATA
    public function saveRateData(Request $request){
        if($request->rateKey == null or $request->rateKey == ""){
            $rate = new BPARating();
            $rate->rating_name = $request->rname;
            $rate->rating_description = $request->rdescription;
            $rate->rating_gradefrom = $request->rgradefrom;
            $rate->rating_gradeto = $request->rgradeto;
            $rate->rating_remarks = $request->rremarks;
            $rate->rating_colorcode = $request->rcolor;
            $rate->key = Str::uuid();
            $dirtyAttributes = $rate->getDirty();
            $rate->save();
        }else{
            $rate = BPARating::find($request->rateID);
            $rate->rating_name = $request->rname;
            $rate->rating_description = $request->rdescription;
            $rate->rating_gradefrom = $request->rgradefrom;
            $rate->rating_gradeto = $request->rgradeto;
            $rate->rating_remarks = $request->rremarks;
            $rate->rating_colorcode = $request->rcolor;
            $rate->rating_status = $request->rstatus;
            $dirtyAttributes = $rate->getDirty();
            $rate->update();
        }
        
        $result = '';

        return json_encode($result);
    }

    // STATUS RATE
    public function statusRate(Request $request){
        if($request->statusRate == 0){
            $stat = 1;
        }else{
            $stat = 0;
        }

        BPARating::where('key', $request->keyRate)->update([
            'rating_status' => $stat,
        ]);
        
        $result = '';

        return json_encode($result);
    }

    // DELETE RATE
    public function deleteRate(Request $request){
        BPARating::where('key', $request->keyRate)->update([
            'is_deleted' => 1,
        ]);

        $result = '';

        return json_encode($result);
    }
}

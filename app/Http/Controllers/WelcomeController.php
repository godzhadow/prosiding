<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index(Request $request) {
        $year = $request->year;
        $country = $request->country;
        $search = $request->search;
        $paper = paper::query();
        if ($request->year != ""){
            $paper->where('year',$request->year);
        }
        if($request->country != ""){
            $paper->where('country',$request->country);
        }
        if($request->has('search')){
            $paper->where('title','like','%'.$request->search.'%');
        }
        $paper =  $paper->get();
        // return view('welcome',['paper'=>$paper]);
        return view('welcome')->with(['paper'=>$paper,'year'=>$year,'country'=>$country,'search'=>$search]);
    }

    public function detail($id)
    {
        $paper = Paper::where('id',$id)->get();

        return view('abstractdetail',['paper' => $paper]);
    }
}

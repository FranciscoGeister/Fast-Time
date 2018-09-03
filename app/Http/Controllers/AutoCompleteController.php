<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;

class AutoCompleteController extends Controller
{
    public function index() {
        return view('autocomplete');
    }

    public function searchData() {


        $data = DB::table('members')->get();

        return response()->json($data);

       // Something to note here : autocomplete takes value as your data so your title should be displayed as value as i did in my query else data will not be displayed
    }

    public function searchProducts() {


        $data = DB::table('products')->get();

        return response()->json($data);
    }

    public function searchProfessionals() {


        $data = DB::table('profesionals')->get();

        return response()->json($data);
    }

    public function searchFromData($data){
      return response()->json($data);
    }
}

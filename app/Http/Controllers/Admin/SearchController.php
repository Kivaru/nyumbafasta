<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\House;
use App\User;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request){
       

        $search = $request->input('search');
  
        $results = House::orwhere('id', 'LIKE', $search)
                        ->orWhere('address', 'LIKE', $search)
                        ->orWhere('contact', 'LIKE', $search)
                        ->orderBy('id', 'DESC')
                        ->paginate(20);
        
        return view('admin.house.search', compact('results'));
    }

    public function searchLandlord(Request $request){
       

        $search = $request->input('search');
  
        $results = User::orwhere('id', 'LIKE', $search)
                        ->orWhere('name', 'LIKE', $search)
                        ->orWhere('contact', 'LIKE', $search)
                        ->orderBy('id', 'DESC')
                        ->paginate(20);
        
        return view('admin.house.searchlandlord', compact('results'));
    }



}

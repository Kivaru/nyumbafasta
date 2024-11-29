<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $agents = Agent::latest()->paginate(30);
        return $agents;
        return view('agent.house.index', compact('houses', 'housecount'));
    }
}

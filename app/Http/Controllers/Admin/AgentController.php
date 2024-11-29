<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Agent;
use App\House;
use App\User;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use Illuminate\Http\Request;
use DB;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::latest()->get();
        $agentcount = Agent::all()->count();
        return view('admin.agent.index', compact('agents', 'agentcount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAgentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agent = new Agent();
        $agent->name = $request->name;
        $agent->phonenumber =$request->phonenumber;
        $agent->email =$request->email;
        $agent->save();
        return redirect(route('admin.agent.index'))->with('success', 'Agent Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $housesDistinct = House::where('agent_id',$id)->distinct('contact')->get();

        $houses = House::where('agent_id',$id)->distinct('contact')->get();

        $housesUnique = $houses->unique('contact');

        $verifiedCount = 0;
        $unverifiedCount = 0;

        foreach($housesUnique as $key=>$house){
            if($house->user){
                if($house->user->verified == 1){
                    $verifiedCount += 1;
                }
                elseif($house->user->verified == 0){
                    $unverifiedCount += 1;
                }
            }
            else{
                $verifiedCount += 0;
                $unverifiedCount += 0;
            }
        }

        $agent  = Agent::where('id', $id)->first();

        $housecount = $houses->count();
        $housecountDistinct = $housesDistinct->count();

        return view('agent.house.show', compact('houses', 'agent', 'housecount', 'housecountDistinct', 'verifiedCount', 'unverifiedCount'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function agentFilter(Request $request)
    {


        // $housesDistinct = House::where('agent_id',$id)->select('contact')->distinct()->get();
        $houses = House::whereBetween(DB::raw('DATE(created_at)'), [$request->datequery, $request->enddatequery])->where('agent_id', $request->agent_id)->get();

        $housesUnique = $houses->unique('contact');

        $verifiedCount = 0;
        $unverifiedCount = 0;

        foreach($housesUnique as $house){
            if($house->user->verified == 1){
                $verifiedCount += 1;
            }
            elseif($house->user->verified == 0){
                $unverifiedCount += 1;
            }
        }

        $housesDistinct = House::whereBetween('created_at', [$request->datequery, $request->enddatequery])->select('contact')->distinct()->get();

        $agent  = Agent::where('id', $request->agent_id)->first();

        $housecount = $houses->count();

        $housecountDistinct = $housesDistinct->count();

        return view('agent.house.show', compact('houses', 'agent', 'housecount', 'housecountDistinct', 'verifiedCount', 'unverifiedCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgentRequest  $request
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgentRequest $request, Agent $agent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        // if(House::where('agent_id', $agent->id)->count() > 0){
        //     session()->flash('danger', 'You do not delete this agent because the agent have some houses information');
        //     return redirect()->back();
        // }
        $agent->delete();
        return redirect(route('admin.agent.index'))->with('success', 'Agent Removed Successfully');
    }

    public function agentHouses(Agent $agent, House $house)
    {

    }


}

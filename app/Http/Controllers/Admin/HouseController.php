<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\House;
use App\Area;
use App\Agent;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Region;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::oldest()->paginate(20);
        $housecount = House::all()->count();

        $regions = Region::all();

        return view('admin.house.index', compact('houses', 'housecount', 'regions'));
    }

    public function filter(Request $request){

        $housecount = House::all()->count();
        $regions = Region::all();

        $region_id = $request->region;
        $district_id = $request->district;
        $area = $request->area;
        $propertyType = $request->type;

        $title = "Search Results";

        $regionFromDB = DB::table('regions')->where('id', $region_id)->first();

        $areaFromDB = DB::table('areas')->where('name', $area)->first();

        $digit1 =  $request->minPrice;
        $digit2 =  $request->maxPrice;

        $houses = House::where(function ($query) use ($regionFromDB, $district_id, $areaFromDB, $propertyType, $digit1, $digit2) {
            if ($regionFromDB) {
                $query->where('region_id', $regionFromDB->id);
            }
            if ($district_id) {
                $query->where('district_id', $district_id);
            }
            if ($areaFromDB) {
                $query->where('area_id', $areaFromDB->id);
            }
            if ($propertyType) {
                $query->where('house_type', $propertyType);
            }
            if ($digit1) {
                $query->where('rent', '>=', $digit1);
            }
            if ($digit2) {
                $query->where('rent', '<=', $digit2);
            }
        })->paginate();

        return view('admin.house.filter', compact('houses', 'title', 'housecount', 'regions'));
    }

    public function indexUnverified()
    {
        $landlords = User::where('role_id',2)
                            ->where('verified', 0)
                            ->paginate(10);

        $areas = Area::all();
        $houses = House::all();

    return view('admin.manageLandlord.unverified', compact('landlords', 'areas', 'houses'));
    }

    public function indexVerified()
    {
        $landlords = User::where('role_id',2)
                            ->where('verified', 1)
                            ->paginate(10);


        $areas = Area::all();
        $houses = House::all();

    return view('admin.manageLandlord.verified', compact('landlords', 'areas', 'houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        $agents = Agent::all();

        $houseDB = House::with('media')->where('id', $house->id)->first();

        return view('admin.house.show')->with(['house'=>$house, 'agents'=>$agents, 'houseDB'=>$houseDB]);
    }

    public function manageLandlord(){

        $landlords = User::where('role_id',2)
                             ->paginate(10);
        $areas = Area::all();
        $houses = House::all();

        return view('admin.manageLandlord.index', compact('landlords', 'areas', 'houses'));
    }

    public function switchAvailable($id)
    {
        House::where('id',$id)->update(['status'=> 1]);
        session()->flash('success', 'House Status Changed Successfully');
        return redirect()->back();
    }

    public function switchUnavailable($id)
    {
        House::where('id',$id)->update(['status'=> 0]);
        session()->flash('success', 'House Status Changed Successfully');
        return redirect()->back();
    }

    public function dialLandlord($id)
    {
        $landlord =  User::where('role_id',2)->find($id);
        $landlords = User::where('role_id',2)->paginate(10);
        User::where('id',$id)->update(['dialed'=> 1]);
        return view('admin.manageLandlord.index', compact('landlords'));
    }

    public function verifyLandlord($id)
    {
        $landlord =  User::where('role_id',2)->find($id);
        $landlords = User::where('role_id',2)->paginate(10);
        User::where('id',$id)->update(['verified'=> 1]);
        return redirect()->back();
    }

    public function removeLandlord($id){
        $user = User::findOrFail($id);

        if($user->houses->count() > 0){
            session()->flash('danger', 'You do not remove landlord right now. Because he have some houses. At first
            you have to remove houses, then remove him');
            return redirect()->back();
        }

        House::where('user_id', $user->id)->delete();

        $user->delete();

        session()->flash('success', 'Landlord Removed Successfully');
        return redirect()->back();

    }


    public function manageRenter(){
        $renters = User::where('role_id',3)->paginate(10);
        return view('admin.manageRenter.index', compact('renters'));
    }

    public function removeRenter($id){

        if(Booking::where('renter_id', $id)->where('booking_status', "booked")->count() > 0){
            session()->flash('danger', 'You do not able to remove this renter. Because he/she have already booked houses from your website');
            return redirect()->back();
        }


        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('success', 'Renter Removed Successfully');
        return redirect()->back();
    }

    public function manageDalali(){

        $dalalis = User::where('role_id',5)
                             ->paginate(10);
        $areas = Area::all();
        $houses = House::all();
        return view('admin.manageDalali.index', compact('dalalis', 'areas', 'houses'));
    }

    public function dialDalali($id)
    {
        $dalali =  User::where('role_id',5)->find($id);
        $dalalis = User::where('role_id',5)->paginate(10);
        User::where('id',$id)->update(['dialed'=> 1]);
        return view('admin.manageDalali.index', compact('dalalis'));
    }

    public function verifyDalali($id)
    {
        $dalali =  User::where('role_id',5)->find($id);
        $dalalis = User::where('role_id',5)->paginate(10);
        User::where('id',$id)->update(['verified'=> 1]);
        return redirect()->back();
    }

    public function removeDalali($id){
        $user = User::findOrFail($id);

        if($user->houses->count() > 0){
            session()->flash('danger', 'You do not remove dalali right now. Because he have some houses. At first
            you have to remove houses, then remove the dalali');
            return redirect()->back();
        }

        House::where('user_id', $user->id)->delete();

        $user->delete();

        session()->flash('success', 'Dalali Removed Successfully');
        return redirect()->back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        //delete multiple added images
        foreach(json_decode($house->images) as $picture){
            @unlink("images/". $picture);
        }

        //delete old featured image
        if(Storage::disk('public')->exists('featured_house/'.$house->featured_image)){
            Storage::disk('public')->delete('featured_house/'.$house->featured_image);
        }

        $house->delete();
        return redirect(route('admin.house.index'))->with('success', 'House Removed Successfully');
    }
}

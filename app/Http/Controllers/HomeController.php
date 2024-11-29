<?php

namespace App\Http\Controllers;

use App\Area;
use App\Agent;
use App\Booking;
use App\House;
use App\Property;
use App\User;
use App\Wishlist;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Response;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function indexLanding()
    {
        return view('landingtemp');
    }

    public function indexHousesForSale(Request $request)
    {
        $userID = Auth::id();

        $properties = Property::latest()->paginate(48);

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', "COMPLETED")
                        ->where('houses.user_id', $userID)
                        ->get();

            $wishlist =  Wishlist::leftJoin('houses', 'houses.id', '=', 'wishlist.house_id')
                        ->rightJoin('selcom_payments', 'wishlist.house_id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.user_id', $userID)
                        ->select('houses.*', 'selcom_payments.id as house_id','selcom_payments.payment_status', 'selcom_payments.house_id', 'houses.id as house_id')
                        ->where('wishlist.user_id', $userID)
                        ->orderBy('houses.id', 'ASC')
                        ->groupBy('houses.id')
                        ->distinct('house_id')
                        ->get();

         $paidHousesCount = count($paidHouses);
         $wishlistCount = count($wishlist);
        }

        return view('landingsales', compact('properties', 'paidHousesCount', 'wishlistCount'));
    }


    public function index(Request $request)
    {

        $userID = Auth::id();


        $array = [6070, 6062, 6075, 6079, 6080, 5194, 5107, 5198, 5208, 5227, 5225, 5212, 5208, 5196, 5190, 5109, 5108, 4360, 4358, 4344, 4333, 4299, 4300, 4278, 4240, 4234, 4087, 4076, 4071, 4070, 4068, 4066, 2831, 3644, 3742, 3728, 3645, 3554, 3551, 3477, 3463, 3461, 3450, 3441, 3429, 3411, 3404, 3375, 3359, 3352, 3344, 3343, 3342, 3338, 3336, 3250, 3249, 3204, 3202,3477, 4066, 4065, 4053, 4049, 4043, 4036, 4029, 4026, 4020, 4012, 4009, 4007, 4006, 4004, 4001, 3995, 3987, 3979, 3864, 3863, 3862, 3852, 3854, 3855, 3851, 3840, 3817, 3816, 3803, 3802, 3795, 3975, 3973, 3971, 3967, 3965, 3950, 3953, 3944, 3936, 3929, 3928, 3927, 3926, 3924, 3923, 3922, 3916, 3910, 3806, 3905, 3902, 3890, 3876, 3852, 3849, 3847, 3841, 3809, 3806, 3786, 3783, 4479, 4486, 4443, 4487, 4482, 4484, 4614, 4608, 4620, 4599, 4575];

        $regions = Region::all();

        $houses = House::whereIn('id', $array)->orderBy('id', 'DESC')->paginate(24);

        $areas = Area::all();

        // return [$areas];

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', "COMPLETED")
                        ->where('houses.user_id', $userID)
                        ->get();

            $wishlist =  Wishlist::leftJoin('houses', 'houses.id', '=', 'wishlist.house_id')
                        ->rightJoin('selcom_payments', 'wishlist.house_id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.user_id', $userID)
                        ->select('houses.*', 'selcom_payments.id as house_id','selcom_payments.payment_status', 'selcom_payments.house_id', 'houses.id as house_id')
                        ->where('wishlist.user_id', $userID)
                        ->orderBy('houses.id', 'ASC')
                        ->groupBy('houses.id')
                        ->distinct('house_id')
                        ->get();

         $paidHousesCount = count($paidHouses);
         $wishlistCount = count($wishlist);
        }



        return view('landing', compact('houses', 'areas', 'regions', 'paidHousesCount', 'wishlistCount'));
    }

    public function getDistrict(Request $request){

        $region_id = request()->get('region_id');
        $districts = DB::table('districts')->where('region_id','=',$region_id)->pluck('name', 'id');
        return Response::json($districts);
    }

    public function getArea(Request $request){

        $area_id = request()->get('area_id');
        $areas = DB::table('areas')->where('district_id','=',$area_id)->pluck('name');
        return Response::json($areas);
    }

    public function highToLow()
    {
        $houses = House::where('status', 1)->orderBy('rent', 'DESC')->paginate(6);
        $areas = Area::all();
        return view('welcome', compact('houses', 'areas'));
    }

    public function lowToHigh()
    {
        $houses = House::where('status', 1)->orderBy('rent', 'ASC')->paginate(6);
        $areas = Area::all();
        return view('welcome', compact('houses', 'areas'));
    }

    public function details($id){
        $house = House::findOrFail($id);

        $agents = Agent::all();
        $agentName = "No Agent Assigned";

        foreach($agents as $agent){
            if($agent->id == $house->agent_id){
                $agentName = $agent->name;
            }
        }

        // Share buttons
        $shareButtons = \Share::page(
            'http://nyumbafasta.co.tz/house/details/'. $id
      )
      ->facebook()
      ->twitter()
      ->linkedin()
      ->telegram()
      ->whatsapp()
      ->reddit();

        return view('houseDetails', compact('house')->with('shareButtons',$shareButtons));
    }

    public function allHouses(Request $request){

        $userID = Auth::id();
        $houses = House::where('id', '>=', 3083)->latest()->paginate(20);
        $title = "All Houses";

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', "COMPLETED")
                        ->where('houses.user_id', $userID)
                        ->get();

         $paidHousesCount = count($paidHouses);

            return view('allHouses', compact('houses', 'title', 'paidHousesCount', 'paidHouses', 'wishlist', 'wishlistCount'));

        }
        return view('allHouses', compact('houses', 'title', 'paidHousesCount', 'wishlistCount'));
    }

    public function areaWiseShow($id){

        $area = Area::findOrFail($id);
        $houses = House::where('area_id', $id)->get();
        return view('areaWiseShow', compact('houses', 'area'));
    }

    public function searchById(Request $request){

    $houseID = $request->input('id');

    $agents = Agent::all();
    $agentName = "No Agent Assigned";

    $house = House::query()
        ->where('id', 'LIKE', "%{$houseID}%")
        ->first();

        foreach($agents as $agent){
            if($agent->id == $house->agent_id){
                $agentName = $agent->name;
            }
        }

         // Share buttons
         $shareButtons = \Share::page(
            'https://nyumbafasta.co.tz/house/details/'. $houseID
      )
      ->facebook()
      ->twitter()
      ->linkedin()
      ->telegram()
      ->whatsapp()
      ->reddit();

      $recentHouses = House::latest()->get();

    return view('renter.house.show', compact('house', 'agentName', 'shareButtons', 'recentHouses'));
    }

    public function filter(Request $request){

        $region_id = $request->region;
        $district_id = $request->district;
        $area = $request->area;
        $propertyType = $request->type;

        $title = "Search Results";

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        $regionFromDB = DB::table('regions')->where('id', $region_id)->first();

        $areaFromDB = DB::table('areas')->where('name', $area)->first();

        $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                            ->where('wishlist.user_id', $userID)
                            ->orWhere('wishlist.user_agent', $userAgent)
                            ->orderBy('houses.id', 'ASC')
                            ->get();

        $wishlistCount = count($wishlist);

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

        return view('filter-results', compact('houses', 'title', 'paidHousesCount', 'wishlistCount'));
    }


    public function generalSearch(Request $request){

        $term = $request->term;

        $words = explode(' ', $term);

        $title = "Search Results";

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        $reverseArea = Area::where('name', 'LIKE', $term)->value('id');

        $results = House::orwhere('id', 'LIKE', $term)
                            ->orWhere('house_type', 'LIKE', $term)
                            ->orWhere('rent', 'LIKE', $term)
                            ->orWhere('area_id', 'LIKE', $reverseArea)
                            ->orderBy('address', 'DESC')
                            ->where(function ($query) use ($words) {
                                foreach($words as $word) {
                                    $query->orWhere('address', 'LIKE', '%' . $word . '%');
                                }
                            })
                            ->paginate(20)
                            ->withQueryString();

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

                        $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
                        ->select('houses.*', 'houses.id as house_id')
                        ->where('wishlist.user_id', $userID)
                        ->orderBy('houses.id', 'ASC')
                        ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);

            return view('search-results', compact('title', 'paidHousesCount', 'paidHouses', 'results', 'wishlist', 'wishlistCount'));
        }

        return view('search-results', compact('title', 'paidHousesCount', 'results', 'wishlistCount'));
    }




    public function searchByRange(Request $request){
        $digit1 =  $request->digit1;
        $digit2 =  $request->digit2;
        if($digit1 > $digit2){
            $temp = $digit1;
            $digit1 =  $digit2;
            $digit2 = $temp;
        }
        $houses = House::whereBetween('rent', [$digit1, $digit2])
                        ->orderBy('id', 'DESC')->paginate(20);
        return view('searchByRange', compact('houses'));
    }


    public function booking($house){


        $house = House::findOrFail($house);
        $landlord = User::where('id', $house->user_id)->first();

        if(Booking::where('address', $house->address)->where('booking_status', "booked")->count() > 0){
            session()->flash('danger', 'This house has already been booked!');
            return redirect()->back();
        }



        if(Booking::where('address', $house->address)->where('renter_id', Auth::id())->where('booking_status', "requested")->count() > 0){
            session()->flash('danger', 'Your have already sent booking request of this home');
            return redirect()->back();
        }

        $booking = new Booking();
        $booking->address = $house->address;
        $booking->rent = $house->rent;
        $booking->landlord_id = $landlord->id;
        $booking->renter_id = Auth::id();
        $booking->save();


        session()->flash('success', 'House Booking Request Send Successfully');
        return redirect()->back();


    }


    public function apartments(Request $request)
    {

        $houses = House::where('house_type', "Apartment")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Apartments";

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

            $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
            ->select('houses.*', 'houses.id as house_id')
            ->where('wishlist.user_id', $userID)
            ->orderBy('houses.id', 'ASC')
            ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);

            return view('allHouses', compact('houses', 'areas', 'title', 'paidHousesCount', 'wishlistCount'));

        }
        return view('allHouses', compact('houses', 'areas', 'title', 'paidHousesCount', 'wishlistCount'));
    }

    public function standaloneHouses(Request $request)
    {

        $houses = House::where('house_type', "Standalone")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Standalone Houses";

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

            $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
            ->select('houses.*', 'houses.id as house_id')
            ->where('wishlist.user_id', $userID)
            ->orderBy('houses.id', 'ASC')
            ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);
            return view('allHouses', compact('houses', 'areas', 'title', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'));

        }
        return view('allHouses', compact('houses', 'areas', 'title', 'paidHousesCount', 'wishlistCount'));
    }

    public function sittingRoomWithMasterBedrooms(Request $request)
    {

        $houses = House::where('house_type', "Sitting Room With Master Bedroom")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Sitting Room With MasterBedrooms";

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

                        $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
                        ->select('houses.*', 'houses.id as house_id')
                        ->where('wishlist.user_id', $userID)
                        ->orderBy('houses.id', 'ASC')
                        ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);


            return view('allHouses', compact('houses', 'areas', 'title', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'));

        }

        return view('allHouses', compact('houses', 'areas', 'title', 'paidHousesCount', 'wishlistCount'));
    }

    public function sittingRoomWithBedrooms(Request $request)
    {

        $houses = House::where('house_type', "Sitting Room With Bedroom")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Sitting Room With Bedrooms";

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

                        $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
            ->select('houses.*', 'houses.id as house_id')
            ->where('wishlist.user_id', $userID)
            ->orderBy('houses.id', 'ASC')
            ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);

        }

        return view('allHouses', compact('houses', 'areas', 'title', 'paidHousesCount', 'wishlist', 'wishlistCount'));
    }

    public function masterBedrooms(Request $request)
    {

        $houses = House::where('house_type', "Master Bedroom")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Master Bedrooms";

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);
                        $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
            ->select('houses.*', 'houses.id as house_id')
            ->where('wishlist.user_id', $userID)
            ->orderBy('houses.id', 'ASC')
            ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);

            return view('allHouses', compact('houses', 'areas', 'title', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'));

        }

        return view('allHouses', compact('houses', 'areas', 'title', 'paidHousesCount', 'wishlistCount'));
    }

    public function singleRooms(Request $request)
    {
        $houses = House::where('house_type', "Single Room")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Single Rooms";

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

                        $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
            ->select('houses.*', 'houses.id as house_id')
            ->where('wishlist.user_id', $userID)
            ->orderBy('houses.id', 'ASC')
            ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);

            return view('allHouses', compact('houses', 'areas', 'title', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'));

        }

        return view('allHouses', compact('houses', 'areas', 'title', 'paidHousesCount', 'wishlistCount'));
    }

    public function privacyPage(Request $request){

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

                        $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
            ->select('houses.*', 'houses.id as house_id')
            ->where('wishlist.user_id', $userID)
            ->orderBy('houses.id', 'ASC')
            ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);

            return view('privacy-policy', 'paidHousesCount', 'paidHouses', 'wishlistCount', 'wishlist');

        }

        return view('privacy-policy', compact('paidHousesCount', 'wishlistCount'));

    }

    public function aboutUs(Request $request){

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

                        $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
            ->select('houses.*', 'houses.id as house_id')
            ->where('wishlist.user_id', $userID)
            ->orderBy('houses.id', 'ASC')
            ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);
        return view('about-us', compact('paidHousesCount', 'paidHouses', 'wishlist', 'wishlistCount'));
        }

        return view('about-us', compact('paidHousesCount', 'wishlistCount'));
    }

    public function contactUs(Request $request){
        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

                        $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
            ->select('houses.*', 'houses.id as house_id')
            ->where('wishlist.user_id', $userID)
            ->orderBy('houses.id', 'ASC')
            ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);
        return view('contact-us', compact('paidHousesCount', 'paidHouses', 'wishlist', 'wishlistCount'));
        }
        return view('contact-us', compact('paidHousesCount', 'wishlistCount'));
    }

    public function faqs(Request $request){
        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses =House::join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->all();

                        $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
            ->select('houses.*', 'houses.id as house_id')
            ->where('wishlist.user_id', $userID)
            ->orderBy('houses.id', 'ASC')
            ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);
        return view('faqs', compact('paidHousesCount', 'paidHouses', 'wishlist', 'wishlistCount'));
    }

    return view('faqs', compact('paidHousesCount', 'wishlistCount'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart(Request $request)
    {

        $regions = Region::all();
        $houses = House::latest()->paginate(12);
        $areas = Area::all();

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', "COMPLETED")
                        ->where('houses.user_id', Auth::id())
                        ->paginate(12);
            $wishlist = Wishlist::join('houses', 'houses.id', '=', 'wishlist.house_id')
            ->select('houses.*', 'houses.id as house_id')
            ->where('wishlist.user_id', $userID)
            ->orderBy('houses.id', 'ASC')
            ->get();
            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);

        return view('renter.house.cart', compact('paidHousesCount', 'paidHouses', 'regions', 'areas', 'wishlist', 'wishlistCount'));
        }
        else{
            return view('renter.house.cart-auth', compact('paidHousesCount', 'wishlistCount'));
        }

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $house = House::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $house->id,
                "quantity" => 1,
                "price" => $house->rent,
                "image" => $house->featured_image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'House added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}

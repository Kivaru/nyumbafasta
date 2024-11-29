<?php

namespace App\Http\Controllers\Renter;

use App\Booking;
use App\Area;
use App\Agent;
use App\Region;
use App\House;
use App\Property;
use App\Wishlist;
use App\Http\Controllers\Controller;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Bryceandy\Selcom\Facades\Selcom;
use Illuminate\Support\Str;
use Mail;
use Response;
use App\Jobs\UpdateSelcomPayment;


class DashboardController extends Controller
{
    public function index() {
        $houses = House::latest()->get();
        $areas = Area::latest()->get();
        $renters = User::where('role_id', 3)->get();
        $landlords = User::where('role_id', 2)->get();
        return view('renter.dashboard', compact('renters', 'houses', 'areas', 'landlords'));
    }

    public function welcome(Request $request)
    {

        $userID = Auth::id();

        $array = [6070, 6062, 6075, 6079, 6080, 5194, 5107, 5198, 5208, 5227, 5225, 5212, 5208, 5196, 5190, 5109, 5108, 4360, 4358, 4344, 4333, 4299, 4300, 4278, 4240, 4234, 4087, 4076, 4071, 4070, 4068, 4066, 2831, 3644, 3742, 3728, 3645, 3554, 3551, 3477, 3463, 3461, 3450, 3441, 3429, 3411, 3404, 3375, 3359, 3352, 3344, 3343, 3342, 3338, 3336, 3250, 3249, 3204, 3202,3477, 4066, 4065, 4053, 4049, 4043, 4036, 4029, 4026, 4020, 4012, 4009, 4007, 4006, 4004, 4001, 3995, 3987, 3979, 3864, 3863, 3862, 3852, 3854, 3855, 3851, 3840, 3817, 3816, 3803, 3802, 3795, 3975, 3973, 3971, 3967, 3965, 3950, 3953, 3944, 3936, 3929, 3928, 3927, 3926, 3924, 3923, 3922, 3916, 3910, 3806, 3905, 3902, 3890, 3876, 3852, 3849, 3847, 3841, 3809, 3806, 3786, 3783, 4479, 4486, 4443, 4487, 4482, 4484, 4614, 4608, 4620, 4599, 4575];

        $regions = Region::all();
        // $houses = House::latest()->paginate(12);
        $houses = House::whereIn('id', $array)->orderBy('id', 'DESC')->paginate(12);
        //$houses = House::latest()->paginate(48);
        $areas = Area::all();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        if($userID){

            $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                                ->where('wishlist.user_id', $userID)
                                ->orderBy('houses.id', 'ASC')
                                ->get();


            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.user_id', $userID)
                        ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);
        }else{
            return view('auth.loginregister', compact('paidHousesCount', 'wishlistCount', 'message'));
        }


        return view('welcome', compact('houses', 'areas', 'regions', 'paidHousesCount', 'wishlistCount'));
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

    public function areas(){
        $areas = Area::latest()->paginate(8);
        $areacount = Area::all()->count();
        return view('renter.area.index', compact('areas', 'areacount'));
    }

    public function getDistrict(Request $request){

        $region_id = request()->get('region_id');
        //$region_id = $request->region_id;
        $districts = DB::table('districts')->where('region_id','=',$region_id)->pluck('name', 'id');
        return Response::json($districts);
    }

    public function getArea(Request $request){

        $area_id = request()->get('area_id');
        $areas = DB::table('areas')->where('district_id','=',$area_id)->pluck('name');
        return Response::json($areas);
    }



    public function allHouses(Request $request){

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        $houses = House::latest()->paginate(20);
        $title = "All Houses";

        if($userID){

            $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                                ->where('wishlist.id', $userID)
                                ->orderBy('houses.id', 'ASC')
                                ->get();

            $paidHouses = DB::table('houses')
                            ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                            ->where('selcom_payments.payment_status', 'COMPLETED')
                            ->where('selcom_payments.user_id', $userID)
                            ->paginate(12);

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);

        }
        else{
            return view('auth.loginregister', compact('paidHousesCount', 'wishlistCount',  'message', 'paidWishlist'));
        }

        return view('allHouses', compact('houses', 'title', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'));
    }

    public function housesDetails(Request $request, $id){

        $userId = Auth::id();

        $house = House::with('media')->find($id);

        $renter = User::where('id', Auth::id())->first();

        $recentHouses = House::latest()->get();

        $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.user_id', Auth::id())
                        ->paginate(12);

        $paidHousesCount = count($paidHouses);

        $userAgent = $request->header('User-Agent');

        $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                            ->where('wishlist.user_id', $userId)
                            ->orderBy('houses.id', 'ASC')
                            ->get();

        $wishlistCount = count($wishlist);

        $payment_info = NULL;

        if($renter){
            $payment_info = DB::table('selcom_payments')
                            ->where('user_id', Auth::id())
                            ->where('house_id', $id)
                            ->first();

        }

        $agents = Agent::all();
        $agentName = "No Agent Assigned";

        foreach($agents as $agent){
            if($agent && $house->agent_id){
                if($agent->id == $house->agent_id){
                    $agentName = $agent->name;
                }
            }
            else{
                $agentName = "No Agent Assigned";
            }
        }

        $price = "";
        $rent = $house->rent;

        if(in_array($rent, range(0,199999))){
            $price = "1000";
        }
        elseif(in_array($rent, range(200000,299999))){
            $price = "1500";
        }
        elseif(in_array($rent, range(300000,399999))){
            $price = "2000";
        }
        elseif(in_array($rent, range(400000,499999))){
            $price = "2500";
        }
        elseif(in_array($rent, range(500000,599999))){
            $price = "3000";
        }
        elseif(in_array($rent, range(600000,699999))){
            $price = "3500";
        }
        elseif(in_array($rent, range(700000,799999))){
            $price = "4000";
        }
        elseif(in_array($rent, range(800000,899999))){
            $price = "4500";
        }
        elseif(in_array($rent, range(900000,999999))){
            $price = "5000";
        }
        elseif($rent >= 1000000){
            $price = "6000";
        }

        $stayOnceUponATime = Booking::
              where('renter_id', Auth::id())
            ->where('leave', '!=' ,"null")
            ->where('leave', '!=', "Currently Staying")
            ->where('address', $house->address)
            ->first();
            //dd($stayOnceUponATime);
        $alreadyReviewed = Review::where('house_id', $house->id)
                            ->where('user_id', Auth::id())
                            ->first();

        // Share buttons
        $shareButtons = \Share::page(
            'https://nyumbafasta.co.tz/house/details/'. $id
      )
      ->facebook()
      ->twitter()
      ->linkedin()
      ->telegram()
      ->whatsapp()
      ->reddit();

        return view('renter.house.show', compact('house', 'stayOnceUponATime', 'alreadyReviewed', 'payment_info', 'recentHouses', 'renter', 'price', 'agentName', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'))->with('shareButtons',$shareButtons);
    }


    public function propertyDetails($id){

        $userId = Auth::id();

        $property = Property::with('media')->find($id);

        $renter = User::where('id', Auth::id())->first();

        $recentProperties = Property::latest()->get();

        $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.user_id', Auth::id())
                        ->paginate(12);

        $paidHousesCount = count($paidHouses);

        $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                            ->where('wishlist.user_id', $userId)
                            ->orderBy('houses.id', 'DESC')
                            ->get();

        $wishlistCount = count($wishlist);

        $payment_info = NULL;

        if($renter){
            $payment_info = DB::table('selcom_payments')
                            ->where('user_id', $renter->id)
                            ->first();

        }

        $agents = Agent::all();
        $agentName = "No Agent Assigned";

        // Share buttons
        $shareButtons = \Share::page(
            'https://nyumbafasta.co.tz/property/details/'. $id
      )
      ->facebook()
      ->twitter()
      ->linkedin()
      ->telegram()
      ->whatsapp()
      ->reddit();

        return view('renter.house.showproperty', compact('property', 'payment_info', 'recentProperties', 'renter', 'agentName', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'))->with('shareButtons',$shareButtons);
    }

    public function payHousesDetails($id){

        $userId = Auth::id();
        $paidHousesCount = 0;

        if($userId){

        $house = House::find($id);

        $renter = User::where('id', Auth::id())->first();

        $recentHouses = House::latest()->get();

        $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', "COMPLETED")
                        ->where('selcom_payments.user_id', Auth::id())
                        ->paginate(12);

        $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                            ->where('wishlist.user_id', $userId)
                            ->orderBy('houses.id', 'ASC')
                            ->get();

        $paidHousesCount = count($paidHouses);
        $wishlistCount = count($wishlist);

        $payment_info = NULL;

        if($renter){
            $payment_info = DB::table('selcom_payments')
                            ->where('user_id', $renter->id)
                            ->first();


        }

        $agents = Agent::all();
        $agentName = "No Agent Assigned";

        foreach($agents as $agent){
            if($agent->id == $house->agent_id){
                $agentName = $agent->name;
            }
        }

        $price = "";
        $rent = $house->rent;

        if(in_array($rent, range(0,199999))){
            $price = "1000";
        }
        elseif(in_array($rent, range(200000,299999))){
            $price = "1500";
        }
        elseif(in_array($rent, range(300000,399999))){
            $price = "2000";
        }
        elseif(in_array($rent, range(400000,499999))){
            $price = "2500";
        }
        elseif(in_array($rent, range(500000,599999))){
            $price = "3000";
        }
        elseif(in_array($rent, range(600000,699999))){
            $price = "3500";
        }
        elseif(in_array($rent, range(700000,799999))){
            $price = "4000";
        }
        elseif(in_array($rent, range(800000,899999))){
            $price = "4500";
        }
        elseif(in_array($rent, range(900000,999999))){
            $price = "5000";
        }
        elseif($rent >= 299999){
            $price = "6000";
        }

        $stayOnceUponATime = Booking::
              where('renter_id', Auth::id())
            ->where('leave', '!=' ,"null")
            ->where('leave', '!=', "Currently Staying")
            ->where('address', $house->address)
            ->first();
            //dd($stayOnceUponATime);
        $alreadyReviewed = Review::where('house_id', $house->id)
                            ->where('user_id', Auth::id())
                            ->first();

        // Share buttons
        $shareButtons = \Share::page(
            'https://nyumbafasta.co.tz/house/details/'. $id
      )
      ->facebook()
      ->twitter()
      ->linkedin()
      ->telegram()
      ->whatsapp()
      ->reddit();

        return view('renter.house.show', compact('house', 'stayOnceUponATime', 'alreadyReviewed', 'payment_info', 'recentHouses', 'renter', 'price', 'agentName', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'))->with('shareButtons',$shareButtons);

        }

        else{
            return redirect()->route('login.register');
        }
    }

    public function getLandlordNumber($id)
    {
        $house = House::find($id);
        $renter = User::find(Auth::id());
        return view('renter.house.payment', compact('id', 'house', 'renter'));

    }

    public function showLoginRegister(){
        $paidHousesCount = 0;
        $wishlistCount = 0;
        return view('auth.loginregister', compact('wishlistCount', 'paidHousesCount'));
    }

    public function sendHouseRequest(Request $request)

    {
        //  Send mail to admin

        $house = House::find($request->house_id);

        \Mail::send('contactMail', array(

            'user_id' => $request->user_id,

            'user_name' => $request->user_name,

            'user_contact' => $request->user_contact,

            'amount' => $request->amount,

            'house_id' => $request->house_id,

            'landlord_name' => $house->user->name,

            'landlord_number' => $house->user->contact,


        ), function($message) use ($request){

            $message->from($request->email);

            $message->to('kivarugodfrey@gmail.com', 'Admin')->subject($request->get('subject'));

        });



        return redirect()->back()->with(['success' => 'Request Submitted Successfully']);

    }

    public function paymentForHouseNumber(Request $request)
    {

    $message = "Please Refresh this page after One Minute To See Changes";

    $data = [
        'name'           =>     $request->user_name,
        'email'          =>     $request->user_email,
        'phone'          =>     $request->phonenumber,
        'amount'         =>     $request->amount,
        'house_id'       =>     $request->house_id,
        'user_id'        =>     $request->user_id,
        'transaction_id' =>     Str::random(10),
        'no_redirection' =>     true,
    ];

    Selcom::checkout($data);

     // Fetch the orderId of the current checkout payment
    //  $orderId = DB::table('selcom_payments')
    //  ->where('transid', $data['transaction_id'])
    //  ->value('order_id');

    // Query the status from Selcom after a certain time. Use a Laravel Job or Scheduler
    // and dispatch it after 20 seconds

    // UpdateSelcomPayment::dispatch($orderId)
    //      ->delay(now()->addSeconds(20));

    return redirect()->route('renter.cart', ['message'=> $message]);
    }

    public function cardPaymentForHouse(Request $request){

        $message = "Please Refresh this page after One Minute To See Changes";

        $data = [
            'name'           => $request->user_name,
            'email'          => $request->user_email,
            'phone'          => $request->user_contact,
            'user_id'        => $request->user_id,
            'house_id'       => $request->house_id,
            'amount'         => $request->amount,
            'address'        => "Tanzania",
            'postcode'       => "255",
            'transaction_id' => Str::random(10),
        ];
        Selcom::cardCheckout($data);
    //     // Fetch the orderId of the current checkout payment
    //  $orderId = DB::table('selcom_payments')
    //  ->where('transid', $data['transaction_id'])
    //  ->value('order_id');

    // // Query the status from Selcom after a certain time. Use a Laravel Job or Scheduler
    // // and dispatch it after 20 seconds

    // UpdateSelcomPayment::dispatch($orderId)
    //      ->delay(now()->addSeconds(20));
        return redirect()->route('renter.cart', ['message'=> $message]);
    }

    public function review(Request $request){
        $this->validate($request, [
            'opinion' => 'required'
        ]);
        $review = new Review();
        $review->house_id = $request->house_id;
        $review->user_id = Auth::id();
        $review->opinion = $request->opinion;
        $review->save();
        session()->flash('success', 'Review Added Successfully');
        return redirect()->back();
    }

    public function reviewEdit($id){
        $review = Review::find($id);
        return view('renter.review.edit', compact('review'));
    }

    public function reviewUpdate(Request $request,$id){
        $this->validate($request, [
            'opinion' => 'required|min:10'
        ]);
        $review = Review::find($id);
        $review->opinion = $request->opinion;
        $review->save();
        return redirect()->route('renter.houses.details', $review->house_id)->with('success', 'Review Updated Successfully');
    }

    public function bookingHistory(){
        $books = Booking::where('renter_id', Auth::id())->where('booking_status', '!=' , "requested")->get();
        return view('renter.booking.history', compact('books'));
    }

    public function bookingPending(){
        $books = Booking::where('renter_id', Auth::id())->where('booking_status', "requested")->get();
        return view('renter.booking.pending', compact('books'));
    }

    public function cancelBookingRequest($id){
        Booking::find($id)->delete();

        session()->flash('success', 'Booking Request Removed Successfully');
        return redirect()->back();
    }

    public function apartments(Request $request)
    {
        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        // $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
        //                     ->where('wishlist.user_id', $userID)
        //                     ->orWhere('wishlist.user_agent', $userAgent)
        //                     ->orderBy('houses.id', 'ASC')
        //                     ->get();

        // $wishlistCount = count($wishlist);


        $houses = House::where('house_type', "Apartment")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Apartments";

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

            $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                        ->where('wishlist.user_id', $userID)
                        ->orderBy('houses.id', 'ASC')
                        ->get();

            $paidHousesCount = count($paidHouses);

            $wishlistCount = count($wishlist);

        }
        else{
            return view('auth.loginregister', compact('paidHousesCount', 'wishlistCount', 'message'));
        }
        return view('allHouses', compact('houses', 'areas', 'title', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'));
    }

    public function standaloneHouses(Request $request)
    {

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        // $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
        //                     ->where('wishlist.user_id', $userID)
        //                     ->orWhere('wishlist.user_agent', $userAgent)
        //                     ->orderBy('houses.id', 'ASC')
        //                     ->get();

        // $wishlistCount = count($wishlist);

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
        else{
            return view('auth.loginregister', compact('paidHousesCount', 'wishlistCount', 'message'));
        }

        $houses = House::where('house_type', "Standalone")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Standalone Houses";
        return view('allHouses', compact('houses', 'areas', 'title', 'paidHouses', 'paidHousesCount'));
    }

    public function sittingRoomWithMasterBedrooms(Request $request)
    {

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        // $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
        //                     ->where('wishlist.user_id', $userID)
        //                     ->orWhere('wishlist.user_agent', $userAgent)
        //                     ->orderBy('houses.id', 'ASC')
        //                     ->get();

        // $wishlistCount = count($wishlist);

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

            $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                        ->where('wishlist.user_id', $userID)
                        ->orderBy('houses.id', 'ASC')
                        ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);

        }

        else{
            return view('auth.loginregister', compact('paidHousesCount', 'wishlistCount', 'message'));
        }

        $houses = House::where('house_type', "Sitting Room With Master Bedroom")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Sitting Room With MasterBedrooms";

        return view('allHouses', compact('houses', 'areas', 'title', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'));
    }

    public function sittingRoomWithBedrooms(Request $request)
    {

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        // $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
        //                     ->where('wishlist.user_id', $userID)
        //                     ->orWhere('wishlist.user_agent', $userAgent)
        //                     ->orderBy('houses.id', 'ASC')
        //                     ->get();

        // $wishlistCount = count($wishlist);

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

        else{
            return view('auth.loginregister', compact('paidHousesCount', 'wishlistCount', 'message'));
        }


        $houses = House::where('house_type', "Sitting Room With Bedroom")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Sitting Room With Bedrooms";
        return view('allHouses', compact('houses', 'areas', 'title', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'));
    }

    public function masterBedrooms(Request $request)
    {

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        // $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
        //                     ->where('wishlist.user_id', $userID)
        //                     ->orWhere('wishlist.user_agent', $userAgent)
        //                     ->orderBy('houses.id', 'ASC')
        //                     ->get();

        // $wishlistCount = count($wishlist);

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
            $wishlistCount =count($wishlist);

        }

        else{
            return view('auth.loginregister', compact('paidHousesCount', 'wishlistCount','message', 'paidWishlist'));
        }


        $houses = House::where('house_type', "Master Bedroom")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Master Bedrooms";
        return view('allHouses', compact('houses', 'areas', 'title', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'));
    }

    public function singleRooms(Request $request)
    {
        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        // $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
        //                     ->where('wishlist.user_id', $userID)
        //                     ->orWhere('wishlist.user_agent', $userAgent)
        //                     ->orderBy('houses.id', 'ASC')
        //                     ->get();

        // $wishlistCount = count($wishlist);

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', 'COMPLETED')
                        ->where('selcom_payments.user_id', $userID)
                        ->paginate(12);

            $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                        ->where('wishlist.user_id', $userID)
                        ->orderBy('houses.id', 'ASC')
                        ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);

        }
        else{
            return view('auth.loginregister', compact('paidHousesCount', 'wishlistCount', 'message'));
        }



        $houses = House::where('house_type', "Single Room")->latest()->paginate(20);
        $areas = Area::all();
        $title = "Single Rooms";
        return view('allHouses', compact('houses', 'areas', 'title', 'paidHouses', 'paidHousesCount', 'wishlist', 'wishlistCount'));
    }

    public function cart(Request $request)
    {

        $regions = Region::all();
        $areas = Area::all();

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        $message = "";

        if($userID){

            $paidHouses = House::join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.user_id', $userID)
                        ->select('houses.*', 'selcom_payments.id as house_id','selcom_payments.payment_status', 'selcom_payments.house_id')
                        ->orderBy('selcom_payments.id', 'DESC')
                        ->groupBy('selcom_payments.id')
                        ->distinct('house_id')
                        ->get();

            $wishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                              ->where('wishlist.user_id', $userID)
                              ->orderBy('houses.id', 'DESC')
                              ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($wishlist);


        return view('renter.house.cart', compact('paidHousesCount', 'paidHouses', 'regions', 'areas', 'message', 'wishlist', 'wishlistCount'));
        }
        else{
            return view('renter.house.cart-auth', compact('paidHousesCount', 'wishlistCount'));
        }

    }

    public function addToWishlist(Request $request, $id)
    {

        $regions = Region::all();
        $areas = Area::all();

        $message = "";

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        $presentWishlist = DB::table('wishlist')->where('house_id', $id)
                                                ->where('user_id', $userID)
                                                ->first();

        if($userID){

        if($presentWishlist){
                return redirect()->back()->with('success', '<script type="text/javascript">alert("Already Added!")</script>');
                }
                else{
            $wishlist = new Wishlist();
            $wishlist->user_id = $userID;
            $wishlist->user_agent = $userAgent;
            $wishlist->house_id = $id;
            $wishlist->save();

            $myWishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                                              ->where('wishlist.user_id', $userID)
                                              ->orderBy('houses.id', 'ASC')
                                              ->get();

            $paidWishlist = DB::table('selcom_payments')->join('wishlist', 'selcom_payments.house_id', '=', 'wishlist.house_id')
                        ->where('selcom_payments.user_id', $userID)
                        ->orderBy('wishlist.house_id', 'ASC')
                        ->get();

            return view('renter.house.wishlist', compact('paidHousesCount', 'wishlistCount', 'myWishlist', 'message', 'paidWishlist'));

            }
        }
        else{
            return view('auth.loginregister', compact('paidHousesCount', 'wishlistCount', 'message'));
        }
    }

    public function wishlist(Request $request)
    {

        $message = "";
        $regions = Region::all();
        $areas = Area::all();

        $userID = Auth::id();

        $paidHousesCount = 0;
        $wishlistCount = 0;

        $userAgent = $request->header('User-Agent');

        $message = "";

        $paidWishlist = [];

        // $myWishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
        //                     ->where('wishlist.user_id', $userID)
        //                     ->orWhere('wishlist.user_agent', $userAgent)
        //                     ->orderBy('houses.id', 'ASC')
        //                     ->get();

        // $wishlistCount = count($myWishlist);

        if($userID){

            $paidHouses = House::join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.user_id', $userID)
                        ->select('houses.*', 'selcom_payments.id as house_id','selcom_payments.payment_status', 'selcom_payments.house_id')
                        ->orderBy('selcom_payments.id', 'ASC')
                        ->groupBy('selcom_payments.id')
                        ->distinct('house_id')
                        ->get();

            $myWishlist = House::with('media')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                        ->where('wishlist.user_id', $userID)
                        ->orWhere('wishlist.user_agent', $userAgent)
                        ->orderBy('houses.id', 'ASC')
                        ->get();

            $paidWishlist = DB::table('selcom_payments')->join('wishlist', 'selcom_payments.house_id', '=', 'wishlist.house_id')
                                        ->where('selcom_payments.user_id', $userID)
                                        ->orderBy('wishlist.house_id', 'ASC')
                                        ->get();

            $paidHousesCount = count($paidHouses);
            $wishlistCount = count($myWishlist);


        return view('renter.house.wishlist', compact('paidHousesCount', 'paidHouses', 'regions', 'areas', 'message', 'myWishlist', 'wishlistCount', 'paidWishlist', 'message'));
        }
        else{
            return view('auth.loginregister', compact('paidHousesCount', 'wishlistCount', 'message'));
        }

    }

    public function deleteWishlist($id){

        $wishlist = Wishlist::find($id);

        if($wishlist){
            $wishlist->delete();
            return redirect()->back();
        }
        return redirect()->back();

    }

}

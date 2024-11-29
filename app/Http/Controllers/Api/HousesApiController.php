<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\House;
use App\Property;
use App\User;
use App\Area;
use App\Wishlist;
use App\Agent;
use App\Region;
use App\District;


class HousesApiController extends Controller

{
    public function index(Request $request)
    {

        $array = [6070, 6062, 6075, 6079, 6080, 5194, 5107, 5198, 5208, 5227, 5225, 5212, 5208, 5196, 5190, 5109, 5108, 4360, 4358, 4344, 4333, 4299, 4300, 4278, 4240, 4234, 4087, 4076, 4071, 4070, 4068, 4066, 2831, 3644, 3742, 3728, 3645, 3554, 3551, 3477, 3463, 3461, 3450, 3441, 3429, 3411, 3404, 3375, 3359, 3352, 3344, 3343, 3342, 3338, 3336, 3250, 3249, 3204, 3202,3477, 4066, 4065, 4053, 4049, 4043, 4036, 4029, 4026, 4020, 4012, 4009, 4007, 4006, 4004, 4001, 3995, 3987, 3979, 3864, 3863, 3862, 3852, 3854, 3855, 3851, 3840, 3817, 3816, 3803, 3802, 3795, 3975, 3973, 3971, 3967, 3965, 3950, 3953, 3944, 3936, 3929, 3928, 3927, 3926, 3924, 3923, 3922, 3916, 3910, 3806, 3905, 3902, 3890, 3876, 3852, 3849, 3847, 3841, 3809, 3806, 3786, 3783, 4479, 4486, 4443, 4487, 4482, 4484, 4614, 4608, 4620, 4599, 4575];


        // $houses = House::with('media','wishlist', 'payment', 'user')->latest()->get();

        $houses = House::with('media','wishlist', 'payment', 'user')->whereIn('id', $array)->orderBy('id', 'DESC')->get();

        $favhouses = Wishlist::where('user_agent', $request->header('User-Agent'))->get();

        $defaultImgUrl = "https://nyumbafasta.co.tz/assets/img/new.jpg";

        foreach($houses as $house){

            if($house->getFirstMediaUrl('featured_image')){

                $house['featured_image'] = $house->getFirstMediaUrl('featured_image');

            }

            else{
                $house['featured_image'] = $defaultImgUrl;
            }

        }

        return response()->json($houses);
    }

    public function allHouse(Request $request){
        $imagesURL = "https://nyumbafasta.co.tz/images/";

        $houses = House::with('media','wishlist', 'payment', 'user')->latest()->paginate(50);

        foreach($houses as $house){

            $house->images = json_decode($house->images, TRUE);

            return response()->json($houses);

        }

    }

    public function indexHousesForSale(Request $request)
    {

        $properties = Property::with('media')->latest()->paginate(12);

        return response()->json($properties);
    }

    public function housesCart($user_id){

        $user = User::where('id', $user_id)->first();

        $defaultImgUrl = "https://nyumbafasta.co.tz/assets/img/new.jpg";

        if($user){

            $orderedHouses = House::with('media','wishlist', 'payment', 'user')
                                    ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                                    ->where('selcom_payments.user_id', $user->id)
                                    ->select('houses.*', 'selcom_payments.id as house_id','selcom_payments.payment_status', 'selcom_payments.house_id')
                                    ->orderBy('selcom_payments.id', 'DESC')
                                    ->groupBy('selcom_payments.id')
                                    ->distinct('house_id')
                                    ->get();

            foreach($orderedHouses as $house){

                    if($house->getFirstMediaUrl('featured_image')){

                            $house['featured_image'] = $house->getFirstMediaUrl('featured_image');

                            }

                        else{

                            $house['featured_image'] = $defaultImgUrl;
                    }

            }

            return response()->json($orderedHouses);
        }

        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }

    public function getFavoriteHouses($user_id){

        $user = User::where('id', $user_id)->first();

        $defaultImgUrl = "https://nyumbafasta.co.tz/assets/img/new.jpg";

        if($user){

            $wishlistHouses = House::with('media','wishlist', 'payment', 'user')->join('wishlist', 'houses.id', '=', 'wishlist.house_id')
                              ->where('wishlist.user_id', $user_id)
                              ->orderBy('houses.id', 'DESC')
                              ->get();

            foreach($wishlistHouses as $house){

                    if($house->getFirstMediaUrl('featured_image')){

                        $house['featured_image'] = $house->getFirstMediaUrl('featured_image');

                            }

                        else{

                        $house['featured_image'] = $defaultImgUrl;

                        }

            }

            return response()->json($wishlistHouses);
        }

        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }

    public function addFavoriteHouse(Request $request){

        $userToken = DB::table('oauth_access_tokens')->where('name', $request->user_token)->first();

        $user = User::where('id', $userToken->user_id)->first();

        $userAgent = $request->header('User-Agent');

        if($user){

        $presentWishlist = DB::table('wishlist')
                                    ->where('house_id',$request->house_id)
                                    ->where('user_id', $userToken->user_id)
                                    ->first();

        if($presentWishlist){

            return response()->json(['success'=>'Already Added To Favorite'], 200);

        }

        else{

            $wishlist = new Wishlist();
            $wishlist->user_id = $userToken->user_id;
            $wishlist->user_agent = $userAgent;
            $wishlist->house_id = $request->house_id;
            $wishlist->save();

            return response()->json(['success'=>'Successfully Added'], 200);
        }
    }

        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }

    public function homeLandlord($user_id){

        $housesCount = House::where('user_id', $user_id)->count();
        $areasCount  = Area::count();
        $rentersCount = User::where('role_id', 3)->count();

        return response()->json(['housesCount'=>$housesCount, 'areasCount'=>$areasCount, 'rentersCount'=>$rentersCount], 200);
    }


    public function store(Request $request)
    {
        //user object
        $user = User::where('id', $request->user_id)->first();

        //image data array
        $data = [];

        $house = new House();
        $house->address = $request->address;
        $house->user_id = $request->user_id;
        $house->contact = $user->contact;
        $house->area_id = $request->area_id;
        $house->agent_id = $request->agent_id;
        $house->district_id = $request->district_id;
        $house->region_id = $request->region_id;
        $house->status = $request->status;
        $house->house_type = $request->house_type;
        $house->tiles = $request->tiles;
        $house->gypsum = $request->gypsum;
        $house->aluminium = $request->aluminium;
        $house->kitchen = $request->kitchen;
        $house->ac = $request->ac;
        $house->fence = $request->fence;
        $house->luku = $request->luku;
        $house->number_of_room = $request->number_of_rooms;
        $house->description = $request->description;
        $house->rent = $request->rent;
        $house->duedate = $request->duedate;
        $house->images = json_encode($data);
        $house->featured_image = $request->featured_image;
        $house->save();

        //image manipulations
        $featured_image = $request->file('featured_image');
        if($featured_image)
        {
             // Make Unique Name for Image
            $currentDate = Carbon::now()->toDateString();
            $featured_image_name = $currentDate.'-'.uniqid().'.'.$featured_image->getClientOriginalExtension();


          // Check Dir is exists

              if (!Storage::disk('public')->exists('featured_house')) {
                 Storage::disk('public')->makeDirectory('featured_house');
              }

              // Resize Image and upload
              $width = 1000; //  max width
              $height = 1000; // max height

              // store uploaded image
              $watermark =  Storage::get('public/nyumbafasta-watermark.png');

              $watermarkSize = Image::make($featured_image)->width() - 20; //size of the image minus 20 margins

              $watermarkSize = Image::make($featured_image)->width() / 2; //half of the image size


              $resizePercentage = 70;//70% less then an actual image (play with this value)
              $watermarkSize = round(Image::make($featured_image)->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image

              // resize watermark width keep height auto
              $watermark =  Image::make($watermark)->resize(400,400, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

              // add watermark and save
                $featured_image = Image::make($featured_image);
                $featured_image->insert($watermark, 'center');


              $cropImage = Image::make($featured_image)->fit($width, $height, function ($constraint) {
                                   $constraint->upsize();
                           })->stream();

              Storage::disk('public')->put('featured_house/'.$featured_image_name,$cropImage);

              //add using media library
              $house->addMedia(Storage::disk('public')->path('featured_house/'.$featured_image_name))->toMediaCollection('featured_image');

              //deleting the copy file
              Storage::disk('public')->delete('featured_house/'.$featured_image_name);

         }



        if($request->hasfile('images'))
        {
             foreach($request->file('images') as $file)
             {
                 $name = time() . '-'. uniqid() . '.'.$file->extension();

            // Resize Image and upload
              $width = 1000; //  max width
              $height = 1000; // max height

               // store uploaded image
               $watermark =  Storage::get('public/nyumbafasta-watermark.png');

               $watermarkSize = Image::make($file)->width() - 20; //size of the image minus 20 margins

               $watermarkSize = Image::make($file)->width() / 2; //half of the image size


               $resizePercentage = 80;//70% less then an actual image (play with this value)
               $watermarkSize = round(Image::make($file)->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image

               // resize watermark width keep height auto
               $watermark =  Image::make($watermark)->resize(400,400, null, function ($constraint) {
                     $constraint->aspectRatio();
                 });

               // add watermark and save
                 $file = Image::make($file);
                 $file->insert($watermark, 'center');


              $cropImage = Image::make($file)->fit($width, $height, function ($constraint) {
                                   $constraint->upsize();
                           })->stream();

              Storage::disk('public')->put('featured_house/'.$name,$cropImage);

              $house->addMedia(Storage::disk('public')->path('featured_house/'.$name))->toMediaCollection('images');

             }
        }
        return response()->json(['success'=>'Successfully Added'], 200);
    }

    public function getLocations(Request $request){


        $regions = Region::orderBy('id', 'ASC')->get();

        foreach($regions as $key=>$region){
            $districts = District::where('region_id', $region->id)->get();
            $region['districts'] = $districts;

            foreach($districts as $index=>$district){
                $areas = Area::where('district_id', $district->id)->get();
                $district['areas'] = $areas;
            }
        }

        return response()->json($regions);

    }

    public function getAgents(Request $request){
        $agents = Agent::pluck('name');
        return response()->json($agents);
    }



    public function test(Request $request)
    {

        return response()->json();

    }

}

<?php

namespace App\Http\Controllers\Dalali;

use App\Region;
use App\District;
use App\Area;
use App\House;
use App\Agent;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use DB;
use Response;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::latest()->where('user_id', Auth::id())->paginate(8);
        $housecount = House::where('user_id', Auth::id())->count();
        return view('dalali.house.index', compact('houses', 'housecount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Area::count() < 1){
            session()->flash('danger','To add new house you have to add area first');
            return redirect()->back();
        }

        $areas = Area::all();
        $agents = Agent::all();
        $regions = Region::all();

        return view('dalali.house.create', compact('areas', 'agents', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'address' => 'required',
            // 'area_id' => 'required',
            'rent' => 'required|numeric',
            'featured_image' => 'required|mimes:jpeg,png,jpg',
            'images.*' => 'required|mimes:jpeg,png,jpg',
        ]);

                //area dropdown logic
        //check if seleect option is not null

        $areaID = null;

        $areas = Area::get();

        foreach($areas as $area){


            if(mb_strtolower($area->name) === mb_strtolower($request->area_search)){

                $area = Area::where('name', $area->name)->first();

                $areaID = $area->id;

            }
        }

        if($areaID == NULL){

            $area = new Area();
            $area->name = $request->area_search;
            $area->user_id = Auth::id();
            $area->region_id = $request->region;
            $area->district_id = $request->district;
            $area->save();

            //assign id
            $areaID = $area->id;
        }


                //image data array
                $data = [];

                $house = new House();
                $house->address = $request->address;
                $house->user_id = Auth::id();
                $house->contact = Auth::user()->contact;
                $house->area_id = $areaID;
                $house->agent_id = $request->agent_id;
                $house->district_id = $request->district;
                $house->region_id = $request->region;
                $house->status = $request->status;
                $house->house_type = $request->house_type;
                $house->tiles = $request->tiles;
                $house->gypsum = $request->gypsum;
                $house->aluminium = $request->aluminium;
                $house->kitchen = $request->kitchen;
                $house->ac = $request->ac;
                $house->fence = $request->fence;
                $house->luku = $request->luku;
                $house->number_of_room = $request->number_of_room;
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
              $cropImage = Image::make($featured_image)->resize($width, $height, function ($constraint) {
                                   $constraint->aspectRatio();
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
              $cropImage = Image::make($file)->resize($width, $height, function ($constraint) {
                                   $constraint->aspectRatio();
                           })->stream();

              Storage::disk('public')->put('featured_house/'.$name,$cropImage);

              $house->addMedia(Storage::disk('public')->path('featured_house/'.$name))->toMediaCollection('images');

             }
        }


        return redirect(route('dalali.house.index'))->with('success', 'House Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        $houseDB = House::with('media')->where('id', $house->id)->first();

        $houseImages = $house->getMedia('images');

        return view('dalali.house.show')->with(['houseDB'=>$houseDB, 'houseImages'=>$houseImages]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        $areas =  Area::all();
        $agents = Agent::all();
        $houses = House::all();
        $regions = Region::all();
        $districts = District::all();

        $houseDB = House::with('media')->where('id', $house->id)->first();

        $houseImages = $house->getMedia('images');

        return view('dalali.house.edit', compact('areas', 'houseDB', 'agents', 'houses', 'houseImages','regions', 'districts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switch($id)
    {
        $house = House::find($id);
        if($house->status == 1){
            $house->status = 0;
        }else{
            $house->status = 1;
        }
        $house->save();

        session()->flash('success', 'House Status Changed Successfully');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {


        $this->validate($request,[
            'address' => 'required',
            // 'area_id' => 'required',
            'number_of_room' => 'required|numeric|integer',
            'rent' => 'required|numeric',
            'featured_image' => 'mimes:jpeg,png,jpg',
            'images.*' => 'mimes:jpeg,png,jpg',
        ]);

        $areaID = null;


        foreach($areas as $area){


            if(mb_strtolower($area->name) === mb_strtolower($request->area_search)){

                $area = Area::where('name', $area->name)->first();

                $areaID = $area->id;

            }
        }

        if($areaID == NULL){

            $area = new Area();
            $area->name = $request->area_search;
            $area->user_id = Auth::id();
            $area->region_id = $request->region;
            $area->district_id = $request->district;
            $area->save();

            //assign id
            $areaID = $area->id;
        }


        $house->address = $request->address;
        $house->user_id = Auth::id();
        $house->contact = Auth::user()->contact;
        $house->area_id = $areaID;
        $house->district_id = $request->district;
        $house->region_id = $request->region;
        $house->status = $request->status;
        $house->agent_id = $request->agent_id;
        $house->house_type = $request->house_type;
        $house->tiles = $request->tiles;
        $house->gypsum = $request->gypsum;
        $house->aluminium = $request->aluminium;
        $house->kitchen = $request->kitchen;
        $house->ac = $request->ac;
        $house->luku = $request->luku;
        $house->fence = $request->fence;
        $house->number_of_room = $request->number_of_room;
        $house->description = $request->description;
        $house->duedate = $request->duedate;
        $house->rent = $request->rent;

        $featured_image = $request->file('featured_image');
        if($featured_image)
        {
             // Make Unique Name for Image
            $currentDate = Carbon::now()->toDateString();
            $featured_image_name = $currentDate.'-'.uniqid().'.'.$featured_image->getClientOriginalExtension();

            $house->featured_image = $request->featured_image;


          // Check Dir is exists

              if (!Storage::disk('public')->exists('featured_house')) {
                 Storage::disk('public')->makeDirectory('featured_house');
              }


              // Resize Image and upload
              $width = 1000; //  max width
              $height = 1000; // max height
              $cropImage = Image::make($featured_image)->resize($width, $height, function ($constraint) {
                                   $constraint->aspectRatio();
                           })->stream();

              Storage::disk('public')->put('featured_house/'.$featured_image_name,$cropImage);

              //* replacing new images with the old ones
              $house->clearMediaCollection('featured_image');
              $house->addMedia(Storage::disk('public')->path('featured_house/'.$featured_image_name))->toMediaCollection('featured_image');

              //deleting the copy file
              Storage::disk('public')->delete('featured_house/'.$featured_image_name);

         }



        if($request->hasfile('images'))
        {
             foreach($request->file('images') as $file)
             {

              $house->clearMediaCollection('images');
              $name = time() . '-'. uniqid() . '.'.$file->extension();

            // Resize Image and upload
              $width = 1000; //  max width
              $height = 1000; // max height
              $cropImage = Image::make($file)->resize($width, $height, function ($constraint) {
                                   $constraint->aspectRatio();
                           })->stream();

              Storage::disk('public')->put('images/'.$name,$cropImage);


              $house->addMedia(Storage::disk('public')->path('featured_house/'.$name))->toMediaCollection('images');

             }
        }


        $house->save();

        return redirect(route('dalali.house.index'))->with('success', 'House Updated successfully');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {

        //delete old featured image
        if(Storage::disk('public')->exists('featured_house/'.$house->featured_image)){
            Storage::disk('public')->delete('featured_house/'.$house->featured_image);
        }

        $house->clearMediaCollection(); // all media will be deleted

        $house->delete();
        return redirect(route('dalali.house.index'))->with('success', 'House Removed Successfully');
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

}




<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\House;
use App\Property;
use App\Area;
use App\Region;
use App\District;
use App\Agent;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use DB;
use Response;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::oldest()->paginate(20);
        $propertiesCount = Property::all()->count();

        return view('admin.property.index', compact('properties', 'propertiesCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all();
        $regions = Region::all();

        return view('admin.property.create', compact('areas', 'regions'));
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
            'price' => 'required|numeric',
            'featured_image' => 'required|mimes:jpeg,png,jpg',
            'images.*' => 'required|mimes:jpeg,png,jpg',
        ]);

        //area dropdown logic
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

        $property = new Property();
        $property->name = $request->name;
        $property->contact = $request->contact;
        $property->address = $request->address;
        $property->user_id = Auth::id();
        $property->area_id = $areaID;
        $property->district_id = $request->district;
        $property->region_id = $request->region;
        $property->status = $request->status;
        $property->property_type = $request->property_type;
        $property->deed = $request->deed;
        $property->sqm = $request->sqm;
        $property->description = $request->description;
        $property->price = $request->price;
        $property->save();

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
              $property->addMedia(Storage::disk('public')->path('featured_house/'.$featured_image_name))->toMediaCollection('featured_image');

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

              $property->addMedia(Storage::disk('public')->path('featured_house/'.$name))->toMediaCollection('images');

             }
        }
        return redirect(route('admin.property.index'))->with('success', 'Property Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $property = Property::with('media')->where('id', $id)->first();
        $propertyImages = $property->getMedia('images');

        return view('admin.property.show', compact('property', 'propertyImages'));
    }


    public function switch($id)
    {
        $property = Property::where('id', $id)->first();

        if($property->status == 1){

            $result= DB::table('properties_for_sale')->where('id',$id)->update(['status'=>0]);

        }else{

            $result=  DB::table('properties_for_sale')->where('id',$id)->update(['status'=> 1 ]);


        }

        // $property->save();

        session()->flash('success', 'House Status Changed Successfully');
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
        $areas =  Area::all();
        $regions = Region::all();
        $districts = District::all();

        $property = Property::with('media')->where('id', $id)->first();

        $propertyImages = $property->getMedia('images');

        return view('admin.property.edit', compact('areas', 'property', 'propertyImages', 'regions', 'districts'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'address' => 'required',
            'price' => 'required|numeric',
        ]);

        $property = Property::find($request->id);

        //area dropdown logic
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

        $property->name = $request->name;
        $property->contact = $request->contact;
        $property->address = $request->address;
        $property->user_id = Auth::id();
        $property->area_id = $areaID;
        $property->district_id = $request->district;
        $property->region_id = $request->region;
        $property->status = $request->status;
        $property->property_type = $request->property_type;
        $property->deed = $request->deed;
        $property->sqm = $request->sqm;
        $property->description = $request->description;
        $property->price = $request->price;

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

              //* replacing new images with the old ones
              $property->clearMediaCollection('featured_image');
              $property->addMedia(Storage::disk('public')->path('featured_house/'.$featured_image_name))->toMediaCollection('featured_image');

              //deleting the copy file
              Storage::disk('public')->delete('featured_house/'.$featured_image_name);

         }



        if($request->hasfile('images'))
        {

            $property->clearMediaCollection('images');

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
              $property->addMedia(Storage::disk('public')->path('featured_house/'.$name))->toMediaCollection('images');

             }
        }
        $property->save();
        return redirect(route('admin.property.index'))->with('success', 'Property Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::find($id);

        $property->clearMediaCollection(); // all media will be deleted

        $property->delete();

        return redirect(route('admin.property.index'))->with('success', 'House Removed Successfully');
    }
}

<?php

namespace App\Http\Controllers\Resource; 
use View;
use App\Hotel;
use App\RoomCategory;
use App\HotelSeasonRate;
use App\HotelGallery;
use App\HotelAmenity;
use App\Amenity;
use App\Country;
use App\Region;
use App\City;
use App\Vender;
use App\RoomTypes;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class HotelResource extends Controller
{
	
	public function __construct(){
		//its just a dummy data object.
		$requests = AdminRequest::orderBy('id' , 'desc')->where('status','OPEN')->with('operator')->get();

		// Sharing is all view of admincontroller
		View::share('requests', $requests); 
	}
	
	
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user=session()->get('admin');
        $hotels = Hotel::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->orderby('hotel_name', 'ASC')->get();
        $Countries = Country::where('status', 'ACTIVE')->get();
        return view('admin.hotel.index', compact('hotels','Countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  //$roomcategories = RoomCategory::All();
       $roomtypes = RoomTypes::All();
       $amenities = Amenity::All();
       $venders = Vender::where('vender_type', 'HOTEL VENDER')->get();
       $Countries = Country::where('status', 'ACTIVE')->get();
       return view('admin.hotel.create', compact('roomtypes', 'amenities','Countries','venders'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		  try{

            $user=session()->get('admin'); 
            if($request->HasFile('hotel_image')){
                $path = $request->file('hotel_image')->store('hotel_images');
            }else{
                $path = '';
            }
            
            
            //$path = Storage::delete('hotel_images/fMDQSE824B5XcSQfPFuT64kXWiF70X1VuWbmhdLj.png'); 
            $hotel = new Hotel();
            $hotel->vender_id = $request->vender_id;
            $hotel->vender_approved = $request->vender_approved;
            $hotel->hotel_name = $request->hotel_name;
            $hotel->hotel_image = $path;
            $hotel->address = $request->address;
            $hotel->googleaddress = $request->googleaddress;
            $hotel->country_id = $request->country_id;
            $hotel->region_id = $request->region_id;
            $hotel->city_id = $request->city_id;
            $hotel->lat = $request->lat;
            $hotel->long = $request->long;
            $hotel->contact_name = $request->contact_name;
            $hotel->contact_number = $request->contact_number;
            $hotel->contact_email = $request->contact_email;
            $hotel->total_room = $request->total_room;
            $hotel->amenities_ids = $request->amenities_ids;
            $hotel->start_category = $request->start_category;
            $hotel->property_type = $request->property_type;
            $hotel->child_age = $request->child_age;
            $hotel->per_night = $request->per_night;
            $hotel->per_person = $request->per_person;
            $hotel->group_rate = $request->group_rate;
            $hotel->group_min_person = $request->group_min_person;
            $hotel->status = $request->status;
            $hotel->payment_details = $request->payment_details;
            $hotel->cancelation_policy = $request->cancelation_policy;
            $hotel->property_id=$user['id'][0];
            $hotel->company_id=$user['comp_id'][0];
            $hotel->save();
            
            
            // Hotel Gallery Image
            if($request->HasFile('image')){
                foreach($request->file('image') as $img){
                    $path = $img->store('hotel_images');
                    $gallery_image = new HotelGallery();
                    $gallery_image->hotel_id = $hotel->id;                    
                    $gallery_image->image = $path;                    
                    $gallery_image->caption = 'Hotel Gallery Image';                    
                    $gallery_image->status = 'ACTIVE';
                    $gallery_image->save();
                }
            }
            
            // Hotel Amenities
            if($request->Has('amenities')){
                foreach($request->amenities as $amenity){
                    $hotel_amenity = new HotelAmenity();
                    $hotel_amenity->hotel_id = $hotel->id;                    
                    $hotel_amenity->amenity_id = $amenity;                    
                    $hotel_amenity->status = 'ACTIVE';
                    $hotel_amenity->save();
                }
            }
            
            // Hotel Category
            if($request->Has('room_type_id')){
                $x = 0;
                foreach($request->room_type_id as $room_type_id){
                    $room_category = new RoomCategory();
                    //$room_category->one_occupancy_cost = $one_occupancy_cost;
                    $room_category->hotel_id = $hotel->id;
                    $room_category->room_type_id = $room_type_id;
                      $roomtypes = RoomTypes::findOrFail($room_type_id);
                    $room_category->type = $roomtypes->room_type;
                    $room_category->name = $request->name[$x];
                    $room_category->room_count = $request->room_count[$x];
                    //$room_category->adult_extra_cost = $request->adult_extra_cost[$x];
                    //$room_category->kid_extra_cost = $request->kid_extra_cost[$x];
                    //$room_category->one_occupancy_cost = $request->one_occupancy_cost[$x];
                    $room_category->status = 'ACTIVE';
                    $room_category->save();
                    $x++;
                }
            }
            
            return back()->with('flash_success','SUCESS: Hotel Saved Successfully');
        
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Not Saved');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $promocode
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {       
        try {
            echo 'this is -- '.$request->id;
            //$hotel = Hotel::findOrFail($id);
            //return view('admin.hotel.show', compact('hotel'));
            $hotel = Hotel::findOrFail($request->id);
            //$amenities = Amenity::All();
            $hotelamenity = HotelAmenity::where('hotel_id', $request->id)->get(); 
            $hotelroomcategoires = RoomCategory::where('hotel_id', $request->id)->get(); 
            $hotelgalleries = HotelGallery::where('hotel_id', $request->id)->get(); 
            // return view('admin.hotel.edit',compact('hotel', 'amenities','hotelamenity','hotelroomcategoires','hotelgalleries' ));
           echo json_encode(array('hotel'=>$hotel,'hotelamenity'=>$hotelamenity,'hotelroomcategoires'=>$hotelroomcategoires,'hotelgalleries'=>$hotelgalleries));


        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function edit($id)
    {
        try {
            //$roomcategories = RoomCategory::All();
            $user=session()->get('admin');
            $hotel = Hotel::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($hotel) {
                $amenities = Amenity::All();
                $venders = Vender::where('vender_type', 'HOTEL VENDER')->get();
                $roomtypes = RoomTypes::All();
                $hotelamenity = HotelAmenity::where('hotel_id', $id)->get(); 
                $hotelroomcategoires = RoomCategory::where('hotel_id', $id)->get(); 
                $hotelgalleries = HotelGallery::where('hotel_id', $id)->get();
                $Countries = Country::where('status', 'ACTIVE')->get();
                $Regions = Region::where('country_id', $hotel->country_id)->where('status', 'ACTIVE')->get();
                $Cities = City::where('region_id', $hotel->region_id)->where('status', 'ACTIVE')->get();
                 
                return view('admin.hotel.edit',compact('hotel', 'amenities','hotelamenity','hotelroomcategoires','roomtypes','hotelgalleries', 'Countries', 'Regions', 'Cities','venders' ));
            } else {
                return back()->with('flash_error', 'Hotel Not Found');
            }
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		
		/*$this->validate($request, [
            'car_name'          => 'required',
            'seat'   => 'required',
        ]);*/
        try{
            $user=session()->get('admin');
			$post = Hotel::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			//$post = HotelAmenity::where('hotel_id', $hotel_id)->delete(); 
			
			/* if($request->has('update_package_id')){
				PackageDetail::where('package_id', $request->update_package_id)->delete();
				PackageAddon::where('package_id', $request->update_package_id)->delete();
				PackageChecklist::where('package_id', $request->update_package_id)->delete();
				PackageRequirement::where('package_id', $request->update_package_id)->delete();
				$package = Package::findOrFail($request->update_package_id);
			}else{
				$package = new Package(); 
			} */ 
			
			
            if( $post ) {
                
                $post->vender_id = $request->vender_id;
                $post->vender_approved = $request->vender_approved;
                $post->hotel_name = $request->hotel_name;
                if($request->hasFile('hotel_image') ) {
                        Storage::delete($post->hotel_image);
                        $post->hotel_image = $request->file('hotel_image')->store('hotel_images');
                }
                if($request->hasFile('hotel_logo') ) {
                        Storage::delete($post->hotel_logo);
                        $post->hotel_logo = $request->file('hotel_logo')->store('hotel_images');
                }
                
                $post->address = $request->address;
                $post->googleaddress = $request->googleaddress;
                $post->country_id = $request->country_id;
                $post->region_id = $request->region_id;
                $post->city_id = $request->city_id;
                $post->lat = $request->lat;
                $post->long = $request->long;
                $post->contact_name = $request->contact_name;
                $post->contact_number = $request->contact_number;
                $post->contact_email = $request->contact_email;
                $post->total_room = $request->total_room;
                $post->amenities_ids = $request->amenities_ids;
                $post->start_category = $request->start_category;
                $post->property_type = $request->property_type;
                $post->child_age = $request->child_age;
                $post->per_night = $request->per_night;
                $post->per_person = $request->per_person;
                $post->group_rate = $request->group_rate;
                $post->gallery_link = $request->gallery_link;
                $post->group_min_person = $request->group_min_person;
                $post->status = $request->status;
                $post->payment_details = $request->payment_details;
                $post->cancelation_policy = $request->cancelation_policy;
                    
                $post->save();
            }
            else {
                return redirect()->route('hotel.index')->with('flash_success', 'Hotel Not Found'); 
            }
            
            
            // Hotel Gallery Image
            if($request->HasFile('image')){
                $hotelgalleries = HotelGallery::where('hotel_id', $id)->get(); 
                   foreach($hotelgalleries as $hotelgallery){
                      Storage::delete($hotelgallery->image);
                   }
                HotelGallery::where('hotel_id', $id)->delete();
                foreach($request->file('image') as $img){
                    $path = $img->store('hotel_images');
                    $gallery_image = new HotelGallery();
                    $gallery_image->hotel_id = $id;                  
                    $gallery_image->image = $path;                    
                    $gallery_image->caption = 'Hotel Gallery Image';                    
                    $gallery_image->status = 'ACTIVE';
                    $gallery_image->save();
                }
            }
            
            // Hotel Amenities
            HotelAmenity::where('hotel_id', $id)->delete();
            if($request->Has('amenities')){
                foreach($request->amenities as $amenity){
                    $hotel_amenity = new HotelAmenity();
                    $hotel_amenity->hotel_id = $id;                    
                    $hotel_amenity->amenity_id = $amenity;                    
                    $hotel_amenity->status = 'ACTIVE';
                    $hotel_amenity->save();
                }
            }
            
            // Hotel Category
            RoomCategory::where('hotel_id', $id)->delete();
            if($request->Has('room_type_id')){
                $x = 0;
                foreach($request->room_type_id as $room_type_id){
                    $room_category = new RoomCategory();
                    //$room_category->one_occupancy_cost = $one_occupancy_cost;
                    $room_category->hotel_id = $id;    
                    $room_category->room_type_id = $room_type_id;
                      $roomtypes = RoomTypes::findOrFail($room_type_id);
                    $room_category->type = $roomtypes->room_type;
                    $room_category->name = $request->name[$x];
                    $room_category->room_count = $request->room_count[$x];
                    //$room_category->adult_extra_cost = $request->adult_extra_cost[$x];
                    //$room_category->kid_extra_cost = $request->kid_extra_cost[$x];
                    //$room_category->one_occupancy_cost = $request->one_occupancy_cost[$x];
                    $room_category->status = 'ACTIVE';
                    $room_category->save();
                    $x++;
                }
            }
            return redirect()->route('hotel.index')->with('flash_success', 'Hotel Updated Successfully'); 
        }
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try { 
            $user=session()->get('admin');
            $post = hotel::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                Storage::delete($post->hotel_image);
                $post->delete();
                return back()->with('flash_success', 'Hotel deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Hotel Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Not Found');
        }
    }
}

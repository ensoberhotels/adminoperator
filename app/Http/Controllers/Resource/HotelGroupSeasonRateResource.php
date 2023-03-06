<?php

namespace App\Http\Controllers\Resource;
use View;
use App\HotelGroupSeasonRate;
use App\Hotel;
use App\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class HotelGroupSeasonRateResource extends Controller
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
    public function index()
    {
        $user=session()->get('admin');
        //$group_rate_hotels = HotelGroupSeasonRate::orderBy('id' , 'desc')->with('hotel')->with('room_category')->get();
        $group_rate_hotels = HotelGroupSeasonRate::select( 'group_rate_hotels.*', 'room_categorys.name as room_category_name', 'hotels.hotel_name' )
                       ->join('hotels', 'hotels.id', '=', 'group_rate_hotels.hotel_id')
                       ->join('room_categorys', 'room_categorys.room_type_id', '=', 'group_rate_hotels.room_type_id')
                       ->orderBy('group_rate_hotels.id' , 'desc')->where('group_rate_hotels.company_id',$user['comp_id'][0])->where('group_rate_hotels.property_id',$user['id'][0])->get();
     	// dd($group_rate_hotels);
        return view('admin.hotelgroupseasonrate.index', compact('group_rate_hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user=session()->get('admin');
        $hotels = Hotel::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->orderby('hotel_name', 'ASC')->get();
        return view('admin.hotelgroupseasonrate.create', compact('hotels'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		 
        /*$this->validate($request, [
            'car_name'          => 'required',
            'seat'   => 'required',
            'car_image'         => 'required|mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);*/

        try{
            $user=session()->get('admin'); 
            $count = count($request->hotel_id);
            for($x = 0; $x< $count; $x++){
                $seasonrate = new HotelGroupSeasonRate(); 
                $seasonrate->hotel_id = $request->hotel_id[$x];
                $seasonrate->room_type_id = $request->room_type_id[$x];
                $seasonrate->start_date = $request->start_date[$x];
                $seasonrate->end_date = $request->end_date[$x];
                $seasonrate->from_no_person = $request->from_no_person[$x];
                $seasonrate->to_no_person = $request->to_no_person[$x];
                $seasonrate->single_sharing = $request->single_sharing[$x];
                $seasonrate->double_sharing = $request->double_sharing[$x];
                $seasonrate->triple_sharing = $request->triple_sharing[$x];
                $seasonrate->quad_sharing = $request->quad_sharing[$x];
                $seasonrate->penta_sharing = $request->penta_sharing[$x];
                //$seasonrate->group_rate = $request->group_rate[$x];
                //$seasonrate->per_person_rate = $request->per_person_rate[$x];
                //$seasonrate->per_night_rate = $request->per_night_rate[$x];
                $seasonrate->property_id=$user['id'][0];
                $seasonrate->company_id=$user['comp_id'][0];
                $seasonrate->status = 'ACTIVE';
                $seasonrate->save();
            }
            
            return back()->with('flash_success','SUCESS: Hotel Group Season Rate Saved Successfully');
        

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Season Rates Not Found');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $promocode
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $hotel_group_season_rates = HotelGroupSeasonRate::findOrFail($id);
            return view('admin.hotelgroupseasonrate.show', compact('hotel_group_season_rates'));

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
            $user=session()->get('admin');
            $hotelgroupseasonrate = HotelGroupSeasonRate::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($hotelgroupseasonrate) {
                $hotels = Hotel::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->orderby('hotel_name', 'ASC')->get();
                $roomcategories = RoomCategory::select('room_type_id as id','type','name')->where('hotel_id', $hotelgroupseasonrate->hotel_id)->where('status', 'ACTIVE')->get();
                return view('admin.hotelgroupseasonrate.edit',compact('hotelgroupseasonrate', 'hotels','roomcategories'));
            } else {
                return back()->with('flash_error', 'Hotel Group Season Rate Record Not Found');
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
			$post = HotelGroupSeasonRate::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			
            if( $post ) {
                $post->hotel_id = $request->hotel_id;
                $post->room_type_id = $request->room_type_id;
                $post->start_date = $request->start_date;
                $post->end_date = $request->end_date;
                $post->from_no_person = $request->from_no_person;
                $post->to_no_person = $request->to_no_person;
                $post->single_sharing = $request->single_sharing;
                $post->double_sharing = $request->double_sharing;
                $post->triple_sharing = $request->triple_sharing;
                $post->quad_sharing = $request->quad_sharing;
                $post->penta_sharing = $request->penta_sharing;
                //$post->group_rate = $request->group_rate;
                //$post->per_person_rate = $request->per_person_rate;
                //$post->per_night_rate = $request->per_night_rate;
                $post->status = $request->status;

                $post->save();
                return redirect()->route('hotelgroupseasonrate.index')->with('flash_success', 'Hotel Group Season Rate Updated Successfully'); 
            }
            else{
                return redirect('/admin/hotelgroupseasonrate')->with('flash_error', 'Hotel Group Season Rate Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Group Season Rate Not Found');
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
            $post = HotelGroupSeasonRate::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Hotel Group Season Rate deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Hotel Group Season Rate Not Found');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Group Season Rate Not Found');
        }
    }
}

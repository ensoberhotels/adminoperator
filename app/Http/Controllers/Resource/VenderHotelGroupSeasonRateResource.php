<?php

namespace App\Http\Controllers\Resource;

use App\HotelGroupSeasonRate;
use App\Hotel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Storage;

class VenderHotelGroupSeasonRateResource extends Controller
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
        $vender_id = session()->get('vender.id');            
        $group_rate_hotels = HotelGroupSeasonRate::select('group_rate_hotels.*', 'hotels.hotel_name','hotels.vender_approved')
                                                ->join('hotels','hotels.id','=','group_rate_hotels.hotel_id')
                                                ->where('hotels.vender_id',$vender_id[0])
                                                ->orderBy('group_rate_hotels.id' , 'desc')->get();
        
		return view('vender.hotelgroupseasonrates.index', compact('group_rate_hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $vender_id = session()->get('vender.id');            
        $hotels = Hotel::where('vender_id',$vender_id[0])->orderBy('id' , 'desc')->get();
        return view('vender.hotelgroupseasonrates.create', compact('hotels'));
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

            $count = count($request->hotel_id);
            for($x = 0; $x< $count; $x++){
                $seasonrate = new HotelGroupSeasonRate(); 
                $seasonrate->hotel_id = $request->hotel_id[$x];
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
            return view('vender.hotelgroupseasonrates.show', compact('hotel_group_season_rates'));

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
            $hotel = Hotel::select('hotels.vender_id')
                            ->join('group_rate_hotels','hotels.id','=','group_rate_hotels.hotel_id')
                            ->where('group_rate_hotels.id',$id)
                            ->first();
            $vender_id = session()->get('vender.id');   
             if(!empty($hotel) && $hotel->vender_id == $vender_id[0] ){
                $hotels = Hotel::where('vender_id',$vender_id[0])->orderBy('id' , 'desc')->get();
                $hotelgroupseasonrate = HotelGroupSeasonRate::findOrFail($id);
                $hotel_approved = Hotel::select('hotels.vender_approved')
                            ->where('hotels.id',$hotelgroupseasonrate->hotel_id)
                            ->first();
            
                return view('vender.hotelgroupseasonrates.edit',compact('hotelgroupseasonrate', 'hotels','hotel_approved'));
            }else{
                return redirect()->route('hotelgroupseasonrates.index')->with('flash_success', 'Sorry! you are trying to access other hotel data'); 

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
			$post = HotelGroupSeasonRate::findOrFail($id);
			
            if( $post ) {
                $post->hotel_id = $request->hotel_id;
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
            }
            
            $post->save();

            return redirect()->route('hotelgroupseasonrates.index')->with('flash_success', 'Hotel Group Season Rate Updated Successfully'); 
            
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

            $post = HotelGroupSeasonRate::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Post deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Post Not Found');
        }
    }
}

<?php

namespace App\Http\Controllers\Resource;
use View;
use App\Transport;
use App\Car;
use App\Vender;
use App\CarSegment;
use App\CarModel;
use App\CarSeats;
use App\Country;
use App\Region;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class VenderTransportResource extends Controller
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
        $datas = Transport::where('vender_id',$vender_id[0])->orderBy('id' , 'desc')->with('car')->with('car_segment')->with('car_model')->with('car_seats')->with('countryName')->with('stateName')->with('cityName')->get();
        return view('vender.transports.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$datas = Car::orderBy('id' , 'desc')->get();
        $vender_id = session()->get('vender.id'); 
        $Countries = Country::where('status', 'ACTIVE')->get();
        return view('vender.transports.create', compact('datas','vender_id','Countries'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		 
        $this->validate($request, [
            'car_id'        => 'required',
            'type'   		=> 'required',
            'fare'  		=> 'required',
            'perday_km'   	=> 'required',
            'perkm_fare'   	=> 'required'
        ]);

        try{

            $post = $request->all();

            $res = Transport::create( $post );
			
            return back()->with('flash_success','Transport Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Transport Not Found');
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
            return Transport::findOrFail($id);
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
			$cars = Car::orderBy('id' , 'desc')->get();
            $vender_id = session()->get('vender.id');            
        
            $data = Transport::findOrFail($id);
            if(!empty($data) && $data->vender_id == $vender_id[0] ){
                
                $Countries = Country::where('status', 'ACTIVE')->get();
            $Regions = Region::where('country_id', $data->country_id)->where('status', 'ACTIVE')->get();
            $Cities = City::where('region_id', $data->region_id)->where('status', 'ACTIVE')->get();
            
            $car_segment = CarSegment::where('id', $data->car_segment_id)->first();
            $car_model = CarModel::where('id', $data->car_model_id)->first();
            $car_seat = CarSeats::where('id', $data->car_seats_id)->first();
            
               return view('vender.transports.edit',compact('data','cars', 'Countries', 'Regions', 'Cities','car_segment','car_model','car_seat'));
            }else{
               return redirect()->route('transports.index')->with('flash_success', 'Sorry! you are trying to access other transport data'); 
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
		
		$this->validate($request, [
            'car_id'        => 'required',
            'type'   		=> 'required',
            'fare'  		=> 'required',
            'perday_km'   	=> 'required',
            'perkm_fare'   	=> 'required'
        ]);

        try{
			$post = Transport::findOrFail($id);
			
            if( $post ) {
                $post->car_id	       	=   $request->car_id;
                $post->type   			=   $request->type;
                $post->country_id           =   $request->country_id;
                $post->region_id            =   $request->region_id;
                $post->city_id              =   $request->city_id;
                $post->car_segment_id       =   $request->car_segment_id;
                $post->car_model_id         =   $request->car_model_id;
                $post->car_seats_id               =   $request->car_seats_id;
                $post->fare   			=   $request->fare;
                $post->perday_km   		=   $request->perday_km;
                $post->perkm_fare   	=   $request->perkm_fare;
                $post->available_seat   =   $request->available_seat;
                $post->status       =   $request->status;
            }
            
            $post->save();

            return redirect()->route('transports.index')->with('flash_success', 'Transport Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Transport Not Found');
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

            $post = Transport::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('message', 'Transport deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Transport Not Found');
        }
    }
}

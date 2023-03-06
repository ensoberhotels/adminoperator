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

class TransportResource extends Controller
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
        $datas = Transport::orderBy('id' , 'desc')->with('car')->with('venderName')->with('car_segment')->with('car_model')->with('car_seats')->with('countryName')->with('stateName')->with('cityName')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.transport.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user=session()->get('admin');
		$datas = Car::orderBy('id' , 'desc')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
		$venders = Vender::where('vender_type','TRANSPORT VENDER')->orderBy('id' , 'desc')->get();
        $Countries = Country::where('status', 'ACTIVE')->get();
        return view('admin.transport.create', compact('datas','venders','Countries'));
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
            'vender_id'     => 'required',
            'type'   		=> 'required',
            'fare'  		=> 'required',
            'perday_km'   	=> 'required',
            'perkm_fare'   	=> 'required'
        ]);
        
        try{
            $user=session()->get('admin');

            $data = new Transport();
            $data->car_id               =   $request->car_id;
            $data->vender_id            =   $request->vender_id;
            $data->vender_approved      =   $request->vender_approved;
            $data->country_id           =   $request->country_id;
            $data->region_id            =   $request->region_id;
            $data->city_id              =   $request->city_id;
            $data->car_segment_id       =   $request->car_segment_id;
            $data->car_model_id         =   $request->car_model_id;
            $data->car_seats_id	       	=   $request->car_seats_id;
            $data->type   			    =   $request->type;
            $data->fare   			    =   $request->fare;
            $data->perday_km   		    =   $request->perday_km;
            $data->perkm_fare   	    =   $request->perkm_fare;
            $data->available_seat       =   $request->available_seat;
            $data->status   	        =   $request->status;
            $data->toll   	            =   $request->toll;
            $data->tax   	            =   $request->tax;
            $data->parking   	        =   $request->parking;
            $data->allowance   	        =   $request->allowance;
            $data->property_id          =   $user['id'][0];
            $data->company_id           =   $user['comp_id'][0];

            $data->save();
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
            return Transport::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
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
			$cars = Car::orderBy('id' , 'desc')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
            $data = Transport::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($data) {
                $venders = Vender::where('vender_type','TRANSPORT VENDER')->orderBy('id' , 'desc')->get();
                $Countries = Country::where('status', 'ACTIVE')->get();
                $Regions = Region::where('country_id', $data->country_id)->where('status', 'ACTIVE')->get();
                $Cities = City::where('region_id', $data->region_id)->where('status', 'ACTIVE')->get();
                
                
                $car_segment = CarSegment::where('id', $data->car_segment_id)->first();
                $car_model = CarModel::where('id', $data->car_model_id)->first();
                $car_seat = CarSeats::where('id', $data->car_seats_id)->first();
                // $car_segment = CarSegment::where('id', $data->car_segment_id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
                // $car_model = CarModel::where('id', $data->car_model_id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
                // $car_seat = CarSeats::where('id', $data->car_seats_id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
                // dd($car_segment, $car_model, $car_seat);
                return view('admin.transport.edit',compact('data','cars','venders', 'Countries', 'Regions', 'Cities','car_segment','car_model','car_seat'));
            } else {
                return back()->with('flash_error', 'Transport Not Found');
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
            'vender_id'     => 'required',
            'type'   		=> 'required',
            'fare'  		=> 'required',
            'perday_km'   	=> 'required',
            'perkm_fare'   	=> 'required'
        ]);

        try{
            $user=session()->get('admin');
			$post = Transport::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			
            if( $post ) {
                $post->car_id               =   $request->car_id;
                $post->vender_id            =   $request->vender_id;
                $post->vender_approved      =   $request->vender_approved;
                $post->country_id           =   $request->country_id;
                $post->region_id            =   $request->region_id;
                $post->city_id              =   $request->city_id;
                $post->car_segment_id       =   $request->car_segment_id;
                $post->car_model_id         =   $request->car_model_id;
                $post->car_seats_id	       	=   $request->car_seats_id;
                $post->type   			=   $request->type;
                $post->fare   			=   $request->fare;
                $post->perday_km   		=   $request->perday_km;
                $post->perkm_fare   	=   $request->perkm_fare;
                $post->available_seat   =   $request->available_seat;
                $post->status   	    =   $request->status;
                $post->toll   	    =   $request->toll;
                $post->tax   	    =   $request->tax;
                $post->parking   	    =   $request->parking;
                $post->allowance   	    =   $request->allowance;
                $post->save();
                return redirect()->route('transport.index')->with('flash_success', 'Transport Updated Successfully'); 
            }
            else {
                return redirect()->route('transport.index')->with('flash_error', 'Transport Not Found');
            }
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
            $user=session()->get('admin');
            $post = Transport::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
                return back()->with('message', 'Transport deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Transport Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Transport Not Found');
        }
    }
}

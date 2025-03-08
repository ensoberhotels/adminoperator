<?php

namespace App\Http\Controllers\Resource;
use View;
use App\Car;
use App\CarSegment;
use App\CarModel;
use App\CarSeats;
use Illuminate\Http\Request; 
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class CarSeatsResource extends Controller
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
        $CarSeats = CarSeats::orderBy('id' , 'desc')->with('car_segment')->with('car_model')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.carsseats.index', compact('CarSeats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user=session()->get('admin');
        $car_segments = CarSegment::orderBy('id' , 'desc')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.carsseats.create', compact('car_segments'));
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
            'car_segment_id'          => 'required',
            'car_model_id'   => 'required',
            'seats'  => 'required'
        ]);

        try{
            $user=session()->get('admin');
            $data = new CarSeats();
            $data->seats = $request->seats;
            $data->car_model_id = $request->car_model_id;
            $data->car_segment_id	  =   $request->car_segment_id;
            $data->property_id=$user['id'][0];
            $data->company_id=$user['comp_id'][0];
            
            $data->save();
            return back()->with('flash_success','Car CarSeat Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Car CarSeat Not Found');
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
            return CarSeat::findOrFail($id);
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
            $car_seat = CarSeats::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            $car_seats = CarSegment::orderBy('id' , 'desc')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
            return view('admin.carsseats.edit',compact('car_model','$car_seats'));
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
            'car_segment_id'          => 'required',
            'name'          => 'required',
            
        ]);

        try{
            $user=session()->get('admin');
			$post = CarSeats::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			
            if( $post ) {
                $post->car_seats_id	  =   $request->car_seats_id;
                $post->name	  =   $request->name;
            }
            
            $post->save();

            return redirect()->route('carsseats.index')->with('flash_success', 'Car Seats Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Car Not Found');
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
            $post = CarSeats::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
				return back()->with('flash_success', 'Car Seat Deleted Successfull!');
            }
            else {
                return back()->with('flash_error', 'Car Seat Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Car Seat Not Found');
        }
    }
}

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

class CarResource extends Controller
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
        $cars = Car::orderBy('id' , 'desc')->with('car_segment')->with('car_model')->with('car_seats')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user=session()->get('admin');
        $car_segments = CarSegment::where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.car.create', compact('car_segments'));
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
            'car_model_id'          => 'required',
            'car_seats_id'          => 'required',
            'car_name'          => 'required',
            'car_image'         => 'required|mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);

        try{
            $user=session()->get('admin');
            $data = new Car();

            if($request->hasFile('car_image')) {
                $data->car_image = $request->car_image;
            }
			
            $data->car_segment_id = $request->car_segment_id;
            $data->car_model_id = $request->car_model_id;
            $data->car_seats_id = $request->car_seats_id;
            $data->car_name = $request->car_name;
            $data->property_id=$user['id'][0];
            $data->company_id=$user['comp_id'][0];
            
            $data->save();
            return back()->with('flash_success','Car Saved Successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Car Not Found');
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
            return Car::findOrFail($id);
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
            $car = Car::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($car) {
                $car_segments = CarSegment::where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
                $car_models = CarModel::where('car_segment_id', $car->car_segment_id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
                $car_seats = CarSeats::where('car_model_id', $car->car_model_id)->where('car_segment_id', $car->car_segment_id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
                
                return view('admin.car.edit',compact('car','car_segments','car_models','car_seats'));    
            } else {
                return back()->with('flash_error', 'Car Not Found');
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Car Not Found');
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
            'car_model_id'          => 'required',
            'car_seats_id'          => 'required',
            'car_name'          => 'required',
            
        ]);

        try{
            $user=session()->get('admin');
			$post = Car::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			
            if( $post ) {
                $post->car_name	       	=   $request->car_name;
                $post->car_segment_id   =   $request->car_segment_id;
                $post->car_model_id     =   $request->car_model_id;
                $post->car_seats_id     =   $request->car_seats_id;
                $post->status   	=   $request->status;

                if($request->hasFile('car_image') ) {
                    Storage::delete($post->car_image);
                    $post->car_image = $request->car_image->store('car');
                }
                $post->save();
    
                return redirect()->route('car.index')->with('flash_success', 'Car Updated Successfully'); 
            }
            else {
                return redirect()->route('car.index')->with('flash_error', 'Car Not Found');
            }    
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
            $post = Car::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                Storage::delete($post->car_image);
                $post->delete();
                return back()->with('message', 'Post deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Post Not Found');
            }
        }
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Post Not Found');
        }
    }
}

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

class CarSegmentResource extends Controller
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
        $car_segments = CarSegment::orderBy('id' , 'desc')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.carsegment.index', compact('car_segments'));
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
        return view('admin.carsegment.create', compact('car_segments'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=session()->get('admin');
        $this->validate($request, [
            'name'          => 'required',
        ]);

        try{
            $data = new CarSegment();
            $data->name = $request->name;
            $data->property_id=$user['id'][0];
            $data->company_id=$user['comp_id'][0];
            
            $data->save();
			
            return back()->with('flash_success','Car Segment Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Car Segment Not Found');
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
            return CarSegment::findOrFail($id);
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
            $car_segment = CarSegment::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($car_segment) {
                return view('admin.carsegment.edit',compact('car_segment'));
            } else {
                return back()->with('flash_error', 'Car Segment Not Found');
            }
            
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Car Segment Not Found');
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
            'name'          => 'required',
            
        ]);

        try{
            $user=session()->get('admin');
			$post = CarSegment::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			
            if( $post ) {
                $post->name	  =   $request->name;
                $post->save();
                return redirect()->route('carsegment.index')->with('flash_success', 'Car Segment Updated Successfully'); 
            }
            else {
                return redirect()->route('carsegment.index')->with('flash_error', 'Car Segment Not Found'); 
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Car Segment Not Found');
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
            $post = CarSegment::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
				return back()->with('flash_success', 'Car Segment Deleted Successfull!');
            }
            else {
                return back()->with('flash_error', 'Car Segment Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Car Segment Not Found');
        }
    }
}

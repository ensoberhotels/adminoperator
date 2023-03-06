<?php

namespace App\Http\Controllers\Resource;
use View;
use App\Car;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class VenderCarResource extends Controller
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
        $cars = Car::orderBy('id' , 'desc')->get();
        return view('vender.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vender.cars.create');
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
            'car_name'          => 'required',
            'seat'   => 'required',
            'car_image'         => 'required|mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);

        try{

            $post = $request->all();

            if($request->hasFile('car_image')) {
                $post['car_image'] = $request->car_image->store('car');
            }
			
            $res = Car::create( $post );
			
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

            $car = Car::findOrFail($id);
            return view('vender.cars.edit',compact('car'));
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
            'car_name'          => 'required',
            'seat'   => 'required',
        ]);

        try{
			$post = Car::findOrFail($id);
			
            if( $post ) {
                $post->car_name	       	=   $request->car_name;
                $post->seat   	=   $request->seat;
                $post->status   	=   $request->status;

                if($request->hasFile('car_image') ) {
                    Storage::delete($post->car_image);
                    $post->car_image = $request->car_image->store('car');
                }
            }
            
            $post->save();

            return redirect()->route('cars.index')->with('flash_success', 'Car Updated Successfully'); 
            
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

            $post = Car::findOrFail($id);
            if( $post ) {
                Storage::delete($post->car_image);
                $post->delete();
                return back()->with('message', 'Post deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Post Not Found');
        }
    }
}

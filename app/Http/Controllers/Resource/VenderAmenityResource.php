<?php

namespace App\Http\Controllers\Resource;
use View;
use App\Amenity;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class VenderAmenityResource extends Controller
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
        $amenities = Amenity::orderBy('id' , 'desc')->get();
        return view('vender.amenities.index', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vender.amenities.create');
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
            'name'          => 'required',
            'paid_status'   => 'required',
            'image'         => 'required|mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);

        try{

            $post = $request->all();

            if($request->hasFile('image')) {
                $post['image'] = $request->image->store('amenity');
            }
			
            $res = Amenity::create( $post );
			
            return back()->with('flash_success','Amenity Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Amenity Not Found');
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
            return Amenity::findOrFail($id);
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

            $amenity = Amenity::findOrFail($id);
            return view('vender.amenities.edit',compact('amenity'));
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
            'name'          => 'required',
            'paid_status'   => 'required',
        ]);

        try{
			$post = Amenity::findOrFail($id);
			
            if( $post ) {
                $post->name	       	=   $request->name;
                $post->paid_status   	=   $request->paid_status;
                $post->status   	=   $request->status;

                if($request->hasFile('image') ) {
                    Storage::delete($post->image);
                    $post->image = $request->image->store('amenity');
                }
            }
            
            $post->save();

            return redirect()->route('amenities.index')->with('flash_success', 'Amenity Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Amenity Not Found');
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

            $post = Amenity::findOrFail($id);
            if( $post ) {
                Storage::delete($post->image);
                $post->delete();
                return back()->with('message', 'Amenity deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Amenity Not Found');
        }
    }
}

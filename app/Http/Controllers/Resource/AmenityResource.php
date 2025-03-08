<?php

namespace App\Http\Controllers\Resource;
use View;
use App\Amenity;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class AmenityResource extends Controller
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
        $amenities = Amenity::orderBy('id' , 'desc')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.amenity.index', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.amenity.create');
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
            $user=session()->get('admin');
            $post = $request->all();

            // if($request->hasFile('image')) {
            //     $post['image'] = $request->image->store('amenity');
            // }
            // $res = Amenity::create( $post );

            $data  = new Amenity();
            $data->name	       	=   $request->name;
            $data->paid_status   	=   $request->paid_status;
            $data->status   	=   $request->status;
            if($request->hasFile('image') ) {
                $data->image = $request->image->store('amenity');
            }
            $data->property_id          =   $user['id'][0];
            $data->company_id           =   $user['comp_id'][0];
            $data->save();
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
            return Amenity::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
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
            $amenity = Amenity::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($amenity) {
                return view('admin.amenity.edit',compact('amenity'));
            } else {
                return back()->with('flash_error', 'Amenity Not Found');
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Amenity Not Found');
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
            $user=session()->get('admin');
			$post = Amenity::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->name	       	=   $request->name;
                $post->paid_status   	=   $request->paid_status;
                $post->status   	=   $request->status;

                if($request->hasFile('image') ) {
                    Storage::delete($post->image);
                    $post->image = $request->image->store('amenity');
                }
                $post->save();
                return redirect()->route('amenity.index')->with('flash_success', 'Amenity Updated Successfully'); 
            }
            else {
                return redirect()->route('amenity.index')->with('flash_error', 'Amenity Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return redirect()->route('amenity.index')->with('flash_error', 'Amenity Not Found');
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
            $post = Amenity::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                Storage::delete($post->image);
                $post->delete();
                return back()->with('flash_success', 'Amenity deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Amenity Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Amenity Not Found');
        }
    }
}

<?php

namespace App\Http\Controllers\Resource; 
use View;
use App\ActivityCat;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class VenderActivityCatResource extends Controller
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
        $activitycats = ActivityCat::orderBy('id' , 'desc')->get();
        return view('vender.activitycats.index', compact('activitycats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vender.activitycats.create');
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
            'activity_cat'          => 'required',
        ]);

        try{

            $post = $request->all();			
            $res = ActivityCat::create( $post );
			
            return back()->with('flash_success','Activity Cat Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Cat Not Found');
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
            return ActivityCat::findOrFail($id);
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

            $activitycat = ActivityCat::findOrFail($id);
            return view('vender.activitycats.edit',compact('activitycat'));
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
            'activity_cat'          => 'required',
        ]);

        try{
			$post = ActivityCat::findOrFail($id);
			
            if( $post ) {
                $post->activity_cat	       	=   $request->activity_cat;
                $post->status   	=   $request->status;
            }
            $post->save();

            return redirect()->route('activitycats.index')->with('flash_success', 'Activity Cat Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Cat Not Found');
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

            $post = ActivityCat::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('message', 'Activity Cat deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Cat Not Found');
        }
    }
}

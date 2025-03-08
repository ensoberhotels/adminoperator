<?php

namespace App\Http\Controllers\Resource;
use View;
use App\ActivityCat;
use App\ActivityName;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class VenderActivityNameResource extends Controller 
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
        $activitynames = ActivityName::orderBy('id' , 'desc')->with('ActivityCat')->get();
        return view('vender.activitynames.index', compact('activitynames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$ActivityCats = ActivityCat::All();
        return view('vender.activitynames.create', compact('ActivityCats'));
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
            'activity_cat_id'          => 'required',
            'activity_name'          => 'required',
        ]);

        try{

            $post = $request->all();			
            $res = ActivityName::create( $post );
			
            return back()->with('flash_success','Activity Name Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Name Not Found');
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
            return ActivityName::findOrFail($id);
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
			$ActivityCats = ActivityCat::All();
            $activityname = ActivityName::findOrFail($id);
            return view('vender.activitynames.edit',compact(['activityname','ActivityCats']));
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
            'activity_cat_id'          => 'required',
            'activity_name'          => 'required',
        ]);

        try{
			$post = ActivityName::findOrFail($id);
			
            if( $post ) {
                $post->activity_cat_id	       	=   $request->activity_cat_id;
                $post->activity_name	       	=   $request->activity_name;
                $post->status   	=   $request->status;
            }
            $post->save();

            return redirect()->route('activitynames.index')->with('flash_success', 'Activity Name Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Name Not Found');
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

            $post = ActivityName::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('message', 'Activity Name deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Name Not Found');
        }
    }
}

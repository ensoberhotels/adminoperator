<?php

namespace App\Http\Controllers\Resource; 
use View;
use App\ActivityCat;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class ActivityCatResource extends Controller
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
        $activitycats = ActivityCat::orderBy('id' , 'desc')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.activitycat.index', compact('activitycats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.activitycat.create');
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
            $user=session()->get('admin');
            $post = $request->all();			
            $data = new ActivityCat();
            $data->activity_cat = $request->activity_cat;
            $data->property_id          =   $user['id'][0];
            $data->company_id           =   $user['comp_id'][0];
			$data->save();
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
            return ActivityCat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
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
            $activitycat = ActivityCat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($activitycat) {
                return view('admin.activitycat.edit',compact('activitycat'));
            } else {
                return back()->with('flash_error', 'Activity Cat Not Found');
            }
            
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Cat Not Found');
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
            $user=session()->get('admin');
			$post = ActivityCat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			
            if( $post ) {
                $post->activity_cat	       	=   $request->activity_cat;
                $post->status   	=   $request->status;
                $post->save();
                return redirect()->route('activitycat.index')->with('flash_success', 'Activity Cat Updated Successfully'); 
            }
            else {
                return redirect()->route('activitycat.index')->with('flash_error', 'Activity Cat Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return redirect()->route('activitycat.index')->with('flash_error', 'Activity Cat Not Found');
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
            $post = ActivityCat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Activity Cat deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Activity Cat Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Cat Not Found');
        }
    }
}

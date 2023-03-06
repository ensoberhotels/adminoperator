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

class ActivityNameResource extends Controller 
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
        $activitynames = ActivityName::orderBy('id' , 'desc')->with('ActivityCat')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.activityname.index', compact('activitynames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=session()->get('admin');
		$ActivityCats = ActivityCat::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.activityname.create', compact('ActivityCats'));
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
            $user=session()->get('admin');
            // $post = $request->all();			
            $data = new ActivityName();
            $data->activity_cat_id	       	=   $request->activity_cat_id;
            $data->activity_name	       	=   $request->activity_name;
            $data->status   	            =   $request->status;
            $data->property_id          =   $user['id'][0];
            $data->company_id           =   $user['comp_id'][0];

            $data->save();
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
            return ActivityName::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
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
            $activityname = ActivityName::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			if ($activityname) {
                $ActivityCats = ActivityCat::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
                return view('admin.activityname.edit',compact(['activityname','ActivityCats']));
            } else {
                return back()->with('flash_error', 'Activity Name Not Found');
            }
            
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Name Not Found');
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
            $user=session()->get('admin');
			$post = ActivityName::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->activity_cat_id	       	=   $request->activity_cat_id;
                $post->activity_name	       	=   $request->activity_name;
                $post->status   	=   $request->status;
                $post->save();
                return redirect()->route('activityname.index')->with('flash_success', 'Activity Name Updated Successfully'); 
            }
            else {
                return redirect()->route('activityname.index')->with('flash_error', 'Activity Name Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return redirect()->route('activityname.index')->with('flash_error', 'Activity Name Not Found');
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
            $post = ActivityName::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Activity Name deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Activity Name Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Name Not Found');
        }
    }
}

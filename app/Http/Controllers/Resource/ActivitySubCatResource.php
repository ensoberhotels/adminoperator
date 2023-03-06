<?php

namespace App\Http\Controllers\Resource;
use View;
use App\ActivityCat;
use App\ActivityName;
use App\ActivitySubCat;
use App\Country;
use App\Region;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class ActivitySubCatResource extends Controller 
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
        $activitysubcats = ActivitySubCat::orderBy('id' , 'desc')->with('activityCat')->with('countryName')->with('stateName')->with('cityName')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.activitysubcat.index', compact('activitysubcats'));
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
		$Countries = Country::where('status', 'ACTIVE')->get();
        return view('admin.activitysubcat.create', compact('ActivityCats', 'Countries'));
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
            'activity_subcat'          => 'required',
        ]);

        try{
            $user=session()->get('admin');
            $post = $request->all();			
            $data = new ActivitySubCat();
            $data->activity_cat_id      = $request->activity_cat_id;
            $data->activity_subcat      = $request->activity_subcat;
            $data->property_id          =   $user['id'][0];
            $data->company_id           =   $user['comp_id'][0];
			$data->save();
			
            return back()->with('flash_success','Activity Sub Cat Saved Successfully');
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Sub Cat Not Found');
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
            return ActivitySubCat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
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
			$activitysubcat = ActivitySubCat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			if ($activitysubcat) {
                $ActivityCats = ActivityCat::where('status', 'ACTIVE')->where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
                $ActivityNames = ActivityName::where('activity_cat_id', $activitysubcat->activity_cat_id)->where('status', 'ACTIVE')->get();
                $Countries = Country::where('status', 'ACTIVE')->get();
                $Regions = Region::where('country_id', $activitysubcat->country_id)->where('status', 'ACTIVE')->get();
                $Citys = City::where('region_id', $activitysubcat->region_id)->where('status', 'ACTIVE')->get();
                return view('admin.activitysubcat.edit',compact(['ActivityCats','Countries','activitysubcat', 'ActivityNames', 'Regions', 'Citys']));
            } else {
                return back()->with('flash_error', 'Activity Sub Cat Not Found');
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Sub Cat Not Found');
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
            'activity_name_id'          => 'required',
            'activity_subcat'          => 'required',
            'country_id'          => 'required',
            'region_id'          => 'required',
            'city_id'          => 'required',
        ]);

        try{
			$post = ActivitySubCat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			
            if( $post ) {
                $post->activity_cat_id	       	=   $request->activity_cat_id;
                $post->activity_name_id	       	=   $request->activity_name_id;
                $post->activity_subcat	       	=   $request->activity_subcat;
                $post->country_id	       	=   $request->country_id;
                $post->region_id	       	=   $request->region_id;
                $post->city_id	       	=   $request->city_id;
                $post->status   	=   $request->status;
                $post->save();
    
                return redirect()->route('activitysubcat.index')->with('flash_success', 'Activity Sub Cat Updated Successfully'); 
            }
            else {
                return redirect()->route('activitysubcat.index')->with('flash_error', 'Activity Sub Cat Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return redirect()->route('activitysubcat.index')->with('flash_error', 'Activity Sub Cat Not Found');
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
            $post = ActivitySubCat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Activity Sub Cat deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Activity Sub Cat Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Sub Cat Not Found');
        }
    }
}

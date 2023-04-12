<?php
namespace App\Http\Controllers\Resource;
use View;
use App\ActivityCat;
use App\ActivityName;
use App\ActivitySubCat;use App\Activity; 
use App\Country;
use App\Region;
use App\City;
use App\Vender;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class ActivityResource extends Controller 
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
        $activities = Activity::orderBy('id' , 'desc')->with('activityCat')->with('countryName')->with('stateName')->with('cityName')->with('venderName')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.activity.index', compact('activities'));
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
        $venders = Vender::where('vender_type','EVENT VENDER')->orderBy('id' , 'desc')->get();
        return view('admin.activity.create', compact('ActivityCats', 'Countries','venders'));
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
            'activity_subcat_id'          => 'required',
            'country_id'          => 'required',
            'region_id'          => 'required',
            'city_id'          => 'required',
            'price'          => 'required',
            'actual_price'          => 'required',
        ]);

        try{
            $user=session()->get('admin');
            $post = $request->all();	
			
            $data = new Activity();
			if($request->HasFile('image')){
				$data->image = $request->file('image')->store('activity');
			}else{
				$data->image = '';
			}
            $data->activity_cat_id	       	=   $request->activity_cat_id;
            $data->activity_subcat_id	       	=   $request->activity_subcat_id;
            $data->country_id	       	=   $request->country_id;
            $data->region_id	       	=   $request->region_id;
            $data->city_id	       	=   $request->city_id;
            $data->actual_price       =   $request->actual_price;
            $data->price       =   $request->price;
            $data->vender_approved   	=   $request->vender_approved;
            $data->morning_slot   	=   $request->morning_slot;
            $data->evening_slot   	=   $request->evening_slot;
            $data->status   	=   $request->status;
            $data->property_id          =   $user['id'][0];
            $data->company_id           =   $user['comp_id'][0];

            $data->save();
            return back()->with('flash_success','Activity Saved Successfully');
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
			$Activity = Activity::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			if ($Activity) {
                $ActivityCats = ActivityCat::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
                $ActivityNames = ActivityName::where('activity_cat_id', $Activity->activity_cat_id)->where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
                $Countries = Country::where('status', 'ACTIVE')->get();
                $Regions = Region::where('country_id', $Activity->country_id)->where('status', 'ACTIVE')->get();
                $Citys = City::where('region_id', $Activity->region_id)->where('status', 'ACTIVE')->get();
                
                $activitysubcats = ActivitySubCat::where('activity_cat_id', $Activity->activity_cat_id)->where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
                
                $venders = Vender::where('vender_type','EVENT VENDER')->orderBy('id' , 'desc')->get();
                return view('admin.activity.edit',compact(['ActivityCats','Countries','activitysubcats', 'ActivityNames', 'Regions', 'Citys', 'Activity','venders']));
            } else {
                return back()->with('flash_error', 'Activity Not Found');
            }
        } catch (ModelNotFoundException $e) { 
            return back()->with('flash_error', 'Activity Not Found');
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
            'activity_subcat_id'          => 'required',
            'country_id'          => 'required',
            'region_id'          => 'required',
            'city_id'          => 'required',
            'price'          => 'required',
        ]);

        try{
            $user=session()->get('admin');
			$post = Activity::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			
			if($request->hasFile('image') ) {
				Storage::delete($post->image);
				$post->image = $request->file('image')->store('activity');
            }
            if( $post ) {
                $post->activity_cat_id	       	=   $request->activity_cat_id;
                $post->activity_subcat_id	       	=   $request->activity_subcat_id;
                $post->country_id	       	=   $request->country_id;
                $post->region_id	       	=   $request->region_id;
                $post->city_id	       	=   $request->city_id;
                $post->actual_price       =   $request->actual_price;
                $post->price       =   $request->price;
                $post->vender_approved   	=   $request->vender_approved;
                $post->morning_slot   	=   $request->morning_slot;
                $post->evening_slot   	=   $request->evening_slot;
                $post->status   	=   $request->status;
                $post->save();
    
                return redirect()->route('activity.index')->with('flash_success', 'Activity Updated Successfully'); 
            }
            else {
                return redirect()->route('activity.index')->with('flash_error', 'Activity Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return redirect()->route('activity.index')->with('flash_error', 'Activity Not Found');
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
            $post = Activity::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
				Storage::delete($post->image);
                $post->delete();
                return back()->with('flash_success', 'Activity deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Activity Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Not Found');
        }
    }
}

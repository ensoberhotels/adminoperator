<?php
namespace App\Http\Controllers\Resource;
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
use View;

class VenderActivityResource extends Controller 
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
        $vender_id = session()->get('vender.id');   
            
        $activities = Activity::where('vender_id',$vender_id[0])->orderBy('id' , 'desc')->with('activityCat')->with('countryName')->with('stateName')->with('cityName')->get();
        return view('vender.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$ActivityCats = ActivityCat::where('status', 'ACTIVE')->get();
		$Countries = Country::where('status', 'ACTIVE')->get();
        $vender_id = session()->get('vender.id');   
        return view('vender.activities.create', compact('ActivityCats', 'Countries','vender_id'));
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
            'activity_name_id'          => 'required',
            'activity_subcat_id'          => 'required',
            'country_id'          => 'required',
            'region_id'          => 'required',
            'city_id'          => 'required',
            'price'          => 'required',
        ]);

        try{

            $post = $request->all();			
            $res = Activity::create( $post );
			
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
            return ActivitySubCat::findOrFail($id);
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
			$Activity = Activity::find($id);
            $vender_id = session()->get('vender.id');   
            if(!empty($Activity) && $Activity->vender_id == $vender_id[0] ){
            
			$ActivityCats = ActivityCat::where('status', 'ACTIVE')->get();
			$ActivityNames = ActivityName::where('activity_cat_id', $Activity->activity_cat_id)->where('status', 'ACTIVE')->get();
			$Countries = Country::where('status', 'ACTIVE')->get();
			$Regions = Region::where('country_id', $Activity->country_id)->where('status', 'ACTIVE')->get();
			$Citys = City::where('region_id', $Activity->region_id)->where('status', 'ACTIVE')->get();
			$activitysubcats = ActivitySubCat::where('activity_cat_id', $Activity->activity_cat_id)->where('activity_name_id', $Activity->activity_name_id)->where('country_id', $Activity->country_id)->where('region_id', $Activity->region_id)->where('city_id', $Activity->city_id)->where('status', 'ACTIVE')->get();
            return view('vender.activities.edit',compact(['ActivityCats','Countries','activitysubcats', 'ActivityNames', 'Regions', 'Citys', 'Activity']));
            }else{
                  return redirect()->route('activities.index')->with('flash_success', 'Sorry! you are trying to access other activity data'); 

             }
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
            'activity_name_id'          => 'required',
            'activity_subcat_id'          => 'required',
            'country_id'          => 'required',
            'region_id'          => 'required',
            'city_id'          => 'required',
            'price'          => 'required',
        ]);

        try{
			$post = Activity::findOrFail($id);
			
            if( $post ) {
                $post->activity_cat_id	       	=   $request->activity_cat_id;
                $post->activity_name_id	       	=   $request->activity_name_id;
                $post->activity_subcat_id	       	=   $request->activity_subcat_id;
                $post->country_id	       	=   $request->country_id;
                $post->region_id	       	=   $request->region_id;
                $post->city_id	       	=   $request->city_id;
                $post->price   	=   $request->price;
                $post->status   	=   $request->status;
            }
            $post->save();

            return redirect()->route('activities.index')->with('flash_success', 'Activity Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Not Found');
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

            $post = Activity::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('message', 'Activity deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Not Found');
        }
    }
}

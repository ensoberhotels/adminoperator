<?php
namespace App\Http\Controllers\Resource;
use View;
use App\Country;
use App\Region;
use App\City;
use App\Vender;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use App\DayWiseDetail;
use Storage;

class DayWiseDetailResource extends Controller 
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
        $datas = DayWiseDetail::orderBy('id' , 'desc')->with('getDistination')->groupBy('code')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->paginate(10);
        return view('admin.daywisedetails.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
		// $cities = City::where('status', 'ACTIVE')->where('country_id', '96')->get();
		$cities = City::where('status', 'ACTIVE')->get();
        return view('admin.daywisedetails.create', compact('cities'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//dd($request->all());
        $this->validate($request, [
            'distination'  => 'required',
            'day'          => 'required',
            'description'  => 'required',
        ]);

        try{
            $user=session()->get('admin');
            //if($request->HasFile('image')){
                $x = 0;
                $uniques = range(10000, 99999);
                shuffle($uniques);
                $iti_code = array_slice($uniques, 0, 500);
				foreach($request->description as $description){

                    // Folder
                    if(@$request->file('image')[$x]){
                        $path = $request->file('image')[$x]->store('activity');
                        $url = '/storage/app/'.$path;
                    }                    

                    // AWS S3
                    //$path = $img->store('activity','s3');
                    //$url = Storage::disk('s3')->url($path);

					$DayWiseDetail = new DayWiseDetail();
					$DayWiseDetail->distination = $request->distination;					
					$DayWiseDetail->code = $iti_code[0];					
					$DayWiseDetail->day = $request->day;					
					$DayWiseDetail->image = $url;					
					$DayWiseDetail->description = $description;
					$DayWiseDetail->change_des = $request->change_des[$x];
					$DayWiseDetail->created_by = 'Admin';
					$DayWiseDetail->last_udated_by = 'Admin';
					$DayWiseDetail->status = 'ACTIVE';
                    $DayWiseDetail->property_id  =  $user['id'][0];
                    $DayWiseDetail->company_id   =  $user['comp_id'][0];
					$DayWiseDetail->save();
                    $x++;
				}
			//}
            return back()->with('flash_success','Day Wise Itinerary Saved Successfully');
        }catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Sub Cat Not Found');
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
			$data = DayWiseDetail::where('code',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($data) {
                $details = DayWiseDetail::where('code',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
                $cities = City::where('status', 'ACTIVE')->where('country_id', '96')->get();
                return view('admin.daywisedetails.edit',compact(['cities','data','details']));
            } else {
                return back()->with('flash_error', 'Day Wish Details Not Found');
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
        try{
            $user=session()->get('admin');
            $x=0;
			foreach($request->description as $description){
                $DayWiseDetail = DayWiseDetail::where('id', $request->id[$x])->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
                $DayWiseDetail->description = $description;	
                $DayWiseDetail->change_des = $request->change_des[$x];;	
                $DayWiseDetail->last_udated_by = 'Admin';
                $DayWiseDetail->save();
                $x++;
            } 
            return redirect()->route('daywisedetail.index')->with('flash_success', 'Day Wise Itinerary Updated Successfully'); 
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
            $user=session()->get('admin');
            $DayWiseDetail = DayWiseDetail::where('id', $id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($DayWiseDetail) {
                $post = DayWiseDetail::where('code', $id)->delete();
                //Storage::delete($post->image);
                return back()->with('message', 'Day Wise Itinerary deleted successfully');
            } else {
                return back()->with('flash_error', 'Day Wise Itinerary Not Found'); 
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Day Wise Itinerary Not Found'); 
        }
    }




    /**
     * Get the city list
     *
     */
    public function getCityList()
    {
        try{
            // $cities = City::where('status', 'ACTIVE')->where('country_id','96')->get();
            $cities = City::where('status', 'ACTIVE')->get();
            return view('admin.daywisedetails.city',compact('cities'));
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Not Found');
        }
    }

    /**
     * Update the city list
     *
     */
    public function updateCityList(Request $request, $id)
    {
        try{
            $cities = City::where('status', 'ACTIVE')->where('id', $id)->first();
            $cities->itinerary_city = $request->itinerary_city;
            $cities->save();
            return back()->with('message', 'City added successfully');
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Activity Not Found');
        }
    }


    
}

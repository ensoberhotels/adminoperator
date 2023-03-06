<?php

namespace App\Http\Controllers\Resource;
use View;
use App\HotelSeasonRate;
use App\Hotel;
use App\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Via;
use App\City;
use Storage;

class ViaResource extends Controller
{
	
	public function __construct(){
		//its just a dummy data object.
		$requests = Via::orderBy('id' , 'desc')->where('status','ACTIVE')->get();

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
        $vias = Via::orderBy('id' , 'desc')->with('startDistination')->with('toDistination')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.via.index', compact('vias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user=session()->get('admin');
        $vias = Via::where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
		//$cities = City::select('hotels.*','cities.id as city_id','cities.name as name')->join('hotels', 'cities.id', '=', 'hotels.city_id')->groupBy('cities.id')->get();
		$cities = City::select('id as city_id','name as name')->where('itinerary_city','1')->groupBy('id')->get();
        return view('admin.via.create', compact('vias','cities'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $user=session()->get('admin');
            $count = count($request->via);
			for($x = 0; $x< $count; $x++){
				$seasonrate = new Via(); 
				$seasonrate->start_destination = $request->start_destination;
				$seasonrate->to_destination = $request->to_destination;
				$seasonrate->via = $request->via[$x];
				$seasonrate->distance = $request->distance[$x];
				$seasonrate->duration = $request->duration[$x];
                $seasonrate->property_id          =   $user['id'][0];
                $seasonrate->company_id           =   $user['comp_id'][0];
				$seasonrate->save();
			}
			return back()->with('flash_success','SUCESS: Via Saved Successfully');
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Via Not Save');
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
            $via = Via::findOrFail($id);
            return view('admin.via.show', compact('via'));

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
            $via = Via::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($via) {
                $cities = City::select('id as city_id','name as name')->where('itinerary_city','1')->groupBy('id')->get();
                return view('admin.via.edit',compact('via','cities'));
            } else {
                return back()->with('flash_error', 'Via Not Found');
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Via Not Found');
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
			$via = Via::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			
            if( $via ) {
                $via->start_destination = $request->start_destination;
                $via->to_destination = $request->to_destination;
                $via->via = $request->via;
                $via->distance = $request->distance;
                $via->duration = $request->duration;
                $via->status = $request->status;
                $via->save();
                return redirect()->route('via.index')->with('flash_success', 'Via Updated Successfully'); 
            }
            else {
                return redirect()->route('via.index')->with('flash_error', 'Via Not Found');

            }
        }
        catch (ModelNotFoundException $e) {
            return redirect()->route('via.index')->with('flash_error', 'Via Not Found');
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
            $post = Via::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Via deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Via Not Found');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Via Not Found');
        }
    }
}

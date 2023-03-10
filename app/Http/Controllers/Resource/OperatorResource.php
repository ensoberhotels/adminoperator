<?php

namespace App\Http\Controllers\Resource;
use View;
use App\Operator;
use App\Country;
use App\Region;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;
use App\Hotel;

class OperatorResource extends Controller
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
    public function index(){
        $user=session()->get('admin');
        //dd($user);
        $operators = Operator::orderBy('id' , 'desc')->with('countryName')->with('hotelName')->with('stateName')->with('cityName')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->paginate(10);
        return view('admin.operator.index', compact('operators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        // $user=session()->get('admin');
        // dd($user);
		$hotels = Hotel::All();
        $Countries = Country::where('status', 'ACTIVE')->get();
        return view('admin.operator.create',compact('Countries','hotels'));
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
            'email'         => 'required|email|unique:operators',
            'password'      => 'required|min:6',
            'country_id'       => 'required',
            'region_id'         => 'required',
            'city_id'          => 'required',            
        ]);
      try{
        $user=session()->get('admin');
        //dd($user);
            // $post = $request->all();
   //          $post['password'] = bcrypt($post['password']);
			if(isset($request->assigned_hotels)){
				$assigned_hotels = implode(',', $request->assigned_hotels);
			}
        $post = new Operator;
                $post->name         =   $request->name;
                $post->email        =   $request->email;
                if(!empty($request->password)){
                $post->password     =   bcrypt($request->password);
                }
                $post->country_id      =   $request->country_id;
                $post->region_id        =   $request->region_id;
                $post->city_id         =   $request->city_id;
                $post->room_inventory         =   $request->room_inventory;
                $post->hotel         =   $request->hotel;
                $post->view_only         =   $request->view_only;
                $post->room_status         =   $request->room_status;
                $post->assigned_hotels         =  (isset($request->assigned_hotels) ? $assigned_hotels : ' ');
                $post->status       =   (isset($request->status) ? $request->status : 'ACTIVE'); 
                $post->property_id=$user['id'][0];
                $post->company_id=$user['comp_id'][0];
               // dd($post);  
                $post->save();
            
			if($post){
            return back()->with('flash_success','Operator Saved Successfully');
}

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Operator Not Found');
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
            return Operator::findOrFail($id);
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

            $operator = Operator::findOrFail($id);
            $Countries = Country::where('status', 'ACTIVE')->get();
            $Regions = Region::where('country_id', $operator->country_id)->where('status', 'ACTIVE')->get();
            $Citys = City::where('region_id', $operator->region_id)->where('status', 'ACTIVE')->get();
			$hotels = Hotel::All();
            return view('admin.operator.edit',compact('hotels','operator', 'Countries', 'Regions', 'Citys')); 
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
            'name'          => 'required',
            'email'         => 'required|email|unique:operators,email,'.$id,
            //'password'      => 'required|min:6',
            'country_id'       => 'required',
            'region_id'         => 'required',
            'city_id'          => 'required',            
        ]);
        $user=session()->get('admin');
        try{
			$post = Operator::findOrFail($id);
			if( $post ) {
				$request->assigned_hotels? $assigned_hotels = implode(',', $request->assigned_hotels):$assigned_hotels = '';
                $post->name	       	=   $request->name;
                $post->email   	    =   $request->email;
                if(!empty($request->password)){
                $post->password     =   bcrypt($request->password);
                }
                $post->country_id      =   $request->country_id;
                $post->region_id        =   $request->region_id;
                $post->city_id         =   $request->city_id;
                $post->room_inventory         =   $request->room_inventory;
                $post->hotel         =   $request->hotel;
                $post->view_only         =   $request->view_only;
                $post->room_status         =   $request->room_status;
                $post->assigned_hotels         =   $assigned_hotels;
                $post->status       =   $request->status; 
                $post->property_id=$user['id'][0];
                $post->company_id=$user['comp_id'][0];               
            }
            
            $post->save();

            return redirect()->route('operator.index')->with('flash_success', 'Operator Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Operator Not Found');
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

            $post = Operator::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Operator deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Operator Not Found');
        }
    }
}

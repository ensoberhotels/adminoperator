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
use App\AssignContacts;
use App\Contacts;
use Storage;

class AdminRequestResource extends Controller
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
        $optrequests = AdminRequest::orderBy('id' , 'desc')->with('operator')->with('contact')->paginate(10);
        //dd($optrequests);
        return view('admin.request', compact('optrequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Countries = Country::where('status', 'ACTIVE')->get();
        return view('admin.operator.create',compact('Countries'));
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

            $post = $request->all();
            $post['password'] = bcrypt($post['password']);
            $res = Operator::create( $post );
			
            return back()->with('flash_success','Operator Saved Successfully');

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
            return view('admin.operator.edit',compact('operator', 'Countries', 'Regions', 'Citys')); 
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
			$post = AdminRequest::findOrFail($id);
			if($request->type == 'approvals'){
				$asigncontact = AssignContacts::where('contact_id', $post->contact_id)->first();
				$contact = Contacts::findOrFail($post->contact_id);
				$contact->favorite_status = $asigncontact->favorite_status;
				$contact->save();
			}elseif($request->type == 'update'){
				$asigncontact = AssignContacts::where('contact_id', $post->contact_id)->first();
				$contact = Contacts::findOrFail($post->contact_id);
				$contact->name = $asigncontact->name;
				$contact->email = $asigncontact->email;
				$contact->agency_name = $asigncontact->agency_name;
				$contact->website = $asigncontact->website;
				$contact->location = $asigncontact->location;
				$contact->contact_type = $asigncontact->contact_type;
				$contact->save();
			}
			
			if( $post ) {
                $post->status       =   'CLOSE';                
            }
            
            $post->save();

            return redirect()->route('request.index')->with('flash_success', 'Request Closed Successfully'); 
            
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

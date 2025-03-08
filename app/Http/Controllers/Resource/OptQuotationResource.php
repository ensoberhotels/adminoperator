<?php

namespace App\Http\Controllers\Resource;
use View;
use App\Lead;
use App\Country;
use App\Region;
use App\City;
use App\Hotel;
use App\Operator;
use App\Quotation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class OptQuotationResource extends Controller
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
    public function index(Request $request)
    {
        $operator_id = $request->session()->get('operator.id'); 
        //$quotations = Quotation::where('assign_to', $operator_id[0])->orderBy('id' , 'desc')->get();
        //quotation_status
        if ($request->has('quotation') && $request->input('quotation')== 'new') {
           $quotations  = Quotation::where('assign_to', $operator_id[0])->whereDate('created_at', '=', date('Y-m-d'))->get();
            
        } else if ($request->has('quotation') && $request->input('quotation')== 'active') {
            $quotations  = Quotation::where('assign_to', $operator_id[0])->where('status', 'ACTIVE')->where('quotation_status', 'QUOTATION')->get();
            
        }else if ($request->has('quotation') && $request->input('quotation')== 'hot') {
            $quotations  = Quotation::where('assign_to', $operator_id[0])->where('status', 'ACTIVE')->where('quotation_status', 'QUOTATION')->where('lead_priority', 'Hot')->get();
            
        }else if ($request->has('quotation') && $request->input('quotation')== 'follow_up') {
            $quotations  = Quotation::where('assign_to', $operator_id[0])->where('status', 'ACTIVE')->where('quotation_status', 'QUOTATION')->where('created_at','<', date('Y-m-d'))->get();
            
        }else if ($request->has('quotation') && $request->input('quotation')== 'inactive') {
            $quotations = Quotation::where('assign_to', $operator_id[0])->where('status', 'INACTIVE')->get();
            
        }else {
          $quotations = Quotation::where('assign_to', $operator_id[0])->orderBy('id' , 'desc')->get();
          
        }
        
            $new = Quotation::where('assign_to', $operator_id[0])->whereDate('created_at', '=', date('Y-m-d'))->get();
            $new_count = $new->count();
            $active = Quotation::where('assign_to', $operator_id[0])->where('status', 'ACTIVE')->where('quotation_status', 'QUOTATION')->get();
            $active_count = $active->count();
            $inactive = Quotation::where('assign_to', $operator_id[0])->where('status', 'INACTIVE')->get();
            $inactive_count = $inactive->count();
            $hot = Quotation::where('assign_to', $operator_id[0])->where('status', 'ACTIVE')->where('lead_priority', 'Hot')->where('quotation_status', 'QUOTATION')->get();
            $hot_count = $hot->count();
            $follow_up = Quotation::where('assign_to', $operator_id[0])->where('status', 'ACTIVE')->where('quotation_status', 'QUOTATION')->where('created_at','<', date('Y-m-d'))->get();
            $follow_up_count = $follow_up->count();
        
        
        return view('operator.quotation.index', compact('quotations','new_count','active_count','inactive_count','hot_count','follow_up_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create(Request $request)
    {
		$Countries = Country::where('status', 'ACTIVE')->get();
		$Operators = Operator::where('status', 'ACTIVE')->get();
        $hotels = Hotel::All();
        $lead_no = substr(str_shuffle("0123456789"), 0, 5);
        $operator_id = $request->session()->get('operator.id');
        return view('operator.quotation.create', compact('Countries','hotels','lead_no','Operators','operator_id'));
    }*/

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        
        try{

            $post = $request->all();

            $res = Lead::create( $post );
			
            return back()->with('flash_success','lead Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'lead Not Found');
        }
    }
*/
    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $promocode
     * @return \Illuminate\Http\Response
     */
   /* public function show($id)
    {
        try {
            return Lead::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }*/

    /**
     * Show the form for editing the specified resource.
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function edit($id)
    {
        try {

            $quotation = Quotation::findOrFail($id);
			$Operators = Operator::where('status', 'ACTIVE')->get();
        	$Countries = Country::where('status', 'ACTIVE')->get();
			$Regions = Region::where('country_id', $quotation->country_id)->where('status', 'ACTIVE')->get();
			$Cities = City::where('region_id', $quotation->region_id)->where('status', 'ACTIVE')->get();
            $hotels = Hotel::All();
            return view('operator.quotation.edit',compact('quotation', 'Operators','Countries', 'hotels', 'Regions', 'Cities'));
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
        /*$this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|email|unique:leads,email,'.$id,
            'password'      => 'required|min:6',
            'lead_type'   => 'required',
            'country'       => 'required',
            'state'         => 'required',
            'city'          => 'required',            
        ]);**/
        try{
			$post = Quotation::findOrFail($id);
			if( $post ) {
                $post->hotel_id  =   $request->hotel_id;
                $post->mobile        =   $request->mobile;
                $post->email         =   $request->email;
                $post->name               =   $request->name;
                $post->location           =   $request->location;
                $post->customer_type     =   $request->customer_type;
                $post->lead_priority  =   $request->lead_priority;
                $post->trip_type      =   $request->trip_type;
                $post->hotel_type         =   $request->hotel_type;
                $post->city_id	       	=   $request->city_id;
                $post->region_id     =   $request->region_id;
                $post->country_id  =   $request->country_id;
                $post->start_date      =   $request->start_date;
                $post->no_nights        =   $request->no_nights;
                $post->no_room         =   $request->no_room;
                $post->sharing  =   $request->sharing;
                $post->pax      =   $request->pax;
                $post->kids        =   $request->kids;
                $post->infant         =   $request->infant;
                $post->quotation_status  =   $request->quotation_status; 
                if($request->quotation_status=='CLOSED'){
                   $post->status       =   'INACTIVE'; 
                }else{
                 $post->status       =   $request->status;   
                }
                $post->closed_reason       =   $request->closed_reason; 
                $post->selected_hotel         =   $request->selected_hotel;
                $post->price         =   $request->price;
            }
            $post->save();

            return redirect()->route('quotation.index')->with('flash_success', 'Quotation Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Quotation Not Found');
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

            $post = Quotation::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Quotation deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Quotation Not Found');
        }
    }
}

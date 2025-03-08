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
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class OptSaleResource extends Controller
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
        //s$sales = Sale::where('operator_id', $operator_id[0])->orderBy('id' , 'desc')->get();
        
        if ($request->has('sale') && $request->input('sale')== 'new') {
           $sales  = Sale::where('operator_id', $operator_id[0])->whereDate('created_at', '=', date('Y-m-d'))->get();
            
        } else if ($request->has('sale') && $request->input('sale')== 'unpaid') {
            $sales  = Sale::where('operator_id', $operator_id[0])->where('status', 'UNPAID')->get();
            
        }else if ($request->has('sale') && $request->input('sale')== 'paid') {
            $sales  = Sale::where('operator_id', $operator_id[0])->where('status', 'PAID')->get();
            
        }else if ($request->has('sale') && $request->input('sale')== 'follow_up') {
            $sales  = Sale::where('operator_id', $operator_id[0])->where('status', 'UNPAID')->where('created_at','<', date('Y-m-d'))->get();
            
        }else {
          $sales = Sale::where('operator_id', $operator_id[0])->orderBy('id' , 'desc')->get();
          
        }
        
            $new = Sale::where('operator_id', $operator_id[0])->whereDate('created_at', '=', date('Y-m-d'))->get();
            $new_count = $new->count();
            $unpaid = Sale::where('operator_id', $operator_id[0])->where('status', 'UNPAID')->get();
            $unpaid_count = $unpaid->count();
            $paid = Sale::where('operator_id', $operator_id[0])->where('status', 'PAID')->get();
            $paid_count = $paid->count();
            $follow_up  = Sale::where('operator_id', $operator_id[0])->where('status', 'UNPAID')->where('created_at','<', date('Y-m-d'))->get();
            $follow_up_count = $follow_up->count();
         
        
        return view('operator.sales.index', compact('sales','new_count','unpaid_count','paid_count','follow_up_count'));
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

            $sale = Sale::findOrFail($id);
			//$Operators = Operator::where('status', 'ACTIVE')->get();
        	//$Countries = Country::where('status', 'ACTIVE')->get();
			//$Regions = Region::where('country_id', $quotation->country_id)->where('status', 'ACTIVE')->get();
			//$Cities = City::where('region_id', $quotation->region_id)->where('status', 'ACTIVE')->get();
            //$hotels = Hotel::All();
            return view('operator.sales.edit',compact('sale'));
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
			$post = Sale::findOrFail($id);
			if( $post ) {
                $post->vender_id  =   $request->vender_id;
                $post->user_id        =   $request->user_id;
                $post->total_amount   =   $request->total_amount;
                $post->paid_amount    =   $request->paid_amount;
                $post->due_amount     =   $request->due_amount;
                $post->payment_method     =   $request->payment_method;
                $post->status  =   $request->status;
                }
            $post->save();

            return redirect()->route('sales.index')->with('flash_success', 'Sale Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Sale Not Found');
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

            $post = Sale::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Sale deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Sale Not Found');
        }
    }
}

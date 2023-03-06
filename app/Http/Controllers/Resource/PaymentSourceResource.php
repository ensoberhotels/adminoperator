<?php

namespace App\Http\Controllers\Resource;
use View;
use App\HotelSeasonRate;
use App\PaymentSource;
use App\Hotel;
use App\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;

class PaymentSourceResource extends Controller
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
    public function index(Request $request){
		$user=session()->get('admin');
        if ( ($request->has('hotel_id') && $request->input('hotel_id')!= '') ) {
            
            $query = PaymentSource::query();
            if($request->has('hotel_id') && $request->input('hotel_id')!= ''){
              $query->where('hotel_id',$request->input('hotel_id'));
            }
            $hotel_payment_source = $query->orderBy('id' , 'desc')->with('hotel')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->paginate(10);
        }else{ 
            $hotel_payment_source = PaymentSource::orderBy('id' , 'desc')->with('hotel')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->paginate(10);
        }
        $hotels = Hotel::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->orderby('hotel_name', 'ASC')->get();
        return view('admin.paymentsource.index', compact('hotel_payment_source','hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){   
		$user=session()->get('admin');
        $hotels = Hotel::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->orderby('hotel_name', 'ASC')->get();
        return view('admin.paymentsource.create', compact('hotels'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
		
        try{
            $user=session()->get('admin'); 
            if($request->Has('hotel_id')){
				$count = count($request->source);
				for($x = 0; $x< $count; $x++){
					$paymentsource = new PaymentSource(); 
					$paymentsource->hotel_id = $request->hotel_id;
					$paymentsource->source = $request->source[$x];
					$paymentsource->status = $request->status[$x];
					$paymentsource->owner = $request->owner[$x];
					$paymentsource->code = $request->code[$x];
                    $paymentsource->property_id=$user['id'][0];
                    $paymentsource->company_id=$user['comp_id'][0];
					$paymentsource->save();
				}
				
				return back()->with('flash_success','SUCESS: Hotel Payment Source Saved Successfully');
			}

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Payment Source Not Found');
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
            $hotel_season_rates = HotelSeasonRate::findOrFail($id);
            return view('admin.paymentsource.show', compact('hotel_season_rate'));

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
            $paymentsource = PaymentSource::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            // dd($paymentsource);
            if ($paymentsource) {
                $hotels = Hotel::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->orderby('hotel_name', 'ASC')->get();
                return view('admin.paymentsource.edit',compact('paymentsource', 'hotels'));
            }
            else {
                return back()->with('flash_error', 'Hotel Payment Source Record Not Found');
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
    public function update(Request $request, $id){
        try{
            $user=session()->get('admin');
			$post = PaymentSource::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->hotel_id = $request->hotel_id;
                $post->source = $request->source;
                $post->status = $request->status;
                $post->owner = $request->owner;
                $post->save();
                return redirect()->route('paymentsource.index')->with('flash_success', 'Hotel Payment Source Updated Successfully'); 
            }
            else {
                return redirect()->route('paymentsource.index')->with('flash_error', 'Hotel Payment Source Not Found');
            }
        }
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Payment Source Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try { 
            $user=session()->get('admin');
			$post = PaymentSource::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Hotel Payment Source Deleted Successfully');
            }
            else {
                return back()->with('flash_error', 'Hotel Payment Source Not Found');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Hotel Payment Source Not Found');
        }
    }
}

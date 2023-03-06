<?php

namespace App\Http\Controllers\Resource;
use View;
use App\Vender;
use App\Country;
use App\Region;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;
use PDF;

class VenderVenderResource extends Controller
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
        $venders = Vender::where('id',$vender_id[0])->orderBy('id' , 'desc')->with('countryName')->with('stateName')->with('cityName')->get();
		
		// Send data to the view using loadView function of PDF facade
		$pdf = PDF::loadView('vender.venders.index', compact('venders'));
		// If you want to store the generated pdf to the server then you can use the store function
		$pdf->save(storage_path().'_filename.pdf');
		// Finally, you can download the file using download function
		//return $pdf->download('customers.pdf');
        return view('vender.venders.index', compact('venders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function create()
    {
		$Countries = Country::where('status', 'ACTIVE')->get();
        return view('vender.venders.create', compact('Countries'));
    }*/

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|email|unique:venders',
            'password'      => 'required|min:6',
            'vender_type'   => 'required',
            'country_id'       => 'required',
            'region_id'         => 'required',
            'city_id'          => 'required',            
        ]);
        try{

            $post = $request->all();
            $post['password'] = bcrypt($post['password']);
            $res = Vender::create( $post );
			
            return back()->with('flash_success','Vender Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Vender Not Found');
        }
    }
    */

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $promocode
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Vender::findOrFail($id);
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
             $vender_id = session()->get('vender.id');   
             if($id == $vender_id[0] ){
            $vender = Vender::findOrFail($id);			
			$Countries = Country::where('status', 'ACTIVE')->get();
			$Regions = Region::where('country_id', $vender->country_id)->where('status', 'ACTIVE')->get();
			$Citys = City::where('region_id', $vender->region_id)->where('status', 'ACTIVE')->get();
            return view('vender.venders.edit',compact('vender', 'Countries', 'Regions', 'Citys')); 
             }else{
                return redirect()->route('venders.index')->with('flash_success', 'Sorry! you are trying to access other data'); 
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
            'name'          => 'required',
            'email'         => 'required|email|unique:venders,email,'.$id,
            //'password'      => 'required|min:6',
            'vender_type'   => 'required',
            'country_id'       => 'required',
            'region_id'         => 'required',
            'city_id'          => 'required',            
        ]);

        try{
			$post = Vender::findOrFail($id);
			if( $post ) {
                $post->name	       	=   $request->name;
                $post->email   	    =   $request->email;
                if(!empty($request->password)){
                $post->password     =   bcrypt($request->password);
                }
                $post->vender_type  =   $request->vender_type;
                $post->country_id      =   $request->country_id;
                $post->region_id        =   $request->region_id;
                $post->city_id         =   $request->city_id;
                $post->status       =   $request->status;                
            }
            
            $post->save();

            return redirect()->route('venders.index')->with('flash_success', 'Vender Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Vender Not Found');
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

            $post = Vender::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Vender deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Vender Not Found');
        }
    }
}

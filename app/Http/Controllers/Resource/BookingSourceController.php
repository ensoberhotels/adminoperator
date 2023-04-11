<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\BookingSource;
use App\AdminRequest;
use Storage;
use View;

class BookingSourceController extends Controller
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
        $data = BookingSource::orderBy('id' , 'desc')->where('company_id',$user['id'][0])->get();
        return view('admin.booking.source.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // dd(session()->get('admin'));
        return view('admin.booking.source.create');
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
            'title'          => 'required',
        ]);

        try{
            $user=session()->get('admin');
            $data = new BookingSource();
            $data->title = $request->title;
            $data->company_id=$user['id'][0];
            
            $data->save();
            return back()->with('flash_success','Booking Source Saved Successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Booking Source Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user=session()->get('admin');
            $data = BookingSource::where('id',$id)->where('company_id',$user['id'][0])->first();
            if ($data) {
                return view('admin.booking.source.edit',compact('data'));
            } else {
                return back()->with('flash_error', 'Booking Source Not Found');
            }
            
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Booking Source Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'          => 'required',
        ]);

        try{
            $user =session()->get('admin');
			$post = BookingSource::where('id',$id)->where('company_id',$user['id'][0])->first();
			
            if( $post ) {
                $post->title = $request->title;
                $post->save();
                return redirect()->route('booking_source.index')->with('flash_success', 'Booking Source Updated Successfully'); 
            }
            else {
                return redirect()->route('booking_source.index')->with('flash_error', 'Booking Source Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return redirect()->route('booking_source.index')->with('flash_error', 'Booking Source Not Found');
        }
    }

    /**
     * Remove the specified resource source storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try { 
            $user=session()->get('admin');
            $post = BookingSource::where('id',$id)->where('company_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
				return back()->with('flash_success', 'Booking Source Deleted Successfull!');
            }
            else {
                return back()->with('flash_error', 'Booking Source Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Booking Source Not Found');
        }
    }
}
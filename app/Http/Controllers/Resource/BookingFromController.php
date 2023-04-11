<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\BookingFrom;
use App\AdminRequest;
use Storage;
use View;


class BookingFromController extends Controller
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
        $data = BookingFrom::orderBy('id' , 'desc')->where('company_id',$user['id'][0])->get();
        return view('admin.booking.from.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // dd(session()->get('admin'));
        return view('admin.booking.from.create');
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
            $data = new BookingFrom();
            $data->title = $request->title;
            $data->company_id=$user['id'][0];
            
            $data->save();
            return back()->with('flash_success','Booking From Saved Successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Booking From Not Found');
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
            $data = BookingFrom::where('id',$id)->where('company_id',$user['id'][0])->first();
            if ($data) {
                return view('admin.booking.from.edit',compact('data'));
            } else {
                return back()->with('flash_error', 'Booking From Not Found');
            }
            
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Booking From Not Found');
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
			$post = BookingFrom::where('id',$id)->where('company_id',$user['id'][0])->first();
			
            if( $post ) {
                $post->title = $request->title;
                $post->save();
                return redirect()->route('booking_from.index')->with('flash_success', 'Booking From Updated Successfully'); 
            }
            else {
                return redirect()->route('booking_from.index')->with('flash_error', 'Booking From Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return redirect()->route('booking_from.index')->with('flash_error', 'Booking From Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try { 
            $user=session()->get('admin');
            $post = BookingFrom::where('id',$id)->where('company_id',$user['id'][0])->first();
            if( $post ) {
                $post->delete();
				return back()->with('flash_success', 'Booking From Deleted Successfull!');
            }
            else {
                return back()->with('flash_error', 'Booking From Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Booking From Not Found');
        }
    }
}

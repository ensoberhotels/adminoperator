<?php

namespace App\Http\Controllers\Resource;
use View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use App\NotificationMessage;
use Storage;

class NotificationMessageResource extends Controller
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
        $messages = NotificationMessage::orderBy('id' , 'desc')->get();
        return view('admin.notification_message.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        return view('admin.notification_message.create');
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
            'message'          => 'required',
            'type'          => 'required',
            'status'          => 'required',
        ]);

        try{

            $post = $request->all();

            $res = NotificationMessage::create( $post );
			
            return back()->with('flash_success','Notification Message Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Data Not Found');
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
            return NotificationMessage::findOrFail($id);
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

            $message = NotificationMessage::findOrFail($id);            
            return view('admin.notification_message.edit',compact('message'));
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
            'title'          => 'required',
            'message'          => 'required',
            'type'          => 'required',
            'status'          => 'required',
        ]);

        try{
			$post = NotificationMessage::findOrFail($id);
			
            if( $post ) {
                $post->title	    =   $request->title;
                $post->message   	=   $request->message;
                $post->type    		=   $request->type;
                $post->status     	=   $request->status;
            }
            
            $post->save();

            return redirect()->route('notificationmessage.index')->with('flash_success', 'Notification Message Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Notification Message Not Found');
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

            $post = NotificationMessage::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('message', 'Notification Message deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Notification Message Not Found');
        }
    }
}

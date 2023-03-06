<?php

namespace App\Http\Controllers\Resource;
use View;
use App\Lead;
use App\Country;
use App\Region;
use App\City;
use App\Hotel;
use App\Operator;
use App\Contacts;
use App\AssignContacts;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use App\SMTPEmail;
use Storage;

class SmtpemailResource extends Controller
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
        $user=session()->get('admin');
        $SMTPEmails = SMTPEmail::orderBy('id', 'DESC')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        
        return view('admin.smtpemail.index', compact('SMTPEmails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.smtpemail.create');
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
            'email'         => 'required|unique:smtp_emails',
            'password'         => 'required',
            'host'         => 'required',
            'port'         => 'required',
                        
        ]);
        
        try{
            $user=session()->get('admin');
            $post = $request->all();
            $post['property_id']=$user['id'][0];
            $post['company_id']=$user['comp_id'][0];
            $res = SMTPEmail::create( $post );
            
			
            return back()->with('flash_success','SMTP Email Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'SMTP Email Not Found');
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
            return SMTPEmail::findOrFail($id);
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

            $SMTPEmail = SMTPEmail::findOrFail($id);
			return view('admin.smtpemail.edit',compact('SMTPEmail'));
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
            'email'         => 'required',
            'password'         => 'required',
            'host'         => 'required',
            'port'         => 'required',
                        
        ]);
        try{
			$post = SMTPEmail::findOrFail($id);
			if( $post ) {
                $post->email         =   $request->email;
                $post->password      =   $request->password;
                $post->host     	 =   $request->host;
                $post->port        	 =   $request->port; 
                $post->per_day_limit        	 =   $request->per_day_limit; 
                $post->status        =   $request->status; 
            }
            
            $post->save();

            return redirect()->route('smtpemail.index')->with('flash_success', 'SMTP Email Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'SMTP Email Not Found');
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
            $post = SMTPEmail::findOrFail($id);
            if( $post ) {
                $post->delete();
				return redirect()->route('smtpemail.index')->with('flash_success', 'SMTP Email deleted successfully'); 
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'SMTP Email Not Found');
        }
    }
}

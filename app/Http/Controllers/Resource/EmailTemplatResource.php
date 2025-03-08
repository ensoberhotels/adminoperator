<?php

namespace App\Http\Controllers\Resource;
use View;
use App\Car;
use App\CarSegment;
use App\CarModel;
use App\CarSeats;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use Storage;
use App\BulkEmailSendReport;
use App\BulkEmailSend;
use App\EmailTemplat;
use App\EmailCampaign;

class EmailTemplatResource extends Controller
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
        $datas = EmailTemplat::orderBy('id' , 'desc')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->paginate(10);
        return view('admin.email_template.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user=session()->get('admin');
        $car_segments = EmailTemplat::where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.email_template.create', compact('car_segments'));
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
            'template'         => 'required|mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);
        try{
            $user=session()->get('admin');
            // $post = $request->all();
            $data = new EmailTemplat();
            $data->title       = $request->title;
            $data->property_id          =   $user['id'][0];
            $data->company_id           =   $user['comp_id'][0];
            if($request->hasFile('template')) {
                $data->template = $request->template->store('email_template');
            }

			$data->save();
            return back()->with('flash_success','Email Template Saved Successfully');
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Email Template Not Found');
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
            return EmailTemplat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
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
            $email_template = EmailTemplat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if ($email_template) {
                return view('admin.email_template.edit',compact('email_template'));
            } else {
                return back()->with('flash_error', 'Email Template Not Found');
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Email Template Not Found');
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
            'template'         => 'required|mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);

        try{
            $user=session()->get('admin');
			$post = EmailTemplat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
			
            if( $post ) {
                $post->title	       	=   $request->title;
                $post->status   	=   $request->status;
                if($request->hasFile('template') ) {
                    Storage::delete($post->template);
                    $post->template = $request->template->store('email_template');
                }

                $post->save();
                return redirect()->route('emailtemplate.index')->with('flash_success', 'Email Template Updated Successfully'); 
            }
            else {
                return redirect('admin/emailtemplate')->with('flash_error', 'Email Template Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back('admin/emailtemplate')->with('flash_error', 'Email Template Not Found');
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
            $user=session()->get('admin');
            $post = EmailTemplat::where('id',$id)->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->first();
            if( $post ) {
                Storage::delete($post->template);
                $post->delete();
                return back()->with('flash_success', 'Email Template deleted successfully');
            }
            else {
                return back()->with('flash_error', 'Email Template Not Found');
            }
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Email Template Not Found');
        }
    }
}

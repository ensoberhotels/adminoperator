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
use App\FollowupContacts;
use App\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Storage;
use DB;

class OptContactFollowupResource extends Controller
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
    public function mobileView(Request $request)
    {
          $operator_id = session()->get('operator');  
          $operator_name = str_replace(' ','_',$request->session()->get('operator.name')); 
          if(isset($request->search_mobile)){
              $AssignContacts = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])
			  //->where('status','ACTIVE')
			  //->where('follow_up', 'NOTDONE')
			  ->where('mobile', $request->search_mobile)
			  ->orderBy('id' , 'desc')->get();
          }else{
              $AssignContacts = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status','ACTIVE')->where('follow_up', 'NOTDONE')->orderBy('id' , 'desc')->get();
          }
          
		  
		  // New Follow Up Count
		  $newcount = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status','ACTIVE')->where('follow_up', 'NOTDONE')->count();
		  
		  // Past Follow Up Count
		  $pastcount = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '<', date('Y-m-d'))->count();
		  
		  // Today Follow Up Count
		  $todaycount = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '=', date('Y-m-d'))->count();
		  
		  // Future Follow Up Count
		  $futurecount = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '>', date('Y-m-d'))->count();
          
        return view('operator.contactfollowup.mobile', compact('AssignContacts','operator_id', 'newcount', 'pastcount', 'todaycount', 'futurecount','operator_name'));
    }
	
	
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $operator_id = session()->get('operator'); 
          $operator_name = str_replace(' ','_',$operator_id['name'][0]); 
          if(isset($request->search_mobile)){
              $AssignContacts = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])
			  //->where('status','ACTIVE')
			  //->where('follow_up', 'NOTDONE')
			  ->where('mobile', $request->search_mobile)
			  ->orderBy('id' , 'desc')->get();
          }else{
              $AssignContacts = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status','ACTIVE')->where('follow_up', 'NOTDONE')->orderBy('id' , 'desc')->get();
          }
          
		  
		  // New Follow Up Count
		  $newcount = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status','ACTIVE')->where('follow_up', 'NOTDONE')->count();
		  
		  // Past Follow Up Count
		  $pastcount = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '<', date('Y-m-d'))->count();
		  
		  // Today Follow Up Count
		  $todaycount = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '=', date('Y-m-d'))->count();
		  
		  // Future Follow Up Count
		  $futurecount = AssignContacts::where('company_id',$operator_id['company_id'][0])->where('property_id',$operator_id['property_id'][0])->where('user_id',$operator_id['id'][0])->where('status','ACTIVE')->where('follow_up', 'DONE')->whereDate('follow_up_date', '>', date('Y-m-d'))->count();
          $operator_id= $operator_id['id'][0];
        return view('operator.contactfollowup.index', compact('AssignContacts','operator_id', 'newcount', 'pastcount', 'todaycount', 'futurecount','operator_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('operator.contactfollowup.create');
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          try{
          	$user = session()->get('operator'); 
            $post = $request->all();
			
			// With update request
			if($request->has('with_update')){
				$contact = AssignContacts::where('id', $post['assign_contact_id'])->first();
				$contact->name = $post['name'];
				$contact->email = $post['email'];
				$contact->agency_name = $post['agency_name'];
				$contact->website = $post['website'];
				$contact->location = $post['location'];
				$contact->contact_type = $post['contact_type'];
				$contact->company_id = $user['company_id'][0];
				$contact->property_id =$user['property_id'][0];
				$contact->user_id =$user['id'][0];
				$contact->save();
				
				$AdminRequest = new AdminRequest();
				$AdminRequest->comment = $post['comment'];
				$AdminRequest->contact_id = $contact->contact_id;
				$AdminRequest->operator_id = $contact->operator_id;
				$AdminRequest->create_date_time = date('Y-m-d H:i:m'); 
				$AdminRequest->type = 'update';
				$AdminRequest->company_id = $user['company_id'][0];
				$AdminRequest->property_id =$user['property_id'][0];
				$AdminRequest->user_id =$user['id'][0];
				$AdminRequest->save();
			}
			if($post['status'] == 'REQUEST'){
				$contact = AssignContacts::where('id', $post['assign_contact_id'])->first();
				$AdminRequest = new AdminRequest();
				$AdminRequest->comment = $post['comment'];
				$AdminRequest->contact_id = $contact->contact_id;
				$AdminRequest->operator_id = $contact->operator_id;
				$AdminRequest->create_date_time = date('Y-m-d H:i:m');
				$AdminRequest->type = 'request';
				$AdminRequest->company_id = $user['company_id'][0];
				$AdminRequest->property_id =$user['property_id'][0];
				$AdminRequest->user_id =$user['id'][0];
				$AdminRequest->save();
				return back()->with('flash_success','Request Successfully Sent');
			}
			if($post['status'] == 'UPDATE'){ 
				$contact = AssignContacts::where('id', $post['assign_contact_id'])->first();
				$contact->name = $post['name'];
				$contact->email = $post['email'];
				$contact->agency_name = $post['agency_name'];
				$contact->website = $post['website'];
				$contact->location = $post['location'];
				$contact->contact_type = $post['contact_type'];
				$contact->company_id = $user['company_id'][0];
				$contact->property_id =$user['property_id'][0];
				$contact->user_id =$user['id'][0];
				$contact->save();
				
				$AdminRequest = new AdminRequest();
				$AdminRequest->comment = $post['comment'];
				$AdminRequest->contact_id = $contact->contact_id;
				$AdminRequest->operator_id = $contact->operator_id;
				$AdminRequest->create_date_time = date('Y-m-d H:i:m'); 
				$AdminRequest->type = 'update';
				$AdminRequest->company_id = $user['company_id'][0];
				$AdminRequest->property_id =$user['property_id'][0];
				$AdminRequest->user_id =$user['id'][0];
				$AdminRequest->save();
				return back()->with('flash_success','Update Request Successfully Sent');
			}
			
            $contact = AssignContacts::where('id', $post['assign_contact_id'])->first();
			$contact->follow_up = 'DONE';
			$contact->follow_up_date = $post['followup_date'];
			$contact->status = $post['status'];
			$contact->favorite_status = $post['favorite_status'];
			$contact->company_id = $user['company_id'][0];
			$contact->property_id =$user['property_id'][0];
			$contact->user_id =$user['id'][0];
			$contact->save();
			$operator_id = session()->get('operator.id');
			
			if($post['status'] == 'INACTIVE' || $post['favorite_status'] == 'favorite' || $post['favorite_status'] == 'unfavorite'){
				$AdminRequest = new AdminRequest();
				if($post['favorite_status'] == 'favorite'){
					$AdminRequest->comment = 'Request for updating Favourite: '.$post['comment'];
				}elseif($post['favorite_status'] == 'unfavorite'){
					$AdminRequest->comment = 'Request for updating Unfavourite: '.$post['comment'];
				}else{
					$AdminRequest->comment = $post['comment'];
				}
				$AdminRequest->contact_id = $contact->contact_id;
				$AdminRequest->operator_id = $contact->operator_id;
				$AdminRequest->create_date_time = date('Y-m-d H:i:m'); 
				if($post['favorite_status'] == 'favorite' || $post['favorite_status'] == 'unfavorite' && $post['status'] != 'UPDATE'){
					$contact = AssignContacts::where('id', $post['assign_contact_id'])->first();
					$contact->favorite_status = $post['favorite_status'];
					$contact->save();
					$AdminRequest->type = 'approvals';
				}else{
					$AdminRequest->type = 'request'; 
				}
				$AdminRequest->save();
			}
			
			$res = FollowupContacts::create( $post );
			
			
            return back()->with('flash_success','Contact Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Contact Not Found');
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
            return FollowupContacts::findOrFail($id);
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

            $FollowupContact = FollowupContacts::findOrFail($id);
			return view('operator.contactfollowup.edit',compact('FollowupContact'));
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
			$post = FollowupContacts::findOrFail($id);
			if( $post ) {
                $post->mobile        =   $request->mobile;
                $post->email         =   $request->email;
                $post->name          =   $request->name;
                $post->location      =   $request->location;
                $post->status        =   $request->status; 
                }
            
            $post->save();

            return redirect()->route('contactfollowup.index')->with('flash_success', 'Contact Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Contact Not Found');
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

            $post = Contacts::findOrFail($id);
            if( $post ) {
                $post->delete();
                return back()->with('flash_success', 'Contact deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Contact Not Found');
        }
    }
}

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
use Storage;
use DataTables;
use DB;
use Log;

class ContactsResource extends Controller
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
        if ( ($request->has('location') && $request->input('location')!= '') || ($request->has('contact_type') && $request->input('contact_type')!= '') || ($request->has('source') && $request->input('source')!= '') || ($request->has('fdate') && $request->input('fdate')!= '') || ($request->has('tdate') && $request->input('tdate')!= '')) {
            
			$query = Contacts::query();
			if($request->has('location') && $request->input('location')!= ''){
			  $query->where('location','like', '%'. $request->input('location').'%');
			}
			if( $request->has('contact_type') && $request->input('contact_type')!= ''){
			  $query->where('contact_type', $request->input('contact_type') );
			}
			if( $request->has('source') && $request->input('source')!= ''){
			  $query->where('source', $request->input('source') );
			}
			if($request->has('fdate') && $request->input('fdate')!= '' && $request->has('tdate') && $request->input('tdate')!= ''){
				$query->whereBetween('created_at', [$request->input('fdate'), $request->input('tdate')] );
			}
            $Contacts = $query->with('asignContact')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->orderBy('id' , 'desc')->get();
        }else{ 
            $Contacts = Contacts::with('asignContact')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->orderBy('id' , 'desc')->get();
        }
        $contact_types = Contacts::distinct()->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get(['contact_type']);
        $sources  = Contacts::distinct()->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get(['source']);
        $Operators = Operator::where('status', 'ACTIVE')->where('company_id',$user['comp_id'][0])->where('property_id',$user['id'][0])->get();
        return view('admin.contact.index', compact('Contacts','contact_types','sources','Operators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.contact.create');
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
            'mobile'         => 'required|unique:contacts',
                        
        ]);
        
        try{
            $user=session()->get('admin');
            $post = $request->all();
            $post['property_id']=$user['id'][0];
            $post['company_id']=$user['comp_id'][0];
            $res = Contacts::create( $post );
            
			
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
            return Contacts::findOrFail($id);
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

            $Contact = Contacts::findOrFail($id);
			return view('admin.contact.edit',compact('Contact'));
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
            'email'         => 'required|unique:contacts,email,'.$id,
            'mobile'         => 'required|unique:contacts,mobile,'.$id,
                        
        ]);
        try{
			$post = Contacts::findOrFail($id);
			if( $post ) {
                $post->mobile        =   $request->mobile;
                $post->email         =   $request->email;
                $post->name          =   $request->name;
                $post->location      =   $request->location;
                $post->status        =   $request->status; 
                }
            
            $post->save();

            return redirect()->route('contact.index')->with('flash_success', 'Contact Updated Successfully'); 
            
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
				echo  'Contact deleted successfully'; 
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Contact Not Found');
        }
    }
	
	/**
     * Get all assigned contact.
     *
     * @return Array
     */
    public function assignedContact(Request $request){
		
		if ( ($request->has('location') && $request->input('location')!= '') || ($request->has('contact_type') && $request->input('contact_type')!= '') || ($request->has('source') && $request->input('source')!= '') ) {
            
        $query = Contacts::query();
        if($request->has('location') && $request->input('location')!= ''){
          $query->where('location','like', '%'. $request->input('location').'%');
        }
        if( $request->has('contact_type') && $request->input('contact_type')!= ''){
          $query->where('contact_type', $request->input('contact_type') );
        }
        if( $request->has('source') && $request->input('source')!= ''){
          $query->where('source', $request->input('source') );
        }
            $Contacts = $query->with('asignContact')->where('assigned_status', 'ASSIGNED')->orderBy('id' , 'desc')->paginate(10);
        }else{ 
            $Contacts = Contacts::with('asignContact')->where('assigned_status', 'ASSIGNED')->orderBy('id' , 'desc')->paginate(10);
        }
        $contact_types = Contacts::distinct()->where('assigned_status', 'ASSIGNED')->get(['contact_type']);
        $sources  = Contacts::distinct()->where('assigned_status', 'ASSIGNED')->get(['source']);
        $Operators = Operator::where('status', 'ACTIVE')->get();
		$total_cont = Contacts::where('assigned_status', 'ASSIGNED')->count();
		$total_cont_un = Contacts::where('assigned_status', 'UNASSIGNED')->count();
		if($request->ajax()){
			if ( ($request->has('location') && $request->input('location')!= '') || ($request->has('contact_type') && $request->input('contact_type')!= '') || ($request->has('source') && $request->input('source')!= '') ) {
			$query = Contacts::query();
			if($request->has('location') && $request->input('location')!= ''){
			  $query->where('location','like', '%'. $request->input('location').'%');
			}
			if( $request->has('contact_type') && $request->input('contact_type')!= ''){
			  $query->where('contact_type', $request->input('contact_type') );
			}
			if( $request->has('source') && $request->input('source')!= ''){
			  $query->where('source', $request->input('source') );
			}
				$Contacts = $query->with('asignContact')->where('assigned_status', 'ASSIGNED')->orderBy('id' , 'desc')->get();
			}else{ 
				$Contacts = Contacts::with('asignContact')->where('assigned_status', 'ASSIGNED')->orderBy('id' , 'desc')->get();
			}
			
            return DataTables::of($Contacts)->addIndexColumn()->addColumn('operator', function($Contacts){
				$btn = ucfirst($Contacts->asignContact->asignContactOperator->name).'<br>'.ucfirst($Contacts->asignContact->asignContactOperator->email);
                
				return $btn;
			})
			->rawColumns(['operator'])->make(true);
        }
        return view('admin.contact.assigncontact', compact('Contacts','contact_types','sources','Operators','total_cont','total_cont_un'));
		
    }
	
	/**
     * Get all unassigned contact.
     *
     * @return Array
     */
    public function unAssignedContact(Request $request)
    {
        if ( ($request->has('location') && $request->input('location')!= '') || ($request->has('contact_type') && $request->input('contact_type')!= '') || ($request->has('source') && $request->input('source')!= '') ) {
            
        $query = Contacts::query();
        if($request->has('location') && $request->input('location')!= ''){
          $query->where('location','like', '%'. $request->input('location').'%');
        }
        if( $request->has('contact_type') && $request->input('contact_type')!= ''){
          $query->where('contact_type', $request->input('contact_type') );
        }
        if( $request->has('source') && $request->input('source')!= ''){
          $query->where('source', $request->input('source') );
        }
            $Contacts = $query->with('asignContact')->where('assigned_status', 'UNASSIGNED')->orderBy('id' , 'desc')->paginate(10);
        }else{ 
            $Contacts = Contacts::with('asignContact')->where('assigned_status', 'UNASSIGNED')->orderBy('id' , 'desc')->paginate(10);
        }
        $contact_types = Contacts::distinct()->where('assigned_status', 'UNASSIGNED')->get(['contact_type']);
        $sources  = Contacts::distinct()->where('assigned_status', 'UNASSIGNED')->get(['source']);
        $Operators = Operator::where('status', 'ACTIVE')->get();
		$total_cont = Contacts::where('assigned_status', 'ASSIGNED')->count();
		$total_cont_un = Contacts::where('assigned_status', 'UNASSIGNED')->count();
		if($request->ajax()){
			if ( ($request->has('location') && $request->input('location')!= '') || ($request->has('contact_type') && $request->input('contact_type')!= '') || ($request->has('source') && $request->input('source')!= '') ) {
			$query = Contacts::query();
			if($request->has('location') && $request->input('location')!= ''){
			  $query->where('location','like', '%'. $request->input('location').'%');
			}
			if( $request->has('contact_type') && $request->input('contact_type')!= ''){
			  $query->where('contact_type', $request->input('contact_type') );
			}
			if( $request->has('source') && $request->input('source')!= ''){
			  $query->where('source', $request->input('source') );
			}
				$Contacts = $query->with('asignContact')->where('assigned_status', 'UNASSIGNED')->orderBy('id' , 'desc')->get();
			}else{ 
				$Contacts = Contacts::with('asignContact')->where('assigned_status', 'UNASSIGNED')->orderBy('id' , 'desc')->get();
			}
			
            return DataTables::of($Contacts)->make(true);
        }
        return view('admin.contact.unassigncontact', compact('Contacts','contact_types','sources','Operators','total_cont','total_cont_un'));
    }
	
	
	/**
     * Get assigned contact operator details.
     *
     * @return Array
     */
    public function getAssignedOperator(Request $request){

		$assign_contact = AssignContacts::where('contact_id', $request->contact_id)->first();
		$operator = Operator::where('id', $assign_contact->operator_id)->first();
		dd($operator);
		
        return view('admin.contact.assigncontact', compact('Contacts','contact_types','sources','Operators','total_cont','total_cont_un'));
		
    }
	
	/**
     * Remove the duplicates contact.
     *
     * @return Array
     */
    public function removeDuplicatesContacts(){
		dd('Stop Now!');
		// Get all duplicated values.
		$duplicates = DB::table('contacts') 
			->select('id', 'mobile') // name is the column name with duplicated values
			->whereIn('mobile', function ($q){
				$q->select('mobile')
				->from('contacts')
				->groupBy('mobile')
				->havingRaw('COUNT(*) > 1');
			})
			->orderBy('mobile', 'desc')
			->get();
		
		$value = "";
		// loop throuht results and keep first duplicated value
		foreach ($duplicates as $duplicate) {
			if($duplicate->mobile === $value){
				DB::table('contacts')->where('id', $duplicate->id)->delete();
				$msg = "$duplicate->mobile with id $duplicate->id deleted! \n";
			}else{
				$msg = "$duplicate->mobile with id $duplicate->id keeped \n";
				$value = $duplicate->mobile;
			}
			echo $msg.'<br>';
			Log::info($msg.'-'.date('d-m-Y, h:i:s A'));
		}
    }
	
	
}

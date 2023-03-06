<?php

namespace App\Http\Controllers\Resource;
use View;
use App\Amenity;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\AdminRequest;
use App\Voucher;
use PHPMailer\PHPMailer;
use PDF;
use Storage;

class VoucherResource extends Controller
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
        $vouchers = Voucher::orderBy('id' , 'desc')->paginate(10);
        return view('admin.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.voucher.create');
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
            'hotel_logo'         => 'required|mimes:jpeg,jpg',
        ]);

        try{

            $post = $request->all();
			$digits = 3;
			$randam_num = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
			$post['reservation_no'] = strtoupper(substr($post['hotel_name'],0,3)).date('Ymd').$randam_num;
            if($request->hasFile('hotel_logo')) {
                $post['hotel_logo'] = $request->hotel_logo->store('voucher');
            }
			
            $res = Voucher::create( $post );
			
            return back()->with('flash_success','Voucher Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Voucher Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $promocode
     * @return \Illuminate\Http\Response
     */
    public function pdfview($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.voucher.view', compact('voucher'));
    }
	
	public function downloadpdf($id){
		$voucher = Voucher::findOrFail($id);
		//return view('admin.voucher.dwnvoucher', compact('voucher'));
		$pdf = PDF::loadView('admin.voucher.dwnvoucher', compact('voucher'));
		return $pdf->download('pdfview.pdf');
    }
	
	public function savePdfVoucher($id){
		$voucher = Voucher::findOrFail($id);
		$pdf = PDF::loadView('admin.voucher.dwnvoucher', compact('voucher'));
		$path = storage_path('app/voucher/pdf');
		$fileName = $voucher->reservation_no . '.' . 'pdf' ;
		$pdf->save($path . '/' . $fileName);
    }
    
	public function sendVoucher(Request $request)
    {
		$id = $request->voucher_id;
		$email = $request->email;
		$voucher = Voucher::findOrFail($id);
		$this->savePdfVoucher($id);
		$pdf_name = $voucher->reservation_no. '.' . 'pdf';
		$text             = 'Dear Sir, <br> Please find voucher in attachment.';
        $mail             = new PHPMailer\PHPMailer(); // create a n
		
		try {
			$mail->SMTPDebug  = 0; // debugging: 1 = errors and messages, 2 = messages only
			$mail->IsSMTP();
			$mail->IsMail();
			$mail->SMTPAuth   = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host       = "smtp.gmail.com";
			$mail->Port       = 25; // or 587
			$mail->IsHTML(true);
			$mail->Username = "Sales@ensoberhotels.com"; 
			$mail->Password = "rajensober1124";
			$mail->SetFrom("Sales@ensoberhotels.com", 'Ensober');
			$mail->Subject = "Ensober Hotel Voucher";
			$mail->Body    = $text;
			$mail->AddAddress($email,'');
			$mail->addAttachment('storage/app/voucher/pdf/'.$pdf_name);
			if(!$mail->Send()) {
				return $error = 'Mail error: '.$mail->ErrorInfo; 
				//return false;
			} else {
				return back()->with('flash_success','Voucher Send Successfully!');
			}
		} catch (phpmailerException  $e) {
			echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (\Exception $e) { //The leading slash means the Global PHP Exception class will be caught
			echo $e->getMessage(); //Boring error messages from anything else!
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

            $voucher = Voucher::findOrFail($id);
            return view('admin.voucher.edit',compact('voucher'));
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
			$post = Voucher::findOrFail($id);
			
            if( $post ) {
                $post->hotel_name	       	=   $request->hotel_name;
                $post->agent_name   	=   $request->agent_name;
                $post->confirmed_by   	=   $request->confirmed_by;
                $post->client_name   	=   $request->client_name;
                $post->check_in   	=   $request->check_in;
                $post->check_out   	=   $request->check_out;
                $post->no_of_nights   	=   $request->no_of_nights;
                $post->no_of_pax   	=   $request->no_of_pax;
                $post->kids   	=   $request->kids;
                $post->no_of_room   	=   $request->no_of_room;
                $post->room_type   	=   $request->room_type;
                $post->package   	=   $request->package;
                $post->cost   	=   $request->cost;
                $post->advance_received   	=   $request->advance_received;
                $post->hotel_address   	=   $request->hotel_address;

                if($request->hasFile('hotel_logo') ) {
                    Storage::delete($post->hotel_logo);
                    $post->hotel_logo = $request->hotel_logo->store('voucher');
                }
            }
            
            $post->save();

            return redirect()->route('voucher.index')->with('flash_success', 'Amenity Updated Successfully'); 
            
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Amenity Not Found');
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

            $post = Voucher::findOrFail($id);
            if( $post ) {
                Storage::delete($post->image);
                $post->delete();
                return back()->with('message', 'Voucher deleted successfully');
            }

        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Voucher Not Found');
        }
    }
}

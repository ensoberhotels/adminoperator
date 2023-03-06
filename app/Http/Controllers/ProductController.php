<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Product as Product;
use PHPMailer\PHPMailer;
use PDF;
class ProductController extends Controller
{
    public function htmltopdfview(Request $request)
    {
        //$products = Products::all();
        //view()->share('products',$products);
        if($request->has('download')){
            $pdf = PDF::loadView('htmltopdfview');
            return $pdf->download('htmltopdfview.pdf');
        }
        return view('htmltopdfview');
    }
	
	public function pdfview(Request $request)
    {
        //$products = Products::all();
        //view()->share('products',$products);
        if($request->has('download')){
            $pdf = PDF::loadView('dwnvoucher');
            return $pdf->download('pdfview.pdf');
        }
        return view('pdfview');
    }
	
	public function sendPdf(Request $request)
    {
		//dd('Hello');
        $pdf = PDF::loadView('dwnvoucher');
		//$pdf->set_paper("letter", "portrait" );
		//$pdf->render();
		//$output = $pdf->output();
        //$pdf->download('pdfview.pdf');
		
		$text             = 'Testing Hello Mail Image';
        $mail             = new PHPMailer\PHPMailer(); // create a n
        $mail->SMTPDebug  = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth   = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 25; // or 587
        $mail->IsHTML(true);
        $mail->Username = "Sales@ensoberhotels.com"; 
        $mail->Password = "rajensober1124";
        $mail->SetFrom("Sales@ensoberhotels.com", 'Ensober');
        $mail->Subject = "Ensober Email Test Subject";
        $mail->Body    = $text;
        $mail->AddAddress("sarwandeveloper@gmail.com", "Sarwan Verma");
        $mail->AddAttachment('public/storage/app/voucher/9340aH6exZ6dWVsKyBGlwvIjInOTMZSHocf6DlFz.png', '');
        if ($mail->Send()) {
            return 'Email Sended Successfully';
        } else {
            return 'Failed to Send Email';
        }
        
    }
	
	
	
}
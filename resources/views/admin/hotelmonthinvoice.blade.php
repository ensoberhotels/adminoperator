<style>
@page {
  size: A3;
}
table {
    width: 100%;
    font-family: sans-serif;
    text-align: left;
    line-height: 22px;
}
table.b_table td {
    padding: 5px;
}
lable {
    color: #555;
    font-weight: 600;
}
</style>
@php
$hotel_w = explode(' ',$hotel->hotel_name);
$invoice_no = 'ENS'.substr($hotel_w[0],0,1).substr($hotel_w[1],0,1).date('ymd');
@endphp
<table style="width:100%;">
	<tr>
		<td><h1>INVOICE</h1></td>
		<td><img src="{{ URL::to('public/asset/images/top_bar.JPG') }}" class="img-responsive"></td>
	</tr>
	<tr>
		<td colspan="2">
			<table>
				<tr>
					<td><lable>INVOICE NUMBER</lable><br>{{$invoice_no}}</td>
					<td><lable>DATE OF ISSUE</lable><br>{{date('d M Y')}}</td>
					<td><lable>BILLING PERIOD</lable><br> {{date('d M Y', strtotime($fromdate))}} - {{date('d M Y', strtotime($todate))}}</td>
				</tr>
			</table><br><br>
		</td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td><lable>BILLED TO</lable><br> <img src="{{ URL::to('/storage/app/'.$hotel->hotel_logo) }}" class="img-responsive" style="width:100px;"><br>{{$hotel->hotel_name}}<br> {{$hotel->address}} <br><br></td>
		<td style="padding-left:35px;"><b>Ensober Hotels</b><br>I-1804, Samridhi Grand Avenue<br> Noida, UP, India 201306<br>8383908656<br>raj@ensoberhotels.com<br>EnsoberHotels.com<br><br></td>
	</tr>
	<tr>
		<td colspan="2">
			<table border="1px" style="border-collapse: collapse; width:100%;" class="b_table">
				<tr>
					<th>DESCRIPTION</th>
					<th>Total Sale</th>
					<th>Extra's</th>
					<th>Net Sale</th>
					<th>Incentive</th>
				</tr>
				<tr>
					<td>Incentive ({{date('d-M', strtotime($fromdate))}} To {{date('d-M', strtotime($todate))}})</td>
					<td><span style=""><img src="{{ URL::to('/public/asset/images/rupee.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; {{$all_total_bill}}</td>
					<td><img src="{{ URL::to('/public/asset/images/rupee.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; {{$extra}}</td>
					<td><img src="{{ URL::to('/public/asset/images/rupee.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; {{$all_total_bill+$extra}}</td>
					<td><img src="{{ URL::to('/public/asset/images/rupee.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; {{$insentive}}</td>
				</tr>
				<tr>
					<td colspan="4">{{$des1}}</td>
					<td>@if($amount1 > 0 && $amount1 != '')<img src="{{ URL::to('/public/asset/images/rupee.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; {{$amount1}}@endif</td>
				</tr>
				<tr>
					<td colspan="4">{{$des2}}</td> 
					<td>@if($amount2 > 0 && $amount2 != '')<img src="{{ URL::to('/public/asset/images/rupee.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; {{$amount2}}@endif</td>
				</tr>
				<tr>
					<td colspan="4">{{$des3}}</td>
					<td>@if($amount3 > 0 && $amount3 != '')<img src="{{ URL::to('/public/asset/images/rupee.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; {{$amount3}}@endif</td>
				</tr>
				<tr>
					<td colspan="4">{{$des4}}</td>
					<td>@if($amount4 > 0 && $amount4 != '')<img src="{{ URL::to('/public/asset/images/rupee.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; {{$amount4}}@endif</td>
				</tr> 
			</table>
		</td>
	</tr>
	<tr>
		<td style="vertical-align: middle;"><lable>INVOICE TOTAL</lable><br><span style="color:#00a8f3; font-size:22px;"><img src="{{ URL::to('public/asset/images/rupee1.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; <b>{{$insentive+$amount1+$amount2+$amount3+$amount4-$total_advance_received}}</b></span></td>
		<td>
			<table style="padding-left:30px;width:280px;">
				<tr>
					<td>SUBTOTAL: </td>
					<td><img src="{{ URL::to('public/asset/images/rupee.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; {{$insentive+$amount1+$amount2+$amount3+$amount4}}</td>
				</tr>
				<tr>
					<td>ADVANCE RECEIVED: </td>
					<td><img src="{{ URL::to('public/asset/images/rupee.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; {{$total_advance_received}}</td>
				</tr>
				<tr>
					<td>TOTAL: </td>
					<td><img src="{{ URL::to('public/asset/images/rupee.jpg') }}" style="width: 11px; margin-right: -8px;"/> &nbsp; {{$insentive+$amount1+$amount2+$amount3+$amount4-$total_advance_received}}</td>
				</tr>
			</table><br><br><br>
		</td>
	</tr>
	<tr>
		<td><lable>Invoice Due Date</lable><br><span>{{date('d M Y')}}</span><br>
		<td></td>
	</tr>
	<tr>
		<td colspan="2"><p style="font-size:12px;">Comment: {{$comment}}</p><br><br><br></td>
	</tr>
	<tr style="background-color: #eee;">
		<td style="padding:5px; width:280px;">Account details for Remittence:<br>
		Name on Account: DayAway Holidays<br>
		Account Number: 2801201000411<br>
		IFSC: CNRB0002801</td>
		<td style="text-align:center;"><img src="{{ URL::to('public/asset/images/Ensober.jpg') }}" alt="logo"></td>
	</tr>
	<tr>
		<td colspan="2"><br><br></td>
	</tr>
	<tr>
		<td colspan="2"><br><h2>Statement <br><lable style="font-size:14px;">{{date('d M Y', strtotime($fromdate))}} - {{date('d M Y', strtotime($todate))}}</lable></h2></td>
	</tr>
	<tr>
		<td><lable>INVOICE NUMBER</lable><br>{{$invoice_no}}</td>
		<td><lable>DATE OF ISSUE</lable><br>{{date('d M Y')}}</td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
</table>
<table border="1px" style="border-collapse: collapse; font-size:11px;" class="b_table">
	<thead>
		<tr style="background-color: #eee;font-size: 13px;">
			<th>GUEST NAME</th>
			<th>BOOKING NO</th>
			<th>CHECK IN</th>
			<th>Billing Total</th>
			<th>Advance Amount</th>
			<th>Agent Name</th>
			<th>Advance Date</th>
			<th>Payment Source</th>
			<th>Booking From</th>
			<th>Booking Status</th>
		</tr>
	</thead>
	<tbody>
	@foreach($invoices as $invoice)
	<tr>
		<td>{{$invoice->client_name}}</td>
		<td style="width:70px;">{{$invoice->send_quotation_no}}</td>
		<td>{{date('d M', strtotime($invoice->check_in))}}</td>
		<td>{{$invoice->total_bill}}</td>
		<td>{{$invoice->advance_amount}}</td>
		<td style="width:50px;">{{$invoice->agent_name}}</td>
		<td>@if($invoice->date_of_advance){{date('d M', strtotime($invoice->date_of_advance))}}@endif</td>
		<td>{{$invoice->payment_source}}</td>
		<td>{{$invoice->booking_from}}</td>
		<td>{{substr($invoice->booking_status,0,4)}}</td>
	</tr>
	@endforeach
	<tr>
		<th colspan="3">Total</th>
		<th style="width:70px;">{{$total_bill}}</th>
		<th>{{$total_advance_amount}}</th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	</tbody>
</table>
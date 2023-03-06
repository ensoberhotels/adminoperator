<style>
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
<body id="tbl_exporttable_to_xls">
<table style="width:100%;">
	<tr>
		<td colspan="2"><br><h2>Statement:  <span style="color:#00a8f3;">{{date('d M Y', strtotime($fromdate))}} - {{date('d M Y', strtotime($todate))}}</span></h2></td>
	</tr>
	<tr>
		<td><lable>INVOICE NUMBER: </lable><br>ENSPC{{date('ymd')}}</td>
		<td><lable>DATE OF ISSUE: </lable><br>{{date('d M Y')}}</td>
	</tr>
</table>
<table border="1px" style="border-collapse: collapse; font-size:13px;" class="b_table">
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
		<td>{{date('d M, Y', strtotime($invoice->check_in))}}</td>
		<td>{{$invoice->total_bill}}</td>
		<td>{{$invoice->advance_amount}}</td>
		<td style="width:50px;">{{$invoice->agent_name}}</td>
		<td>@if($invoice->date_of_advance){{date('d M', strtotime($invoice->date_of_advance))}}@endif</td>
		<td>{{$invoice->payment_source}}</td>
		<td>{{$invoice->booking_from}}</td>
		<td>{{$invoice->booking_status}}</td>
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
</body> 
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>
	function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tbl_exporttable_to_xls');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Hotel Monthly Invoice.' + (type || 'xlsx')));
    }
	ExportToExcel('xlsx');
	window.close();
</script>
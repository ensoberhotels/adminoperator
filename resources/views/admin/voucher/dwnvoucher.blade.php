<html>
    <head>
        <style>
            table.body td {
				padding: 9px 15px;
				margin: 0px -2px;
				font-size:16px;
				border-bottom: 0.5px solid #ddd3d3;
			}
			
			table.body {
				width:100%;
				color:#555;
				border-spacing: -1px;
				border:collapse; 
			}
			/*table.body tr:nth-child(even) {background-color: #8b5050; color:#fff;}
			table.body tr:nth-child(odd) {background-color: #26237a; color:#fff;}*/
			td.lable_text {
				text-align: center;
				background-color: #009688;
				color:#fff;
				padding: 5px 0;
			}
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 110px;
                margin-left: 0cm;
                margin-right:0cm;
                margin-bottom: 130px;
				font-family: sans-serif;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 110px;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 30px;
				font-family: sans-serif;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 130px;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
				font-family: sans-serif;
            }
			
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
			<!--<div style="display: inline-block;padding:5px;line-height: 32px;">-->
				<img src="{{ url('storage/app/'.$voucher->hotel_logo) }}" alt="Logo" width="160px;" style="margin-top:10px;"/> By <img src="{{ URL::asset('asset/images/logo/Ensober.jpg') }}" alt="logo" width="160px;" style="margin-top:10px;"/><br>
			<!--</div><br>
			<div style="display: inline-block; line-height: 1px;">-->
				Resort Address: {{ $voucher->hotel_address }}
			<!--</div>-->
        </header>

        <footer>
            <p>
				*Kindly follow the Social distancing and Covid-19 guidelines as per Govt.<br>
				This is a computer generated voucher and does not require signature.<br>
				Standard Check In Time : 12:00 PM<br>
				Standard Check Out Time: 10:00 PM<br>
				Stay Safe! Stay Healthy!
			</p>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <table class="body">
				<tr>
					<td class="lable_text" colspan="3"><h3 style="margin: 0;">Reservation Voucher</h3></td> 
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-1.jpg') }}" alt=""/></span> Reservation No</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->reservation_no }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-2.jpg') }}" alt=""/></span> Date</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->date }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-3.jpg') }}" alt=""/></span> Hotel Name</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->hotel_name }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-4.jpg') }}" alt=""/></span> Agent Name</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->agent_name }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-5.jpg') }}" alt=""/></span> Confirmation No. / Confirmed By</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->confirmed_by }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-6.jpg') }}" alt=""/></span> Client Name</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->client_name }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-7.jpg') }}" alt=""/></span> Check In </td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->check_in }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-8.jpg') }}" alt=""/></span> Check Out</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->check_out }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-9.jpg') }}" alt=""/></span> No Of Nights</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->no_of_nights }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-10.jpg') }}" alt=""/></span> No Of Pax</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->no_of_pax }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-11.jpg') }}" alt=""/></span> Kids</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->kids }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-12.jpg') }}" alt=""/></span> No Of Room</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->no_of_room }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-13.jpg') }}" alt=""/></span> Room Type</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->room_type }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-14.jpg') }}" alt=""/></span> Package / Tariff Include</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->package }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-15.jpg') }}" alt=""/></span> Cost</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->cost }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-16.jpg') }}" alt=""/></span> Advance Received</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>{{ $voucher->advance_received }}</td>
				</tr>
				<tr>
					<td><span><img src="{{ URL::asset('asset/images/icon/pi-17.jpg') }}" alt=""/></span>Balance</td>
					<td><img src="{{ URL::asset('asset/images/icon/rarrow2.jpg') }}" alt=">"/></td>
					<td>Payable at the Time of Check in</td>
				</tr>
			</table>
        </main>
    </body>
</html>
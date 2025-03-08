@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard ')

@section('styles')
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

	<style>
		.select_template{float: left; margin: 0; padding: 0;}
		.select_template input {
			position: unset !important;
			opacity: 1 !important;
			pointer-events: auto !important;
			width: 15px !important;
			height: 15px !important;
		}
		.row {
			display: -ms-flexbox;
			display: unset;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			margin-right: -15px;
			margin-left: -15px;
		}
		.select_template li {
			display: inline-block;
			margin: 0 5px;
		}
		textarea.custom_message {
			width: 100%;
			height: 112px;
			padding: 5px 15px;
		}
		.custom_div {
			float: left;
			width: 100%;
			display:none;
		}
		.contact-header {
			float: left;
			width: 100%;
			margin: -26px 0 -25px;
		}
		
	</style>
@endsection

@section('content')
	<!-- BEGIN: Page Main-->
	<div id="main">
      <div class="row">
          <div class="container">
            <!-- Contact Us -->
		<div id="contact-us" class="section">
		  <div class="app-wrapper">
			<div class="contact-header" style="margin-top: 0rem;"> 
			  <div class="row contact-us">
				<div class="col s12 m12 form-header" style="padding: 0.5rem;">
				  <h6 class="form-header-text"><i class="material-icons"> mail_outline </i> 
					Send Hotel Quotation 
				  </h6>
				</div>
			  </div>
			</div>

    <!-- Contact Sidenav -->
    <div id="sidebar-list" class="row contact-sidenav">
      
      <div class="contact-form margin-top-contact" style="padding: 15px 15px 30px;">
		  <form class="" method="POST" action="/operator/smtpsendemail" enctype='multipart/form-data'>
			{{csrf_field()}}
            <div class="row">
              <div class="col m6 s12">
				<label for="name">From</label>
				<select class="validate" name="from">
					@foreach($SMTPEmails as $SMTPEmail)
						<option value="{{$SMTPEmail->id}}">{{$SMTPEmail->email}}</option>
					@endforeach
				</select>
              </div>
              <div class="col m6 s12">
				<label for="email">To</label>
                <input id="email" type="text" name="to" class="validate" value="{{$contact['email']}}">
              </div>
            </div>
            <div class="row">
			  <div class="col m6 s12">
				<label for="name">To Name</label>
                <input id="name" type="text" name="name" class="validate" value="{{$contact['name']}}">
              </div>
              <div class="col m6 s12">
				<label for="company">Cc</label>
                <input id="company" type="text" class="validate" name="cc">
              </div>
			</div>
			 <div class="row">
              <div class="col m6 s12">
				<label for="budget">Subject</label>
                <input id="budget" type="text" class="validate" name="subject" value="Ensober Hotels Rate">
				
				<div class="s12">
					<label for="rate_date">Date</label>
					<input id="rate_date" type="date" class="validate" name="rate_date" value="">
				</div>
              </div>
			  <div class="col m6 s12">
				<label for="budget">Select Hotel</label>
				<select class="hotel_id selectpicker" data-live-search="true" name="hotel_id" multiple style="height: 84px !important;">
					<option>Select Hotel</option>
					@foreach($Hotels as $Hotel)
						<option value="{{$Hotel->id}}">{{$Hotel->hotel_name}}</option>
					@endforeach
				</select> 
              </div>
			</div>
			<div class="row">
			  <div class="col m6 s12">
				<input id="attachment" type="file" class="validate" name="attachment" value="" style="border: none !important;">
              </div>
				<div class="col s12 m6">               
				<button class="btn waves-effect waves-light right generate_tem" type="button" style="margin: 0 5px !important;">Preview
                    <i class="material-icons right">build</i>
                </button>
				
                <button class="btn waves-effect waves-light right" type="submit" name="action" id="add_hotel">		Submit <i class="material-icons right">send</i>
                </button>
				<ul class="select_template">
					<li><input type="radio" name="email_message" class="email_message" value="custom" /> Custom</li>
					<li><input type="radio" name="email_message" class="email_message" value="template" checked /> Template</li>
				</ul>
              </div>
			</div>
			<div class="row">
				<div class="template_div">
			  
				</div>
				<div class="custom_div"> 
					<textarea id="textarea1" class="message_body custom_message" name="message"></textarea>
				</div>
            </div>
          </form>
      </div>
    </div>
</div>

          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
@endsection

@section('scripts')
<script>
	jQuery(document).ready(function(){
		// select template ot custome message
		jQuery(".email_message").click(function(){
			var type = jQuery(this).val();
			if(type == 'custom'){
				jQuery(".template_div").hide();
				jQuery(".custom_div").show();
				jQuery(".message_body").html('');
			}else if(type == 'template'){
				jQuery(".template_div").show();
				jQuery(".custom_div").hide();
				var message = jQuery(".template_div").html();
				jQuery(".message_body").html(message);
			}
		});
		jQuery(".template_div").delegate(".update_price", "dblclick", function() {
			jQuery(this).attr("contenteditable","true"); 
		});
		
		jQuery(".template_div").delegate(".update_price", "blur", function() {
			//alert();
			var template = jQuery(".template_div").html();
			//alert(template);
			jQuery(".message_body").text(template);
		});
		
		
		jQuery(".generate_tem").click(function(){
			var hotel_id = jQuery(".selectpicker").val();
			var rate_date = jQuery("#rate_date").val();
			
			var dataValue = {'hotel_id':hotel_id, 'rate_date':rate_date};
			$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
			$("#loader-wrapper").css("display","block");       
			$.ajax({
				url: "/operator/generatetemplate",
				type:"post",
				cache: false,
				async:true,
				data: dataValue,
				success: function(data){
					//var data = JSON.parse(data);
					$("#loader-wrapper").css("display","none");
					jQuery(".template_div").html(data);
					jQuery(".message_body").text(data);
					//alert(data.message); 
				}
			});
		});
		
		jQuery('.selectpicker').selectpicker();
	});
</script>
@endsection
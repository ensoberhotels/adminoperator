@extends('operator.template.base')

@section('title', 'Ensober Operator Dashboard ') 

@section('styles')
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/css/pages/dashboard-modern.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/css/pages/intro.css') }}">
   <!-- BEGIN: VENDOR CSS-->
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/vendors.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/animate-css/animate.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/chartist-js/chartist.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{URL::asset('public/asset/vendors/chartist-js/chartist-plugin-tooltip.css') }}">
   <style>
   
.table_head {
  position: relative;
  overflow-x: hidden;
  /*margin-top: 40px;*/
}
.header {
  /*position: absolute;*/
    overflow-y: scroll;
    width: 100%;
    /*display: inline-table;*/
    /* height: 56px; */
    margin-top: -36px;
    /* padding-top: 20px;  /* heights, so these two lines make it work  */
}
.header .wrapper {
 position: sticky; top: 0; z-index: 1;background:#fff;
}

.content {
  padding-top: 20px;
  height: 200px;
  /*background-color: grey;*/
  overflow: auto;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 3px;
    line-height: 1;
    text-align: center;
    vertical-align: top;
    border-top: 1px solid #ddd;
}  
   </style>
    <!-- END: VENDOR CSS-->
@endsection

@section('content') 
   <!-- BEGIN: Page Main-->
<div id="main">
   <div class="row">
     	<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
     	<div class="col s12">
       	<div class="container">
				<!-- card stats start -->
				<!-- <div id="card-stats">
				   <div class="">
						<div class="clable_main">
							<div class="clable"> 
								<div class="clable_text">
									Lead Followup Remainder
								</div>
								<div class="clable_value">
									{{ $new_count }}
								</div>
							</div>
							
							<div class="clable color1">
								<div class="clable_text">
									Quotation Followup Remainder
								</div>
								<div class="clable_value">
									{{ $new_count }}
								</div>
							</div>
							
							<div class="clable color2">
								<div class="clable_text">
									Sale Followup Remainder
								</div>
								<div class="clable_value">
									{{ $new_count }}
								</div>
							</div> 
							
							<div class="clable color3">
								<div class="clable_text">
									Client Checkin Remainder
								</div>
								<div class="clable_value">
									{{ $new_count }}
								</div>
							</div>
							
							<div class="clable color4">
								<div class="clable_text">
									Feedback Remainder
								</div>
								<div class="clable_value">
									{{ $new_count }}
								</div>
							</div>
							
							<div class="clable color1">
								<div class="clable_text">
									Feedback Remainder
								</div>
								<div class="clable_value">
									{{ $new_count }}
								</div>
							</div>
							<div class="clable color">
								<div class="clable_text">
									Vender Services Remainder
								</div>
								<div class="clable_value">
									{{ $new_count }}
								</div>
							</div>
						</div>
				   </div>
				   
				   <div class="row">
				      <div class="col s12 m12">
				              <div class="card subscriber-list-card animate fadeRight">
				                 <div class="card-content pb-1">
				                    <h4 class="card-title mb-0">Lead List <i class="material-icons float-right">more_vert</i></h4>
				                 </div>
				                 <table class="subscription-table responsive-table highlight">
				                    <thead>
				                       <tr>
				                          <th>Name</th>
				                          <th>Lead Number</th>
				                          <th>Create Date</th>
				                          <th>Status</th>
				                          <th>Start Date</th>
				                          <th>Amount</th>
				                       </tr>
				                    </thead>
				                    <tbody>
				                    @if(count($leadlists))
				                    @foreach($leadlists as $leadlist)
				                       <tr>
				                          <td>{{$leadlist->name}}</td>
				                          <td>{{$leadlist->lead_no}}</td>
				                          <td>{{(isset($leadlist->create_date) ? date('d M Y', strtotime($leadlist->create_date)) : '')}}</td>
				                          <td><span class="badge pink lighten-5 pink-text text-accent-2">{{$leadlist->lead_status}}</span></td>
				                          <td>{{date('d M Y', strtotime($leadlist->start_date))}}</td>
				                          <td>@if($leadlist->price!='')<span>&#8377;</span> {{$leadlist->price}} @else Not Quotated @endif</td>
				                       </tr>
				                    @endforeach 
				                    @else  
				                       <tr>
				                          <td colspan="6">No Lead created</td>
				                       </tr>
				                    @endif
				                       
				                    </tbody>
				                 </table>
				                 <div class="pagination">{{$leadlists->links()}}</div>
				              </div>
				           </div>
				   </div>
				</div> -->
				<!--/ card stats end-->
				{{--<div class="row" style="margin-right: 0px;margin-left: 0px;">
               <div class="col s6" style="margin-left: 0px;padding:0px;">
                  <div class="card" style="margin-left: 2px;margin-right: 2px;margin-top: 2px">
                     <div class="card-content" style="padding: 5px;">
                        <div class="card-header" style="margin-left: 15px;display: inline-flex;">
                           <h5 style="font-size: 16px;color: #0505ac;">My Menu Manager</h5>
                           <button onclick="refresh()" class="btn btn-sm" style="background: #fff;box-shadow: none;"><i class="material-icons"  id="refresh" style="margin-top: 4px;color: red;margin-left: 9px;">refresh</i></button>
                           <img src="{{URL::asset('public/asset/images/refresh_loader.jpg')}}" id="po_search_loader" class="input_loader po_search_loader" style="display: none;position: unset;width: 20px;height: 20px;text-align: left;float: right;margin-left: -21px;margin-right: 3px;margin-top: 11px">
                        </div>
                        <div class="card-body">
                           <div class="row" style="margin-right: 0px;margin-left: 0px;">
                              <div class="col s12">
                                 <div class="table-responsive table_head" style="height: 240px;overflow-: scroll;">
                                    <table id="multi-select" class="table table-hover">
                                       <thead class="header">
                                          <tr class="wrapper">
                                             <th>Sr. No.</th>
                                             <th style="text-align:left;">Menu Name</th>
                                             <th>Status</th>
                                          </tr>
                                       </thead>
                                       <tbody id="table_body" class="content">
                                          @php $i=1; @endphp
                                          @foreach($data as $datas)
                                             <tr>
                                                <td>{{$i}}</td>
                                                <td style="text-align:left;">{{$datas->name}}</td>

                                                <td style="padding: 3px !important;" id="show_act_{{$datas->id}}">
                                                   @if($datas->menu_flag == 'Y')
                                                      <span onclick="return changeStatus({{$datas->id}})" name="action" class="td_status" >ACTIVE</span>
                                                   @else
                                                      <span onclick="return changeStatus({{$datas->id}})" name="action" class="td_status_inactive" >INACTIVE</span>
                                                   @endif
                                                   <input type="hidden" id="menu_flag_{{$datas->id}}" value="{{$datas->menu_flag}}">
                                                   <img src="{{URL::asset('public/asset/images/btn_loader.gif')}}" id="po_search_loader{{$datas->id}}" class="input_loader po_search_loader" style="display: none;position: unset;width: 18px;height: 18px;text-align: left;float: right;margin-left: -24px;margin-right: 8px;margin-top: 2px;">
                                                </td>
                                             </tr>
                                             @php $i++; @endphp
                                          @endforeach
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>--}}
      	</div>
     	</div>
   </div>
</div> 
   <!-- END: Page Main-->
@endsection

@section('scripts')
	<style type="text/css">
     .card {
     padding: 0 0 0px !important; 
}
.card-content {
     padding: 0px 0px 0px !important; 
}
td {
    padding: 5px !important;
}
th {
    margin: 0 !important;
    padding: 6px 5px 6px !important;
    background: #eee;
}
.td_status{
       margin-right: 10px;
    height: 26px;
    padding: 2px;
    background-color: #6a27a2;
    color: #fff;
    font-size: 10px;
    line-height: 1;
    border: 1px solid #6a27a2;
    border-radius: 7px;
    cursor: pointer;
}
.td_status_inactive{
       margin-right: 10px;
    height: 26px;
    padding: 2px;
    background-color: #ff4081;
    color: #fff;
    font-size: 10px;
    line-height: 1;
    border: 1px solid #ff4081;
    border-radius: 7px;
    cursor: pointer;
}
.card {
    padding: 0px !important;
    height: 288px;
}
   </style>
   <script src="{{URL::asset('public/asset/vendors/chartist-js/chartist.min.js') }}" type="text/javascript"></script>
   <script src="{{URL::asset('public/asset/vendors/chartist-js/chartist-plugin-tooltip.js') }}" type="text/javascript"></script>
   <script src="{{URL::asset('public/asset/vendors/chartist-js/chartist-plugin-fill-donut.min.js') }}" type="text/javascript"></script>

   <!-- BEGIN PAGE LEVEL JS-->
      <script src="{{URL::asset('public/asset/js/scripts/dashboard-modern.js') }}" type="text/javascript"></script>
      <script src="{{URL::asset('public/asset/js/scripts/intro.js') }}" type="text/javascript"></script>
      <script type="text/javascript">
      function changeStatus(id){
         var menu_flag=jQuery('#menu_flag_'+id).val();
         jQuery('#po_search_loader'+id).show();
         if(menu_flag == 'Y'){
            var flag='N';
         }else{
            var flag='Y';
         }
         jQuery.ajax({
            type: "POST",
            url: '/operator/dashboard/save',
            data: {'flag':flag,'id':id},
            dataType: "json",
            success: function(response) {
               console.log(response);
               if (response.status == 1) {
                  jQuery('#po_search_loader'+id).hide();
                  var tableHTML='';
                  if(response.data == 'Y'){
                     tableHTML+='<span onclick="return changeStatus('+id+')" name="action" class="td_status" >ACTIVE</span>';
                  }else{
                     tableHTML+='<span onclick="return changeStatus('+id+')" name="action" class="td_status_inactive" >INACTIVE</span>';
                  }
                  jQuery('#show_act_'+id).html(tableHTML);
               }
            }
         })
      }
      function refresh(){
         jQuery('#refresh').hide();
         jQuery('#po_search_loader').show();
         setTimeout(function() {
            location.reload();
            jQuery('#refresh').show();
            jQuery('#po_search_loader').hide();
         }, 3000);
      }
   </script>
    <!-- END PAGE LEVEL JS-->
@endsection
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Frontend

Route::get('/', function () {
     return view('welcome');
 });

// clear cache
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize:clear');
    return "<h1 style='text-align: center;'>!!Cache cleared successfully!</h1>";
});

// Get the current database connection info
Route::get('/artisan-database', function() {
	try {
		print_r('databse name= '.DB::connection()->getDatabaseName());
	} catch (\Exception $e) {
		die("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
});

Route::get('testpdf/', 'ItineraryController@downloadSendQuotation');

Route::get('/viewhotel/{id}', 'CommanController@viewHotel');


// Hotel

Route::get('/admin', 'AdminController@index');
Route::get('/admin/forget-password', 'AdminController@forgetPassword');
Route::get('/admin/reset-password/{id}', 'AdminController@resetPassword');
Route::post('/admin/sendMail', 'AdminController@sendMail');

Route::get('/admin/phpinfo', 'AdminController@phpInfoVal');

Route::post('/admin/login/action', 'AdminController@adminLogin');

Route::get('/admin/send', 'AdminController@send');

Route::get('/admin/pdf', 'AdminController@gpdf');

Route::post('/admin/closecontact', 'AdminController@closeContactToOperator');

Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::post('/admin/dashboard/save', 'AdminController@ChangeStatus');
Route::get('/admin/addvender', 'AdminController@addVender');

Route::post('/admin/addvenderaction', 'AdminController@addVenderAction');

Route::get('/admin/allvender', 'AdminController@getAllVenders');

Route::get('/admin/addoperator', 'AdminController@addOperator');

Route::post('/admin/addoperatoraction', 'AdminController@addOperatorAction');

Route::get('/admin/alloperators', 'AdminController@getAllOperators');

Route::get('/admin/addemaillist', 'AdminController@addEmailList');

Route::get('/admin/addhotel', 'AdminController@addHotel');

Route::get('/admin/addhotelseasonrate', 'AdminController@addHotelSeasonRate');

Route::get('/admin/addhotelgroupseasonrate', 'AdminController@addHotelGroupSeasonRate');

Route::post('/admin/addhotelseasonrateaction', 'AdminController@addHotelSeasonRateAction');

Route::post('/admin/addhotelgroupseasonrateaction', 'AdminController@addHotelGroupSeasonRateAction');

Route::get('/admin/allhotels', 'AdminController@hotelList');

Route::get('/admin/logout', 'AdminController@logout');

Route::post('/admin/addhotelaction', 'AdminController@addHotelAction');

Route::get('/admin/viewleadstatus', 'AdminController@viewLeadStatus');

Route::get('/admin/contactfollowupreport', 'AdminController@contactFollowUpReport');
Route::get('/admin/hotel-monthly-invoice', 'AdminController@HotelMonthlyInvoice');
Route::get('/admin/hotel-monthly-invoice-generate', 'AdminController@generateMonthlyInvoice');

Route::get('/admin/viewhotel/{id}', 'AdminController@viewHotel'); 
Route::get('/admin/importcontact', 'AdminController@importContact'); 
Route::get('/admin/emailcampaign', 'AdminController@getEmailCampaign'); 
Route::get('/admin/deletecampaign/{id}', 'AdminController@deleteEmailCampaign'); 
Route::get('/admin/updatecampaign/{id}', 'AdminController@updateEmailCampaign'); 
Route::post('/admin/uploadcontacts', 'AdminController@uploadContacts'); 

// Make Quotation
Route::get('/admin/makequotation/', 'AdminController@makeQuotation'); 


// Ajax Controller
Route::post('admin/ajaxShowHotel', 'AjaxController@showhotel');
Route::post('admin/getactivityname', 'AjaxController@getActivityNameByACatID');
Route::post('admin/getstatename', 'AjaxController@getStateNameByCountryID');
Route::post('admin/getcityname', 'AjaxController@getCityNameByStateID');
Route::post('admin/getactivitysubcat', 'AjaxController@getActivitySubCat');
Route::post('admin/ajaxChangeStatus', 'AjaxController@ChangeStatus');
Route::post('admin/ajaxGetMobile', 'AjaxController@GetMobile');
Route::post('admin/ajaxGetLeadDetail', 'AjaxController@GetLeadDetail');
Route::post('admin/ajaxSearchHotel', 'AjaxController@SearchHotel');
Route::post('admin/viewhotel/ajaxGetSeasonRate', 'AjaxController@GetSeasonRate');
Route::post('admin/hotelseasonrate/ajaxGetRoomCategory', 'AjaxController@GetRoomCategory');
Route::post('admin/hotelgroupseasonrate/ajaxGetRoomCategory', 'AjaxController@GetRoomCategory');
Route::post('admin/ajaxChangeApprovel', 'AjaxController@ChangeApprovel');

Route::post('admin/getcarmodel', 'AjaxController@getCarModelByCarSegmentID');
Route::post('admin/getcarseats', 'AjaxController@getCarSeatsByCarModelID');
Route::post('admin/ajaxgetCarDetail', 'AjaxController@getCarDetail');
Route::post('admin/ajaxAsignContacts', 'AjaxController@AsignContacts');
// Route::post('admin/ajaxAsignContacts', 'AjaxController@AsignContacts_old');
Route::post('admin/ajaxcreateCampaign', 'AjaxController@createCampaign');





Route::post('operator/ajaxShowHotel', 'AjaxController@showhotel');
Route::post('operator/getactivityname', 'AjaxController@getActivityNameByACatID');
Route::post('operator/getstatename', 'AjaxController@getStateNameByCountryID');
Route::post('operator/getcityname', 'AjaxController@getCityNameByStateID');
Route::post('operator/getactivitysubcat', 'AjaxController@getActivitySubCat');
Route::post('operator/ajaxChangeStatus', 'AjaxController@ChangeStatus');
Route::post('operator/ajaxGetMobile', 'AjaxController@GetMobile');
Route::post('operator/ajaxGetLeadDetail', 'AjaxController@GetLeadDetail');
Route::post('operator/ajaxMakeQuatation', 'AjaxController@MakeQuatation');
Route::post('operator/ajaxMakeSale', 'AjaxController@MakeSale');
Route::post('operator/viewhotel/ajaxGetSeasonRate', 'AjaxController@GetSeasonRate');
Route::post('operator/ajaxcreateandasigncontact', 'AjaxController@CreateContactAndAsignContacts');
Route::post('operator/checkcontact', 'AjaxController@contactExist');
Route::post('operator/ajaxAsignContactsbymobile', 'AjaxController@AsignContactsByMobile');

Route::post('vender/ajaxChangeStatus', 'AjaxController@ChangeStatus');
Route::post('vender/ajaxSearchHotel', 'AjaxController@VenderSearchHotel');
Route::post('vender/ajaxgetHotelDetail', 'AjaxController@getHotelsByCity');
Route::post('vender/ajaxgetHotelDetailAW', 'AjaxController@getHotelsByCityAw');
Route::post('vender/ajaxgetHotelRoomTypeDetail', 'AjaxController@getHotelRoomTypeById');
Route::post('vender/ajaxgetHotelRoomTypeDetailAw', 'AjaxController@getHotelRoomTypeByIdAw');

Route::post('vender/viewhotel/ajaxGetSeasonRate', 'AjaxController@GetSeasonRate');
Route::post('vender/hotelseasonrates/ajaxGetRoomCategory', 'AjaxController@GetRoomCategory');

// Itinerary Make
Route::post('vender/ajaxitibasicinfo', 'AjaxController@itiBasicInfo'); 
Route::post('vender/itineraryupdate/ajaxitibasicinfo', 'AjaxController@itiBasicInfo'); 
Route::post('vender/itineraryupdatem/ajaxitibasicinfo', 'AjaxController@itiBasicInfo'); 
Route::post('vender/addTransport', 'AjaxController@itiAddTransport'); 
Route::post('vender/itineraryupdate/addTransport', 'AjaxController@itiAddTransport'); 
Route::post('vender/itineraryupdatem/addTransport', 'AjaxController@itiAddTransport'); 
Route::post('vender/deletetransport', 'AjaxController@itiDeleteTransport'); 
Route::post('vender/itineraryupdate/deletetransport', 'AjaxController@itiDeleteTransport'); 
Route::post('vender/itineraryupdatem/deletetransport', 'AjaxController@itiDeleteTransport'); 
Route::post('vender/itineraryupdate/getRoutes', 'AjaxController@itiGetRoutes'); 
Route::post('vender/itineraryupdatem/getRoutes', 'AjaxController@itiGetRoutes'); 
Route::post('vender/getRoutes', 'AjaxController@itiGetRoutes'); 
Route::post('vender/getRoutesDetail', 'AjaxController@itiGetRoutesDetails'); 
Route::post('vender/addRoutesDetail', 'AjaxController@addItiRoutesDetails'); 
Route::post('vender/itineraryupdate/addRoutesDetail', 'AjaxController@addItiRoutesDetails'); 
Route::post('vender/itineraryupdatem/addRoutesDetail', 'AjaxController@addItiRoutesDetails'); 
Route::post('vender/getRoutesCities', 'AjaxController@getRouteCity'); 
Route::post('vender/getallRoutesCities', 'AjaxController@getAllRouteCity'); 
Route::post('vender/itineraryupdate/getRoutesCities', 'AjaxController@getRouteCity'); 
Route::post('vender/itineraryupdatem/getRoutesCities', 'AjaxController@getRouteCity'); 
Route::post('vender/itineraryupdate/getallRoutesCities', 'AjaxController@getAllRouteCity'); 
Route::post('vender/itineraryupdatem/getallRoutesCities', 'AjaxController@getAllRouteCity');
Route::post('vender/deleteitihotels', 'AjaxController@deleteItiHotels'); 
Route::post('vender/itineraryupdate/deleteitihotels', 'AjaxController@deleteItiHotels'); 
Route::post('vender/itineraryupdatem/deleteitihotels', 'AjaxController@deleteItiHotels'); 
Route::post('vender/deleteitihotelremove', 'AjaxController@deleteItiHotelByDestiId'); 
Route::post('vender/itineraryupdate/deleteitihotelremove', 'AjaxController@deleteItiHotelByDestiId'); 
Route::post('vender/itineraryupdatem/deleteitihotelremove', 'AjaxController@deleteItiHotelByDestiId'); 
Route::post('vender/getHotelById', 'AjaxController@getHotelsByCityId');
Route::post('vender/itineraryupdate/getHotelById', 'AjaxController@getHotelsByCityId');
Route::post('vender/itineraryupdatem/getHotelById', 'AjaxController@getHotelsByCityId');
Route::post('vender/getRoomTypeById', 'AjaxController@getHotelRoomTypeByIdITI');
Route::post('vender/itineraryupdate/getRoomTypeById', 'AjaxController@getHotelRoomTypeByIdITI');
Route::post('vender/itineraryupdatem/getRoomTypeById', 'AjaxController@getHotelRoomTypeByIdITI');
Route::post('vender/ajaxgetHotelRate', 'AjaxController@GetHotelSeasonRate');
Route::post('vender/itineraryupdate/ajaxgetHotelRate', 'AjaxController@GetHotelSeasonRate');
Route::post('vender/itineraryupdatem/ajaxgetHotelRate', 'AjaxController@GetHotelSeasonRate');
Route::post('vender/getactivitybycity', 'AjaxController@getActivitiesByCity');
Route::post('vender/itineraryupdate/getactivitybycity', 'AjaxController@getActivitiesByCity');
Route::post('vender/itineraryupdatem/getactivitybycity', 'AjaxController@getActivitiesByCity');
Route::post('vender/getactivitytimebyid', 'AjaxController@getActivityTimeById');
Route::post('vender/itineraryupdate/getactivitytimebyid', 'AjaxController@getActivityTimeById');
Route::post('vender/itineraryupdatem/getactivitytimebyid', 'AjaxController@getActivityTimeById');
Route::post('vender/getactivityprice', 'AjaxController@getActivityPrice');
Route::post('vender/itineraryupdate/getactivityprice', 'AjaxController@getActivityPrice');
Route::post('vender/itineraryupdatem/getactivityprice', 'AjaxController@getActivityPrice');
Route::post('vender/addActivities', 'AjaxController@addActivities');
Route::get('vender/verifyUser', 'AjaxController@verifyUser');
Route::get('vender/calculateItineraryPrince', 'AjaxController@calculateItineraryPrince');
Route::get('vender/itineraryupdate/calculateItineraryPrince', 'AjaxController@calculateItineraryPrince');
Route::get('vender/itineraryupdatem/calculateItineraryPrince', 'AjaxController@calculateItineraryPrince');
Route::post('vender/updateitineraryprice', 'AjaxController@updateItineraryPrince');
Route::post('vender/itineraryupdate/updateitineraryprice', 'AjaxController@updateItineraryPrince');
Route::get('vender/regenerateDayWiseIti/{id}', 'AjaxController@regenerateDayWiseIti');
Route::get('vender/itinerary/view/{id}', 'ItineraryController@itineraryView'); 
Route::get('vender/itinerary/download/{id}', 'ItineraryController@downloadItinerary'); 
Route::get('vender/itinerarymanage/{id}', 'ItineraryController@itineraryManage'); 
Route::get('vender/itinerarylist', 'ItineraryController@getItineraryForListig'); 
Route::get('vender/itineraryupdate/{id}', 'ItineraryController@updateItineraryNew'); 
Route::get('vender/itineraryupdatem/{id}', 'ItineraryController@updateItineraryNewM'); 
Route::get('vender/daywiseitiupdate/{id}', 'ItineraryController@updateDaywiseItinerary');
Route::post('vender/daywiseitiupdate', 'ItineraryController@updateDaywiseItineraryAct');

// Add Hotel

Route::post('/admin/addhotelstep1', 'AdminController@addHotelStep1');

Route::get('/admin/websiteenquiry', 'AdminController@getWebsiteEnquiry');

Route::get('/admin/addhotelstep2', 'AdminController@logout');

Route::get('/admin/addhotelstep3', 'AdminController@logout');

Route::get('/admin/addhotelstep4', 'AdminController@logout');

// Amenities
Route::get('/admin/addamenity', 'AdminController@addPaidAmenities');

Route::post('/admin/addamenityaction', 'AdminController@addPaidAmenitiesAction');

    

// Resourses

Route::resource('/admin/car', 'Resource\CarResource');
Route::resource('/admin/carsegment', 'Resource\CarSegmentResource');
Route::resource('/admin/carsmodel', 'Resource\CarModelResource');
Route::resource('/admin/carseat', 'Resource\CarSeatsResource');

Route::resource('/admin/notificationmessage', 'Resource\NotificationMessageResource');
Route::resource('/admin/emailtemplate', 'Resource\EmailTemplatResource');
Route::resource('/admin/transport', 'Resource\TransportResource');
Route::resource('/admin/vender', 'Resource\VenderResource');
Route::resource('/admin/operator', 'Resource\OperatorResource');
Route::resource('/admin/hotelseasonrate', 'Resource\HotelSeasonRateResource');
Route::resource('/admin/paymentsource', 'Resource\PaymentSourceResource');
Route::resource('/admin/via', 'Resource\ViaResource');
Route::resource('/admin/hotelgroupseasonrate', 'Resource\HotelGroupSeasonRateResource');
Route::resource('/admin/amenity', 'Resource\AmenityResource');
Route::resource('/admin/activitycat', 'Resource\ActivityCatResource');
Route::resource('/admin/activityname', 'Resource\ActivityNameResource');
Route::resource('/admin/activitysubcat', 'Resource\ActivitySubCatResource');
Route::resource('/admin/hotel', 'Resource\HotelResource');
Route::resource('/admin/activity', 'Resource\ActivityResource');
Route::resource('/admin/lead', 'Resource\LeadResource');
Route::resource('/admin/contact', 'Resource\ContactsResource');
Route::resource('/admin/daywisedetail', 'Resource\DayWiseDetailResource');
Route::get('/admin/itinerary/cities', 'Resource\DayWiseDetailResource@getCityList');
Route::post('/admin/itinerary/cities/{id}', 'Resource\DayWiseDetailResource@updateCityList');
Route::get('/admin/assigncontact', 'Resource\ContactsResource@assignedContact');
Route::get('/admin/unassigncontact', 'Resource\ContactsResource@unAssignedContact');
Route::get('/admin/getassignedoperator', 'Resource\ContactsResource@getAssignedOperator');
Route::get('/admin/removeduplicatescontacts', 'Resource\ContactsResource@removeDuplicatesContacts');
Route::resource('/admin/smtpemail', 'Resource\SmtpemailResource');
Route::resource('/admin/request', 'Resource\AdminRequestResource');
Route::resource('/admin/voucher', 'Resource\VoucherResource');
Route::get('/admin/voucher/view/{id}', 'Resource\VoucherResource@pdfview');
Route::get('/admin/voucher/download/{id}', 'Resource\VoucherResource@downloadpdf');
Route::post('/admin/voucher/send', 'Resource\VoucherResource@sendVoucher'); 

Route::resource('/operator/leads', 'Resource\OptLeadResource');
Route::get('/operator/lead/followup/{id}','Resource\OptLeadResource@followUp');
Route::post('/operator/lead/followupaction','Resource\OptLeadResource@followUpAction');
Route::get('/checktodayfollowup','Resource\OptLeadResource@checkTodayFollowup');
Route::post('/operator/leadclose', 'Resource\OptLeadResource@closeLead'); 
Route::get('/operator/reopenclose/{id}', 'Resource\OptLeadResource@reopenLead'); 

Route::resource('/operator/quotation', 'Resource\OptQuotationResource');
Route::resource('/operator/sales', 'Resource\OptSaleResource');
Route::get('/operator/contactfollowup/mobileview', 'Resource\OptContactFollowupResource@mobileView');
Route::resource('/operator/contactfollowup', 'Resource\OptContactFollowupResource');
Route::resource('/operator/ophotel', 'Resource\HotelResourceOperator');  

Route::resource('/vender/venders', 'Resource\VenderVenderResource');
Route::resource('/vender/hotels', 'Resource\VenderHotelResource');
Route::resource('/vender/hotelseasonrates', 'Resource\VenderHotelSeasonRateResource');
Route::resource('/vender/hotelgroupseasonrates', 'Resource\VenderHotelGroupSeasonRateResource');
Route::resource('/vender/cars', 'Resource\VenderCarResource');
Route::resource('/vender/transports', 'Resource\VenderTransportResource');
Route::resource('/vender/amenities', 'Resource\VenderAmenityResource');
Route::resource('/vender/activitycats', 'Resource\VenderActivityCatResource');
Route::resource('/vender/activitynames', 'Resource\VenderActivityNameResource');
Route::resource('/vender/activitysubcats', 'Resource\VenderActivitySubCatResource');
Route::resource('/vender/activities', 'Resource\VenderActivityResource');



// Vender

Route::get('/vender', 'VenderController@index');

Route::get('/vender/login', 'VenderController@index');

Route::post('/vender/login/action', 'VenderController@venderLogin');

Route::get('/vender/logout', 'VenderController@logout');

Route::get('/vender/dashboard', 'VenderController@dashboard');

Route::get('/vender/addhotel', 'VenderController@addHotel');

Route::get('/vender/allhotels', 'VenderController@hotelList');

Route::get('/vender/makeitinerary', 'VenderController@makeItinerary');

Route::get('/vender/makeitinerarynew', 'VenderController@makeItineraryNew');
Route::get('/vender/makeitinerarynewm', 'VenderController@makeItineraryNewM');

Route::get('/vender/printitinerary/{id}', 'VenderController@printItinerary');

Route::get('/vender/viewhotel/{id}', 'VenderController@viewHotel');

 
Route::get('/operator/unsuscribe/{id}', 'CommanController@unsuscribeUser'); 



// Operartor
Route::get('/operator', 'OperatorController@index');
Route::get('/operator/sendfollowupreport', 'Resource\OptLeadResource@sendFollowUpReport');
Route::get('/sendtodaysalereport', 'Resource\OptLeadResource@sendTodaySaleReport');
Route::get('/sendtodayfullsalenotify/{id}', 'Resource\OptLeadResource@sendTodayFullSaleNotify');
Route::get('/operator/bulkemail', 'OperatorController@bulkEmailSend');
Route::get('/operator/bulkemailreport', 'OperatorController@bulkEmailReport');
Route::post('/operator/bulkemailaction', 'OperatorController@sendBulkEmailAction');  
Route::get('/operator/bulkemailactiontesting', 'OperatorController@sendBulkEmailActionTesting');  
Route::get('/operator/login', 'OperatorController@index');
Route::post('/operator/login/action', 'OperatorController@operatorLogin');
Route::get('/operator/autologin', 'OperatorController@operatorAutoLogin');
Route::get('/operator/autologinpayment', 'OperatorController@operatorAutoLoginPay');
Route::get('/operator/logout', 'OperatorController@logout');
Route::get('/operator/dashboard', 'OperatorController@dashboard');
Route::post('/operator/dashboard/save', 'OperatorController@ChangeStatus');
Route::get('/operator/pastcontactfollowup', 'OperatorController@pastContactFollowup');




// For Mobile
Route::get('/operator/pastcontactfollowup/mobileview', 'OperatorController@pastContactFollowupMobile');

Route::get('/operator/todaycontactfollowup', 'OperatorController@todayContactFollowup');

// For Mobile
Route::get('/operator/todaycontactfollowup/mobileview', 'OperatorController@todayContactFollowupMobile');

Route::get('/operator/emailhistory', 'OperatorController@getAllEmails');
Route::get('/operator/sendquotationhistory', 'OperatorController@getAllSendQuotation');

Route::get('/operator/futurecontactfollowup', 'OperatorController@futureContactFollowup');

// For Mobile
Route::get('/operator/futurecontactfollowup/mobileview', 'OperatorController@futureContactFollowupMobile');

Route::get('/operator/mycontact', 'OperatorController@myContact');
Route::get('/operator/mycontacthistory', 'OperatorController@myContactHistory');
Route::get('/operator/mycontactfavoritehistory', 'OperatorController@myContactFavoriteHistory');
Route::get('/operator/allcontacts', 'OperatorController@allContacts');
Route::get('/operator/assigncontacts', 'OperatorController@assignContacts');
Route::get('/operator/sendemail/{id}', 'OperatorController@sendEmail');
Route::get('/operator/gettemplate/{id}', 'OperatorController@getTemplate');
Route::post('/operator/smtpsendemail', 'OperatorController@smtpSendEmail');
Route::post('/operator/generatetemplate', 'SMTPMail@generateTemplate');
//Route::post('/operator/leadclose', 'Resource\leadResource@closeLead'); 

Route::get('/operator/viewhotel/{id}', 'OperatorController@viewHotel'); 

Route::get('/operator/makeitinerary', 'OperatorController@makeItinerary'); 
//Route::get('/operator/lead', 'OperatorController@getOperatorLeads'); 

Route::get('htmltopdfview',array('as'=>'htmltopdfview','uses'=>'ProductController@htmltopdfview'));
Route::get('pdfview',array('as'=>'pdfview','uses'=>'ProductController@pdfview'));
Route::post('sendpdf', 'ProductController@sendPdf');


// Itinerary Make
Route::post('operator/ajaxitibasicinfo', 'AjaxController@itiBasicInfo'); 
Route::post('operator/addTransport', 'AjaxController@itiAddTransport'); 
Route::post('operator/getRoutes', 'AjaxController@itiGetRoutes'); 
Route::post('operator/getRoutesDetail', 'AjaxController@itiGetRoutesDetails'); 
Route::post('operator/getRoutesCities', 'AjaxController@getRouteCity'); 
Route::post('operator/getallRoutesCities', 'AjaxController@getAllRouteCity'); 
Route::post('operator/getHotelById', 'AjaxController@getHotelsByCityId');
//Route::post('operator/getRoomTypeById', 'AjaxController@getHotelRoomTypeByIdITI');
Route::post('operator/ajaxgetHotelRate', 'AjaxController@GetHotelSeasonRate');
Route::post('operator/getactivitybycity', 'AjaxController@getActivitiesByCity');
Route::post('operator/getactivityprice', 'AjaxController@getActivityPrice');
Route::post('operator/addActivities', 'AjaxController@addActivities');
Route::get('operator/verifyUser', 'AjaxController@verifyUser');
Route::get('operator/makeitineraryv1/{id}', 'ItineraryController@makeItineraryv1');

Route::get('operator/itinerary/view/{id}', 'ItineraryController@itineraryView'); 
Route::get('operator/itinerary/download/{id}', 'ItineraryController@downloadItinerary'); 


Route::get('/admin/itinerary/view/{id}', 'ItineraryController@pdfview');
Route::get('/admin/itinerary/download/{id}', 'ItineraryController@downloadpdf');
Route::post('/admin/itinerary/send', 'ItineraryController@sendVoucher'); 

 
// Make Quotation 
Route::get('operator/makequotation/', 'ItineraryController@makeQuotation');
Route::get('operator/makequotation/{id}', 'ItineraryController@getQuotation');
Route::post('operator/generatequotation/', 'ItineraryController@generateSendQuotation');
Route::get('operator/downloadquotation/{id}', 'ItineraryController@downloadSendQuotation');
Route::post('operator/updatequotationrate/', 'ItineraryController@updateQuotationRate');
Route::post('operator/sendquotation/', 'ItineraryController@sendQuotation'); 
Route::post('operator/updatefinalcost/', 'ItineraryController@updateFinalCost');
Route::post('operator/checkhotelpriceavailable/', 'ItineraryController@checkHotelPriceAvailableOrNot');
Route::post('operator/getRoomTypeById', 'ItineraryController@getHotelRoomTypeByIdITI');
Route::post('operator/gethotelnamebyid', 'ItineraryController@getHotelNameById');
Route::post('operator/gethoteldetailview', 'ItineraryController@getHotelDetailById');
Route::post('operator/checkrateavailable', 'ItineraryController@checkSeasonHotelRateAvailable');

// Payment History
Route::post('operator/addpayment/', 'ItineraryController@addPayment');
Route::get('operator/paymenthistory/', 'ItineraryController@addPaymentView');
Route::get('paymentapproval/{id}', 'ItineraryController@approvePaymentView');
Route::post('paymentapprovalaction', 'ItineraryController@approvePaymentAction');
Route::post('operator/checkquotationisclosed', 'ItineraryController@checkQuotationIsClosed');
Route::get('deletepayment/{id}', 'ItineraryController@deletePayment');

// Website Order
Route::get('operator/websiteorders/', 'OperatorController@getAllOrders');
Route::post('operator/cencelorders', 'OperatorController@cancelOrders');

// Accounting Managment for Orders
Route::get('operator/setcheckin/', 'OperatorController@setCheckinStatus');
Route::get('operator/setcheckout/', 'OperatorController@setCheckoutStatus');
Route::get('operator/getcheckinorder/', 'OperatorController@getCheckinOrders');
Route::get('operator/getcheckoutorder/', 'OperatorController@getCheckoutOrders');
Route::get('operator/getclosedorder/', 'OperatorController@getClosedOrders');
Route::get('operator/sendcheckinordertohotel/', 'OperatorController@sendCheckinOrdersToHotel');
Route::get('operator/sendcheckoutordertohotel/', 'OperatorController@sendCheckoutOrdersToHotel');
Route::get('operator/sendunclosedordertohotel/', 'OperatorController@sendUnclosedOrdersToHotel');
Route::get('operator/acceptorder/{id}', 'OperatorController@acceptHotelSideOrders');
Route::get('operator/acceptorderfromowner/{id}', 'OperatorController@acceptOwnerSideOrders');
Route::post('operator/closedstatus', 'OperatorController@setClosedStatus');
Route::get('operator/closedstatusallorders', 'OperatorController@checkAndClosedStatus');
// Hotel wise
Route::get('operator/getcheckinhotelorder/', 'OperatorController@getCheckinHotelOrders');
Route::get('operator/getcheckouthotelorder/', 'OperatorController@getCheckoutHotelOrders');
Route::get('operator/getclosedhotelorder/', 'OperatorController@getClosedHotelOrders');

// Make Activity Voucher
Route::get('operator/makeactivityvoucher/', 'ItineraryController@makeActivityVoucher');
Route::post('operator/getactivitybycity', 'AjaxController@getActivityByCityId');
Route::post('operator/gettimebyslot', 'AjaxController@getTimeBySlot');
Route::post('operator/generateactivityvoucher', 'ItineraryController@generateActivityVoucher');
Route::get('operator/downloadactivityvoucher/{id}', 'ItineraryController@downloadActivityVoucher');
Route::get('operator/makeactivityvoucher/{id}', 'ItineraryController@getActivityVoucher'); 
Route::get('operator/getallactivityvouchers', 'ItineraryController@getAllActivityVouchers'); 
Route::get('operator/sendactivityvoucherreport', 'ItineraryController@sendActivityVoucherReport'); 

// Rooms Current Status
Route::get('operator/roomsstatus/', 'ItineraryController@roomsCurrentStatus');
Route::get('operator/addroombook/', 'ItineraryController@addRoomBooking');

// View only room available by date
Route::get('operator/room-available/', 'ItineraryController@roomsAvailable');
Route::post('operator/get-room-available/', 'ItineraryController@getRoomAvailable');


Route::post('operator/addroombookaction/', 'ItineraryController@addRoomBookedAction');
Route::post('operator/updateroombookaction/', 'ItineraryController@updateRoomBookedAction');
Route::post('operator/uploadimage/', 'ItineraryController@uploadImageQuotation');
Route::post('operator/getroomstatus/', 'ItineraryController@getRoomBookedStatus');
Route::post('operator/getroombookdetails/', 'ItineraryController@getRoomBookedDetailsPop');
Route::post('operator/checkroomavailibility/', 'ItineraryController@checkRoomAvailablity');
Route::post('operator/getpaymentsource/', 'ItineraryController@getPaymentSourcesByHotelId');
Route::get('/operator/roominventorydashboard', 'OperatorController@roomInventorydashboard');
Route::get('/operator/roominventorydashboardonline', 'OperatorController@roomInventorydashboard');
Route::get('/operator/roominventorydashboardoffline', 'OperatorController@roomInventorydashboard');
Route::post('/operator/roominventorydashboarddata', 'ItineraryController@roomInventoryDashboardData');
Route::post('/operator/roominventorydashboarddataonline', 'ItineraryController@roomInventoryDashboardDataOnline');
Route::post('/operator/roominventorydashboarddataoffline', 'ItineraryController@roomInventoryDashboardDataOffline');
Route::get('/operator/allbookings', 'ItineraryController@getAllBooking');
Route::get('/operator/bookings/delete/{id}', 'ItineraryController@deleteBooking');

// Delete The quotation with related data
Route::get('delete-quotation', 'Controller@deleteQuotationWithAllRelatedData');

// clear cache
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');   
    return "<h1 style='text-align: center;'>Cache cleared successfully !</h1>";
});

// Direct login by Campany Admin in Admin dashboard
Route::post('/login-bycadmin-{id}', 'AdminController@bycadmin');

//  grievance by admin or operator
Route::get('/grievance', 'Resource\grievanceController@index');
Route::post('/grievance/store', 'Resource\grievanceController@store');
// Route::get('/grievance', 'Resource\grievanceController@index');
// Route::get('/grievance/thanks', 'Resource\grievanceController@thanks');

// Admin Booking Source & From Master
Route::resource('/admin/booking_from', 'Resource\BookingFromController');
Route::resource('/admin/booking_source', 'Resource\BookingSourceController');

//  menus search by admin or operator
Route::get('/menusearch', 'Resource\menuSearchController@search');

// File menu manager for admin
Route::get('/admin/filemenu_manager', 'Resource\FileMenuManagerController@admin');

// File menu manager for operator
Route::get('/operator/filemenu_manager', 'Resource\FileMenuManagerController@operator');

// Create Voucher
Route::get('operator/createvoucher/', 'CreateVoucherController@createvoucher');
Route::get('operator/createvoucher/{id}', 'CreateVoucherController@getVoucher');
Route::post('operator/generatevoucher', 'CreateVoucherController@generateVoucher');
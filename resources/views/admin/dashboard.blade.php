@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
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
@endsection

@section('content')
<!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="col s12">
          <div class="container">
            <aside id="right-sidebar-nav">
               <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
                  <div class="row">
                     <div class="slide-out-right-title">
                        <div class="col s12 border-bottom-1 pb-0 pt-1">
                           <div class="row">
                              <div class="col s2 pr-0 center">
                                 <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>
                              </div>
                              <div class="col s10 pl-0">
                                 <ul class="tabs">
                                    <li class="tab col s4 p-0">
                                       <a href="#messages" class="active">
                                          <span>Messages</span>
                                       </a>
                                    </li>
                                    <li class="tab col s4 p-0">
                                       <a href="#settings">
                                          <span>Settings</span>
                                       </a>
                                    </li>
                                    <li class="tab col s4 p-0">
                                       <a href="#activity">
                                          <span>Activity</span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="slide-out-right-body">
                        <div id="messages" class="col s12">
                           <div class="collection border-none">
                              <input class="header-search-input mt-4 mb-2" type="text" name="Search" placeholder="Search Messages" />
                              <ul class="collection p-0">
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-7.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Elizabeth Elliott</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
                                    </div>
                                    <span class="secondary-content medium-small">5.00 AM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-1.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Mary Adams</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
                                    </div>
                                    <span class="secondary-content medium-small">4.14 AM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-2.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Caleb Richards</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
                                    </div>
                                    <span class="secondary-content medium-small">4.14 AM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-3.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Caleb Richards</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Keny !</p>
                                    </div>
                                    <span class="secondary-content medium-small">9.00 PM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-4.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">June Lane</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Ohh God</p>
                                    </div>
                                    <span class="secondary-content medium-small">4.14 AM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-5.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Edward Fletcher</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Love you</p>
                                    </div>
                                    <span class="secondary-content medium-small">5.15 PM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-6.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Crystal Bates</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can we</p>
                                    </div>
                                    <span class="secondary-content medium-small">8.00 AM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-7.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Nathan Watts</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Great!</p>
                                    </div>
                                    <span class="secondary-content medium-small">9.53 PM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-8.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Willard Wood</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Do it</p>
                                    </div>
                                    <span class="secondary-content medium-small">4.20 AM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-1.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Ronnie Ellis</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Got that</p>
                                    </div>
                                    <span class="secondary-content medium-small">5.20 AM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-9.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Daniel Russell</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
                                    </div>
                                    <span class="secondary-content medium-small">12.00 AM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-10.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Sarah Graves</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Okay you</p>
                                    </div>
                                    <span class="secondary-content medium-small">11.14 PM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-off avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-11.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Andrew Hoffman</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can do</p>
                                    </div>
                                    <span class="secondary-content medium-small">7.30 PM</span>
                                 </li>
                                 <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                                    <span class="avatar-status avatar-online avatar-50"
                                       ><img src="{{ URL::asset('asset/images/avatar/avatar-12.png') }}" alt="avatar" />
                                       <i></i>
                                    </span>
                                    <div class="user-content">
                                       <h6 class="line-height-0">Camila Lynch</h6>
                                       <p class="medium-small blue-grey-text text-lighten-3 pt-3">Leave it</p>
                                    </div>
                                    <span class="secondary-content medium-small">2.00 PM</span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div id="settings" class="col s12">
                           <p class="mt-8 mb-0 ml-5 font-weight-900">GENERAL SETTINGS</p>
                           <ul class="collection border-none">
                              <li class="collection-item border-none mt-3">
                                 <div class="m-0">
                                    <span>Notifications</span>
                                    <div class="switch right">
                                       <label>
                                          <input checked type="checkbox" />
                                          <span class="lever"></span>
                                       </label>
                                    </div>
                                 </div>
                              </li>
                              <li class="collection-item border-none mt-3">
                                 <div class="m-0">
                                    <span>Show recent activity</span>
                                    <div class="switch right">
                                       <label>
                                          <input type="checkbox" />
                                          <span class="lever"></span>
                                       </label>
                                    </div>
                                 </div>
                              </li>
                              <li class="collection-item border-none mt-3">
                                 <div class="m-0">
                                    <span>Show recent activity</span>
                                    <div class="switch right">
                                       <label>
                                          <input type="checkbox" />
                                          <span class="lever"></span>
                                       </label>
                                    </div>
                                 </div>
                              </li>
                              <li class="collection-item border-none mt-3">
                                 <div class="m-0">
                                    <span>Show Task statistics</span>
                                    <div class="switch right">
                                       <label>
                                          <input type="checkbox" />
                                          <span class="lever"></span>
                                       </label>
                                    </div>
                                 </div>
                              </li>
                              <li class="collection-item border-none mt-3">
                                 <div class="m-0">
                                    <span>Show your emails</span>
                                    <div class="switch right">
                                       <label>
                                          <input type="checkbox" />
                                          <span class="lever"></span>
                                       </label>
                                    </div>
                                 </div>
                              </li>
                              <li class="collection-item border-none mt-3">
                                 <div class="m-0">
                                    <span>Email Notifications</span>
                                    <div class="switch right">
                                       <label>
                                          <input checked type="checkbox" />
                                          <span class="lever"></span>
                                       </label>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                           <p class="mt-8 mb-0 ml-5 font-weight-900">SYSTEM SETTINGS</p>
                           <ul class="collection border-none">
                              <li class="collection-item border-none mt-3">
                                 <div class="m-0">
                                    <span>System Logs</span>
                                    <div class="switch right">
                                       <label>
                                          <input type="checkbox" />
                                          <span class="lever"></span>
                                       </label>
                                    </div>
                                 </div>
                              </li>
                              <li class="collection-item border-none mt-3">
                                 <div class="m-0">
                                    <span>Error Reporting</span>
                                    <div class="switch right">
                                       <label>
                                          <input type="checkbox" />
                                          <span class="lever"></span>
                                       </label>
                                    </div>
                                 </div>
                              </li>
                              <li class="collection-item border-none mt-3">
                                 <div class="m-0">
                                    <span>Applications Logs</span>
                                    <div class="switch right">
                                       <label>
                                          <input checked type="checkbox" />
                                          <span class="lever"></span>
                                       </label>
                                    </div>
                                 </div>
                              </li>
                              <li class="collection-item border-none mt-3">
                                 <div class="m-0">
                                    <span>Backup Servers</span>
                                    <div class="switch right">
                                       <label>
                                          <input type="checkbox" />
                                          <span class="lever"></span>
                                       </label>
                                    </div>
                                 </div>
                              </li>
                              <li class="collection-item border-none mt-3">
                                 <div class="m-0">
                                    <span>Audit Logs</span>
                                    <div class="switch right">
                                       <label>
                                          <input type="checkbox" />
                                          <span class="lever"></span>
                                       </label>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                        <div id="activity" class="col s12">
                           <div class="activity">
                              <p class="mt-5 mb-0 ml-5 font-weight-900">SYSTEM LOGS</p>
                              <ul class="collection with-header">
                                 <li class="collection-item">
                                    <div class="font-weight-900">
                                       Homepage mockup design <span class="secondary-content">Just now</span>
                                    </div>
                                    <p class="mt-0 mb-2">Melissa liked your activity.</p>
                                    <span class="new badge amber" data-badge-caption="Important"> </span>
                                 </li>
                                 <li class="collection-item">
                                    <div class="font-weight-900">
                                       Melissa liked your activity Drinks. <span class="secondary-content">10 mins</span>
                                    </div>
                                    <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                                    <span class="new badge light-green" data-badge-caption="Resolved"></span>
                                 </li>
                                 <li class="collection-item">
                                    <div class="font-weight-900">
                                       12 new users registered <span class="secondary-content">30 mins</span>
                                    </div>
                                    <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                                 </li>
                                 <li class="collection-item">
                                    <div class="font-weight-900">
                                       Tina is attending your activity <span class="secondary-content">2 hrs</span>
                                    </div>
                                    <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                                 </li>
                                 <li class="collection-item">
                                    <div class="font-weight-900">
                                       Josh is now following you <span class="secondary-content">5 hrs</span>
                                    </div>
                                    <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                                    <span class="new badge red" data-badge-caption="Pending"></span>
                                 </li>
                              </ul>
                              <p class="mt-5 mb-0 ml-5 font-weight-900">APPLICATIONS LOGS</p>
                              <ul class="collection with-header">
                                 <li class="collection-item">
                                    <div class="font-weight-900">
                                       New order received urgent <span class="secondary-content">Just now</span>
                                    </div>
                                    <p class="mt-0 mb-2">Melissa liked your activity.</p>
                                 </li>
                                 <li class="collection-item">
                                    <div class="font-weight-900">System shutdown. <span class="secondary-content">5 min</span></div>
                                    <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                                    <span class="new badge blue" data-badge-caption="Urgent"> </span>
                                 </li>
                                 <li class="collection-item">
                                    <div class="font-weight-900">
                                       Database overloaded 89% <span class="secondary-content">20 min</span>
                                    </div>
                                    <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                                 </li>
                              </ul>
                              <p class="mt-5 mb-0 ml-5 font-weight-900">SERVER LOGS</p>
                              <ul class="collection with-header">
                                 <li class="collection-item">
                                    <div class="font-weight-900">System error <span class="secondary-content">10 min</span></div>
                                    <p class="mt-0 mb-2">Melissa liked your activity.</p>
                                 </li>
                                 <li class="collection-item">
                                    <div class="font-weight-900">
                                       Production server down. <span class="secondary-content">1 hrs</span>
                                    </div>
                                    <p class="mt-0 mb-2">Here are some news feed interactions concepts.</p>
                                    <span class="new badge blue" data-badge-caption="Urgent"></span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- Slide Out Chat -->
               <ul id="slide-out-chat" class="sidenav slide-out-right-sidenav-chat">
                  <li class="center-align pt-2 pb-2 sidenav-close chat-head">
                     <a href="#!"><i class="material-icons mr-0">chevron_left</i>Elizabeth Elliott</a>
                  </li>
                  <li class="chat-body">
                     <ul class="collection">
                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                           <span class="avatar-status avatar-online avatar-50"
                              ><img src="{{ URL::asset('asset/images/avatar/avatar-7.png') }}" alt="avatar" />
                           </span>
                           <div class="user-content speech-bubble">
                              <p class="medium-small">hello!</p>
                           </div>
                        </li>
                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                           <div class="user-content speech-bubble-right">
                              <p class="medium-small">How can we help? We're here for you!</p>
                           </div>
                        </li>
                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                           <span class="avatar-status avatar-online avatar-50"
                              ><img src="{{ URL::asset('asset/images/avatar/avatar-7.png') }}" alt="avatar" />
                           </span>
                           <div class="user-content speech-bubble">
                              <p class="medium-small">I am looking for the best admin template.?</p>
                           </div>
                        </li>
                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                           <div class="user-content speech-bubble-right">
                              <p class="medium-small">Materialize admin is the responsive materializecss admin template.</p>
                           </div>
                        </li>

                        <li class="collection-item display-grid width-100 center-align">
                           <p>8:20 a.m.</p>
                        </li>

                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                           <span class="avatar-status avatar-online avatar-50"
                              ><img src="{{ URL::asset('asset/images/avatar/avatar-7.png') }}" alt="avatar" />
                           </span>
                           <div class="user-content speech-bubble">
                              <p class="medium-small">Ohh! very nice</p>
                           </div>
                        </li>
                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                           <div class="user-content speech-bubble-right">
                              <p class="medium-small">Thank you.</p>
                           </div>
                        </li>
                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                           <span class="avatar-status avatar-online avatar-50"
                              ><img src="{{ URL::asset('asset/images/avatar/avatar-7.png') }}" alt="avatar" />
                           </span>
                           <div class="user-content speech-bubble">
                              <p class="medium-small">How can I purchase it?</p>
                           </div>
                        </li>

                        <li class="collection-item display-grid width-100 center-align">
                           <p>9:00 a.m.</p>
                        </li>

                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                           <div class="user-content speech-bubble-right">
                              <p class="medium-small">From ThemeForest.</p>
                           </div>
                        </li>
                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                           <div class="user-content speech-bubble-right">
                              <p class="medium-small">Only $24</p>
                           </div>
                        </li>
                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                           <span class="avatar-status avatar-online avatar-50"
                              ><img src="{{ URL::asset('asset/images/avatar/avatar-7.png') }}" alt="avatar" />
                           </span>
                           <div class="user-content speech-bubble">
                              <p class="medium-small">Ohh! Thank you.</p>
                           </div>
                        </li>
                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                           <span class="avatar-status avatar-online avatar-50"
                              ><img src="{{ URL::asset('asset/images/avatar/avatar-7.png') }}" alt="avatar" />
                           </span>
                           <div class="user-content speech-bubble">
                              <p class="medium-small">I will purchase it for sure.</p>
                           </div>
                        </li>
                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                           <div class="user-content speech-bubble-right">
                              <p class="medium-small">Great, Feel free to get in touch on</p>
                           </div>
                        </li>
                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
                           <div class="user-content speech-bubble-right">
                              <p class="medium-small">link</p>
                           </div>
                        </li>
                     </ul>
                  </li>
                  <li class="center-align chat-footer">
                     <form class="col s12" onsubmit="slide_out_chat()" action="javascript:void(0);">
                        <div class="input-field">
                           <input id="icon_prefix" type="text" class="search" />
                           <label for="icon_prefix">Type here..</label>
                           <a onclick="slide_out_chat()"><i class="material-icons prefix">send</i></a>
                        </div>
                     </form>
                  </li>
               </ul>
            </aside>
<!-- END RIGHT SIDEBAR NAV -->
         {{--
            <div class="row" style="margin-right: 0px;margin-left: 0px;">
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
                                 <div class="table-responsive table_head" style="height: 240px;overflow-y: scroll;">
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
            </div>
          </div>--}}
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
	<script src="{{ URL::asset('asset/vendors/chartjs/chart.min.js') }}"></script>
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
            url: '/admin/dashboard/save',
            data: {'flag':flag,'id':id},
            dataType: "json",
            success: function(response) {
               
               if (response.status == 1) {
                  jQuery('#po_search_loader'+id).hide();
                  var tableHTML='';
                  if(response.data == 'Y'){
                     tableHTML+='<span onclick="return changeStatus('+id+')" name="action" class="td_status" >ACTIVE</span>';
                  }else{
                     tableHTML+='<span onclick="return changeStatus('+id+')" name="action" class="td_status_inactive" >INACTIVE</span>';
                  }
                  jQuery('#show_act_'+id).html(tableHTML);
                  // refresh();show_act_
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
@endsection
@extends('admin.template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
	
@endsection

@section('content')
<!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="col s12">
          <div class="container">
            <!-- card stats start 
<div id="card-stats">
   <div class="row">
      <div class="col s12 m6 l3">
         <div class="card animate fadeLeft">
            <div class="card-content cyan white-text">
               <p class="card-stats-title"><i class="material-icons">person_outline</i> New Clients</p>
               <h4 class="card-stats-number white-text">566</h4>
               <p class="card-stats-compare">
                  <i class="material-icons">keyboard_arrow_up</i> 15%
                  <span class="cyan text text-lighten-5">from yesterday</span>
               </p>
            </div>
            <div class="card-action cyan darken-1">
               <div id="clients-bar" class="center-align"></div>
            </div>
         </div>
      </div>
      <div class="col s12 m6 l3">
         <div class="card animate fadeLeft">
            <div class="card-content red accent-2 white-text">
               <p class="card-stats-title"><i class="material-icons">attach_money</i>Total Sales</p>
               <h4 class="card-stats-number white-text">$8990.63</h4>
               <p class="card-stats-compare">
                  <i class="material-icons">keyboard_arrow_up</i> 70% <span class="red-text text-lighten-5">last month</span>
               </p>
            </div>
            <div class="card-action red">
               <div id="sales-compositebar" class="center-align"></div>
            </div>
         </div>
      </div>
      <div class="col s12 m6 l3">
         <div class="card animate fadeRight">
            <div class="card-content orange lighten-1 white-text">
               <p class="card-stats-title"><i class="material-icons">trending_up</i> Today Profit</p>
               <h4 class="card-stats-number white-text">$806.52</h4>
               <p class="card-stats-compare">
                  <i class="material-icons">keyboard_arrow_up</i> 80%
                  <span class="orange-text text-lighten-5">from yesterday</span>
               </p>
            </div>
            <div class="card-action orange">
               <div id="profit-tristate" class="center-align"></div>
            </div>
         </div>
      </div>
      <div class="col s12 m6 l3">
         <div class="card animate fadeRight">
            <div class="card-content green lighten-1 white-text">
               <p class="card-stats-title"><i class="material-icons">content_copy</i> New Invoice</p>
               <h4 class="card-stats-number white-text">1806</h4>
               <p class="card-stats-compare">
                  <i class="material-icons">keyboard_arrow_down</i> 3%
                  <span class="green-text text-lighten-5">from last month</span>
               </p>
            </div>
            <div class="card-action green">
               <div id="invoice-line" class="center-align"></div>
            </div>
         </div>
      </div>
   </div>
</div>
card stats end-->
<!--chart dashboard start
<div id="chart-dashboard">
   <div class="row">
      <div class="col s12 m8 l8">
         <div class="card animate fadeUp">
            <div class="card-move-up waves-effect waves-block waves-light">
               <div class="move-up cyan darken-1">
                  <div>
                     <span class="chart-title white-text">Revenue</span>
                     <div class="chart-revenue cyan darken-2 white-text">
                        <p class="chart-revenue-total">$4,500.85</p>
                        <p class="chart-revenue-per"><i class="material-icons">arrow_drop_up</i> 21.80 %</p>
                     </div>
                     <div class="switch chart-revenue-switch right">
                        <label class="cyan-text text-lighten-5">
                           Month <input type="checkbox" /> <span class="lever"></span> Year
                        </label>
                     </div>
                  </div>
                  <div class="trending-line-chart-wrapper"><canvas id="revenue-line-chart" height="70"></canvas></div>
               </div>
            </div>
            <div class="card-content">
               <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                  <i class="material-icons activator">filter_list</i>
               </a>
               <div class="col s12 m3 l3">
                  <div id="doughnut-chart-wrapper">
                     <canvas id="doughnut-chart" height="200"></canvas>
                     <div class="doughnut-chart-status">
                        <p class="center-align font-weight-600 mt-4">4500</p>
                        <p class="ultra-small center-align">Sold</p>
                     </div>
                  </div>
               </div>
               <div class="col s12 m2 l2">
                  <ul class="doughnut-chart-legend">
                     <li class="mobile ultra-small"><span class="legend-color"></span>Mobile</li>
                     <li class="kitchen ultra-small"><span class="legend-color"></span> Kitchen</li>
                     <li class="home ultra-small"><span class="legend-color"></span> Home</li>
                  </ul>
               </div>
               <div class="col s12 m5 l6">
                  <div class="trending-bar-chart-wrapper"><canvas id="trending-bar-chart" height="90"></canvas></div>
               </div>
            </div>
            <div class="card-reveal">
               <span class="card-title grey-text text-darken-4">Revenue by Month <i class="material-icons right">close</i>
               </span>
               <table class="responsive-table">
                  <thead>
                     <tr>
                        <th data-field="id">ID</th>
                        <th data-field="month">Month</th>
                        <th data-field="item-sold">Item Sold</th>
                        <th data-field="item-price">Item Price</th>
                        <th data-field="total-profit">Total Profit</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td>January</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                     <tr>
                        <td>2</td>
                        <td>February</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                     <tr>
                        <td>3</td>
                        <td>March</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                     <tr>
                        <td>4</td>
                        <td>April</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                     <tr>
                        <td>5</td>
                        <td>May</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                     <tr>
                        <td>6</td>
                        <td>June</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                     <tr>
                        <td>7</td>
                        <td>July</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                     <tr>
                        <td>8</td>
                        <td>August</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                     <tr>
                        <td>9</td>
                        <td>Septmber</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                     <tr>
                        <td>10</td>
                        <td>Octomber</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                     <tr>
                        <td>11</td>
                        <td>November</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                     <tr>
                        <td>12</td>
                        <td>December</td>
                        <td>122</td>
                        <td>100</td>
                        <td>$122,00.00</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="col s12 m4 l4">
         <div class="card animate fadeUp">
            <div class="card-move-up teal accent-4 waves-effect waves-block waves-light">
               <div class="move-up">
                  <p class="margin white-text">Browser Stats</p>
                  <canvas id="trending-radar-chart" height="114"></canvas>
               </div>
            </div>
            <div class="card-content  teal">
               <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                  <i class="material-icons activator">done</i>
               </a>
               <div class="line-chart-wrapper">
                  <p class="margin white-text">Revenue by country</p>
                  <canvas id="line-chart" height="114"></canvas>
               </div>
            </div>
            <div class="card-reveal">
               <span class="card-title grey-text text-darken-4">Revenue by country <i class="material-icons right">close</i>
               </span>
               <table class="responsive-table">
                  <thead>
                     <tr>
                        <th data-field="country-name">Country Name</th>
                        <th data-field="item-sold">Item Sold</th>
                        <th data-field="total-profit">Total Profit</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>USA</td>
                        <td>65</td>
                        <td>$452.55</td>
                     </tr>
                     <tr>
                        <td>UK</td>
                        <td>76</td>
                        <td>$452.55</td>
                     </tr>
                     <tr>
                        <td>Canada</td>
                        <td>65</td>
                        <td>$452.55</td>
                     </tr>
                     <tr>
                        <td>Brazil</td>
                        <td>76</td>
                        <td>$452.55</td>
                     </tr>
                     <tr>
                        <td>India</td>
                        <td>65</td>
                        <td>$452.55</td>
                     </tr>
                     <tr>
                        <td>France</td>
                        <td>76</td>
                        <td>$452.55</td>
                     </tr>
                     <tr>
                        <td>Austrelia</td>
                        <td>65</td>
                        <td>$452.55</td>
                     </tr>
                     <tr>
                        <td>Russia</td>
                        <td>76</td>
                        <td>$452.55</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
chart dashboard end-->

<!--work collections start
<div id="work-collections">
   <div class="row">
      <div class="col s12 m12 l6">
         <ul id="projects-collection" class="collection z-depth-1 animate fadeLeft">
            <li class="collection-item avatar">
               <i class="material-icons cyan circle">card_travel</i>
               <h6 class="collection-header m-0">Projects</h6>
               <p>Your Favorites</p>
            </li>
            <li class="collection-item">
               <div class="row">
                  <div class="col s6">
                     <p class="collections-title">Web App</p>
                     <p class="collections-content">AEC Company</p>
                  </div>
                  <div class="col s3"><span class="task-cat cyan">Development</span></div>
                  <div class="col s3">
                     <div id="project-line-1"></div>
                  </div>
               </div>
            </li>
            <li class="collection-item">
               <div class="row">
                  <div class="col s6">
                     <p class="collections-title">Mobile App for Social</p>
                     <p class="collections-content">iSocial App</p>
                  </div>
                  <div class="col s3"><span class="task-cat red accent-2">UI/UX</span></div>
                  <div class="col s3">
                     <div id="project-line-2"></div>
                  </div>
               </div>
            </li>
            <li class="collection-item">
               <div class="row">
                  <div class="col s6">
                     <p class="collections-title">Website</p>
                     <p class="collections-content">MediTab</p>
                  </div>
                  <div class="col s3"><span class="task-cat teal accent-4">Marketing</span></div>
                  <div class="col s3">
                     <div id="project-line-3"></div>
                  </div>
               </div>
            </li>
            <li class="collection-item">
               <div class="row">
                  <div class="col s6">
                     <p class="collections-title">AdWord campaign</p>
                     <p class="collections-content">True Line</p>
                  </div>
                  <div class="col s3"><span class="task-cat deep-orange accent-2">SEO</span></div>
                  <div class="col s3">
                     <div id="project-line-4"></div>
                  </div>
               </div>
            </li>
         </ul>
      </div>
      <div class="col s12 m12 l6">
         <ul id="issues-collection" class="collection z-depth-1 animate fadeRight">
            <li class="collection-item avatar">
               <i class="material-icons red accent-2 circle">bug_report</i>
               <h6 class="collection-header m-0">Issues</h6>
               <p>Assigned to you</p>
            </li>
            <li class="collection-item">
               <div class="row">
                  <div class="col s7">
                     <p class="collections-title"><strong>#102</strong> Home Page</p>
                     <p class="collections-content">Web Project</p>
                  </div>
                  <div class="col s2"><span class="task-cat deep-orange accent-2">P1</span></div>
                  <div class="col s3">
                     <div class="progress">
                        <div class="determinate" style="width: 70%"></div>
                     </div>
                  </div>
               </div>
            </li>
            <li class="collection-item">
               <div class="row">
                  <div class="col s7">
                     <p class="collections-title"><strong>#108</strong> API Fix</p>
                     <p class="collections-content">API Project</p>
                  </div>
                  <div class="col s2"><span class="task-cat cyan">P2</span></div>
                  <div class="col s3">
                     <div class="progress">
                        <div class="determinate" style="width: 40%"></div>
                     </div>
                  </div>
               </div>
            </li>
            <li class="collection-item">
               <div class="row">
                  <div class="col s7">
                     <p class="collections-title"><strong>#205</strong> Profile page css</p>
                     <p class="collections-content">New Project</p>
                  </div>
                  <div class="col s2"><span class="task-cat red accent-2">P3</span></div>
                  <div class="col s3">
                     <div class="progress">
                        <div class="determinate" style="width: 95%"></div>
                     </div>
                  </div>
               </div>
            </li>
            <li class="collection-item">
               <div class="row">
                  <div class="col s7">
                     <p class="collections-title"><strong>#188</strong> SAP Changes</p>
                     <p class="collections-content">SAP Project</p>
                  </div>
                  <div class="col s2"><span class="task-cat teal accent-4">P1</span></div>
                  <div class="col s3">
                     <div class="progress">
                        <div class="determinate" style="width: 10%"></div>
                     </div>
                  </div>
               </div>
            </li>
         </ul>
      </div>
   </div>
</div>
work collections end-->

<!--card widgets start
<div id="card-widgets">
   <div class="row">
      <div class="col s12 m6 l4">
         <ul id="task-card" class="collection with-header animate fadeLeft">
            <li class="collection-header cyan">
               <h5 class="task-card-title mb-3">My Task</h5>
               <p class="task-card-date">Sept 16, 2019</p>
            </li>
            <li class="collection-item dismissable">
               <label for="task1">
                  <input type="checkbox" id="task1" /> <span class="width-100">Create Mobile App UI. </span>
                  <a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                  <span class="task-cat cyan">Mobile App</span>
               </label>
            </li>
            <li class="collection-item dismissable">
               <label for="task2">
                  <input type="checkbox" id="task2" /> <span class="width-100">Check the new API standerds. </span>
                  <a href="#" class="secondary-content"> <span class="ultra-small">Monday</span> </a>
                  <span class="task-cat red accent-2">Web API</span>
               </label>
            </li>
            <li class="collection-item dismissable">
               <label for="task3">
                  <input type="checkbox" id="task3" checked="checked" />
                  <span class="width-100"> Check the new Mockup of ABC.</span>
                  <a href="#" class="secondary-content"> <span class="ultra-small">Wednesday</span> </a>
                  <span class="task-cat teal accent-4">Mockup</span>
               </label>
            </li>
            <li class="collection-item dismissable">
               <label for="task4">
                  <input type="checkbox" id="task4" checked="checked" disabled="disabled" />
                  <span class="width-100">I did it ! </span>
                  <a href="#" class="secondary-content"> <span class="ultra-small">Sunday</span> </a>
                  <span class="task-cat deep-orange accent-2">Mobile App</span>
               </label>
            </li>
         </ul>
      </div>
      <div class="col s12 m6 l4">
         <div id="flight-card" class="card animate fadeUp">
            <div class="card-header deep-orange accent-2">
               <div class="card-title">
                  <h5 class="task-card-title mb-3 mt-0 white-text">Flight</h5>
                  <p class="flight-card-date">June 18, Thu 04:50</p>
               </div>
            </div>
            <div class="card-content-bg white-text">
               <div class="card-content">
                  <div class="row flight-state-wrapper">
                     <div class="col s5 m5 l5 center-align">
                        <div class="flight-state">
                           <h4 class="margin white-text">LDN</h4>
                           <p class="ultra-small">London</p>
                        </div>
                     </div>
                     <div class="col s2 m2 l2 center-align"><i class="material-icons flight-icon">local_airport</i></div>
                     <div class="col s5 m5 l5 center-align">
                        <div class="flight-state">
                           <h4 class="margin white-text">SFO</h4>
                           <p class="ultra-small">San Francisco</p>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col s6 m6 l6 center-align">
                        <div class="flight-info">
                           <p class="small"><span class="grey-text text-lighten-4">Depart:</span> 04.50</p>
                           <p class="small"><span class="grey-text text-lighten-4">Flight:</span> IB 5786</p>
                           <p class="small"><span class="grey-text text-lighten-4">Terminal:</span> B</p>
                        </div>
                     </div>
                     <div class="col s6 m6 l6 center-align flight-state-two">
                        <div class="flight-info">
                           <p class="small"><span class="grey-text text-lighten-4">Arrive:</span> 08.50</p>
                           <p class="small"><span class="grey-text text-lighten-4">Flight:</span> IB 5786</p>
                           <p class="small"><span class="grey-text text-lighten-4">Terminal:</span> C</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col s12 m12 l4">
         <div id="profile-card" class="card animate fadeRight">
            <div class="card-image waves-effect waves-block waves-light">
               <img class="activator" src="{{ URL::asset('asset/images/gallery/3.png') }}" alt="user bg" />
            </div>
            <div class="card-content">
               <img src="{{ URL::asset('asset/images/avatar/avatar-7.png') }}" alt="" class="circle responsive-img activator card-profile-image cyan lighten-1 padding-2" />
               <a class="btn-floating activator btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                  <i class="material-icons">edit</i>
               </a>
               <h5 class="card-title activator grey-text text-darken-4">Roger Waters</h5>
               <p><i class="material-icons profile-card-i">perm_identity</i> Project Manager</p>
               <p><i class="material-icons profile-card-i">perm_phone_msg</i> +1 (612) 222 8989</p>
               <p><i class="material-icons profile-card-i">email</i> yourmail@domain.com</p>
            </div>
            <div class="card-reveal">
               <span class="card-title grey-text text-darken-4">Roger Waters <i class="material-icons right">close</i>
               </span>
               <p>Here is some more information about this card.</p>
               <p><i class="material-icons">perm_identity</i> Project Manager</p>
               <p><i class="material-icons">perm_phone_msg</i> +1 (612) 222 8989</p>
               <p><i class="material-icons">email</i> yourmail@domain.com</p>
               <p><i class="material-icons">cake</i> 18th June 1990</p>
               <p></p>
               <p><i class="material-icons">airplanemode_active</i> BAR - AUS</p>
               <p></p>
            </div>
         </div>
      </div>
   </div>
</div>
card widgets end--><!-- START RIGHT SIDEBAR NAV -->
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

          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
@endsection

@section('scripts')
	<script src="{{ URL::asset('asset/vendors/chartjs/chart.min.js') }}"></script>
@endsection
<?php

namespace App\Providers;
use View;
use DB;
use URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\MenuMaster;
use App\ModuleMaster;
use App\CompanyPrivilage;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view)
        {
            $log_user = session()->get('admin');
            //dd($log_user);
            if($log_user !=''){
                if($log_user['login_type'][0] == 'A'){
                    $data=DB::table('sua_company_privileges')->where('company_id',$log_user['comp_id'][0])->where('menu_flag', 'Y')->pluck('menu_id')->toArray();
                    $access_menus=MenuMaster::where('status','ACTIVE')->where('login_type',$log_user['login_type'][0])->where('type','MENU')->whereNotIn('menu_flag',['N'])->orderBy('display_order')->get();
                }else if($log_user['login_type'][0] == 'O'){
                    $data=DB::table('opt_file_privilage')->where('company_id',$log_user['company_id'][0])->where('operator_id',$log_user['id'][0])->where('admin_id',$log_user['property_id'][0])->where('menu_flag', 'Y')->pluck('menu_id')->toArray();
                    $module_id=DB::table('sua_company_privileges')->where('company_id',$log_user['company_id'][0])->where('login_type','O')->orderby('module_id', 'ASC')->pluck('module_id')->toArray();
                    $access_menus=[];
                    foreach($module_id as $module_id){
                        $access_menus[$module_id]=MenuMaster::where('login_type','O')->whereIn('id',$data)->where('module',$module_id)->orderby('display_order', 'ASC')->get();
                    }
                }
                View::share(['access_menus'=>$access_menus]);
            }else{
                $access_menus=[];
                View::share(['access_menus'=>$access_menus]);
            }
            
        });
    }
}

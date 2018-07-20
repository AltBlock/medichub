<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use App\Models\Predict;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    public $view_col = 'name';
    public $listing_cols = ['id', 'symptom', 'history'];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
            $this->middleware(function ($request, $next) {
                $this->listing_cols = ModuleFields::listingColumnAccessScan('Predicts', $this->listing_cols);
                return $next($request);
            });
        } else {
            $this->listing_cols = ModuleFields::listingColumnAccessScan('Predicts', $this->listing_cols);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        
        $module = Module::get('Predicts');
        
        if(Module::hasAccess($module->id)) {
            return View('home', [
                'listing_cols' => $this->listing_cols,
                'module' => $module
            ]);
        } else {
            return redirect(config('laraadmin.adminRoute')."/");
        }


  //       $roleCount = \App\Role::count();
		// if($roleCount != 0) {
		// 	if($roleCount != 0) {
		// 		return view('home');
		// 	}
		// } else {
		// 	return view('errors.error', [
		// 		'title' => 'Migration not completed',
		// 		'message' => 'Please run command <code>php artisan db:seed</code> to generate required table data.',
		// 	]);
		// }
    }
    public function singledisease($some){
        dd($some);
    }
}
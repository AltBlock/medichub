<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Symptom;

use App\Models\History;

use App\Models\Disease;

use App\Models\Predict;

class PredictsController extends Controller
{
	public $show_action = true;
	public $view_col = 'symptom';
	public $listing_cols = ['id', 'symptom', 'history'];
	
	public function __construct() {
		// Field Access of Listing Columns
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
	 * Display a listing of the Predicts.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Predicts');
		
		if(Module::hasAccess($module->id)) {
			return View('la.predicts.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new predict.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created predict in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Predicts", "create")) {
		
			$rules = Module::validateRules("Predicts", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Predicts", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.predicts.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified predict.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Predicts", "view")) {
			
			$predict = Predict::find($id);
			if(isset($predict->id)) {
				$module = Module::get('Predicts');
				$module->row = $predict;
				
				return view('la.predicts.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('predict', $predict);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("predict"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified predict.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Predicts", "edit")) {			
			$predict = Predict::find($id);
			if(isset($predict->id)) {	
				$module = Module::get('Predicts');
				
				$module->row = $predict;
				
				return view('la.predicts.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('predict', $predict);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("predict"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified predict in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Predicts", "edit")) {
			
			$rules = Module::validateRules("Predicts", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Predicts", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.predicts.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified predict from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Predicts", "delete")) {
			Predict::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.predicts.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('predicts')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Predicts');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/predicts/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Predicts", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/predicts/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Predicts", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.predicts.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
	public function symptom(Request $request){
		//dd($request);
		$symptoms = $request->input('symptom');
		//dd($symptoms);
		$count = 0;
		$history = [];
		foreach ($symptoms as $symptom) {
			# code...
			$count++;
			$symptomhistory = History::where('symptom',$symptom)->get();
			$history[$count] = $symptomhistory;
		}
		//dd($count);
		/*for ($i=0; $i < $count; $i++) { 
			$first = $i + 1;
			$second = $i + 2;
			$questionare = array_merge($first,$second);
		}*/
		return view('page2')->with('questionare',$history);
		//dd($history);
	}
	public function disease(Request $request){
		$flag = $request->input('flag');
		$mhistory = $request->input('mhistory');
		//dd($mhistory);
		$counter = 0;
		$d_arrs = [];
		$f_arr = [];
		foreach ($mhistory as $mh) {
			$diseases = History::where('id',$mh)->first();
			$diseases_arr[$counter] = $diseases->disease;
			$counter++;
		}
		//dd($diseases_arr);
		foreach ($diseases_arr as $darr => $dval) {
			//dd($dval);
			# code...
			$newval = str_replace(['[',']','"'],'',$dval);
			array_push($d_arrs, $newval);
		}
		//dd($d_arrs);
		foreach ($d_arrs as $key) {
			//dd($key);
			$kkey = explode(',', $key);
			//$f_arr = array_merge($f_arr,$key);
			array_push($f_arr, $kkey);
		}
		//dd($f_arr);
		$h_arr = [];
		foreach ($f_arr as $g_arr) {
			# code...
			$h_arr = array_merge($h_arr,$g_arr);
		}
		//dd($h_arr);
		$arr_freq = array_count_values($h_arr); 
		arsort($arr_freq);
		$new_arr = array_keys($arr_freq);
		//dd($new_arr);
		$diseaseslist = [];
		foreach ($new_arr as $kdisease) {
			//dd($kdisease);
			$disease_single = Disease::where('id',$kdisease)->first();
			array_push($diseaseslist, $disease_single);
		}
		//dd($disease_single);
		//dd($diseaseslist);
		return view('diseaselist')->with($diseaseslist);
	}
}

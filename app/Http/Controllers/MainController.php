<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Data;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller {
	public function storeItem(Request $request) {
		$data = new Data ();
		$data->name = $request->name;
		$data->email = $request->email;
		$data->password = bcrypt($request->password);
		$data->type = 'member';
		$data->save();
		return $data;
	}
	public function readItems() {
		$results = DB::select('select * from users WHERE NOT name=:name', ['name' => Auth::user()->name]);
		return $results;
	}

	// public function readItemsPagination() {
	// 	$results = DB::select('select * from users WHERE NOT name=:name', ['name' => Auth::user()->name])->paginate(1);
	// 	return $results;
	// }
	
	public function deleteItem(Request $request) {
		$data = Data::find($request->id)->delete();
	}
	public function editItem(Request $request, $id){
		$data = Data::where('id', $id)->first();
		$data->name = $request->get('val_1');
		$data->save();
		return $data;
	}
}
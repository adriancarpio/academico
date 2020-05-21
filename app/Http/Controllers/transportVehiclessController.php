<?php
namespace App\Http\Controllers;

class transportVehiclessController extends Controller {
	var $data = array();
	var $panelInit ;

	public function __construct(){
		if(app('request')->header('Authorization') != "" || \Input::has('token')){
			$this->middleware('jwt.auth');
		}else{
			$this->middleware('authApplication');
		}

		$this->panelInit = new \DashboardInit();
		$this->data['panelInit'] = $this->panelInit;
		$this->data['users'] = $this->panelInit->getAuthUser();

		if(!isset($this->data['users']->id)){
			return \Redirect::to('/');
		}

	}

	public function listAll($page = 1,$search = ""){

		if(!$this->panelInit->can( array("trans_vehicles.list","trans_vehicles.add_vehicle","trans_vehicles.edit_vehicle","trans_vehicles.del_vehicle","trans_vehicles.Download") )){
			exit;
		}

		$toReturn = array();

		$toReturn["transport_vehicles"] = \transport_vehicles::select('id','plate_number','vehicle_color','vehicle_model','driver_name','driver_photo','driver_license','driver_contact','vehicle_notes')->orderby('id','DESC')->get()->toArray();
		return $toReturn;
	}

	public function create(){

		if(!$this->panelInit->can( "trans_vehicles.add_vehicle" )){
			exit;
		}

		$transport_vehicles = new \transport_vehicles();
		if(\Input::has('id')){
			$transport_vehicles->id = \Input::get('id');
		}
		$transport_vehicles->plate_number = \Input::get('plate_number');
		if(\Input::has('vehicle_color')){
			$transport_vehicles->vehicle_color = \Input::get('vehicle_color');
		}
		if(\Input::has('vehicle_model')){
			$transport_vehicles->vehicle_model = \Input::get('vehicle_model');
		}
		if(\Input::has('driver_name')){
			$transport_vehicles->driver_name = \Input::get('driver_name');
		}
		

		if (\Input::hasFile('driver_photo')) {
			$fileInstance = \Input::file('driver_photo');
			$newFileName = uniqid().".".$fileInstance->getClientOriginalExtension();
			$fileInstance->move('uploads/transport/',$newFileName);

			$transport_vehicles->driver_photo = $newFileName;
		}

		if(\Input::has('driver_license')){
			$transport_vehicles->driver_license = \Input::get('driver_license');
		}
		if(\Input::has('driver_contact')){
			$transport_vehicles->driver_contact = \Input::get('driver_contact');
		}
		if(\Input::has('vehicle_notes')){
			$transport_vehicles->vehicle_notes = \Input::get('vehicle_notes');
		}
		$transport_vehicles->save();
		return $this->panelInit->apiOutput(true,$this->panelInit->language['add_vehicle'],$this->panelInit->language['vehicle_add']);
	}

	public function fetch($id){

		if(!$this->panelInit->can( "trans_vehicles.edit_vehicle" )){
			exit;
		}

		$transport_vehicles = \transport_vehicles::select('id','plate_number','vehicle_color','vehicle_model','driver_name','driver_photo','driver_license','driver_contact','vehicle_notes')->where('id',$id)->first()->toArray();
	
		return $transport_vehicles;
	}

	public function edit($id){

		if(!$this->panelInit->can( "trans_vehicles.edit_vehicle" )){
			exit;
		}

		$transport_vehicles = \transport_vehicles::find($id);
		if(\Input::has('id')){
			$transport_vehicles->id = \Input::get('id');
		}
		$transport_vehicles->plate_number = \Input::get('plate_number');
		if(\Input::has('vehicle_color')){
			$transport_vehicles->vehicle_color = \Input::get('vehicle_color');
		}
		if(\Input::has('vehicle_model')){
			$transport_vehicles->vehicle_model = \Input::get('vehicle_model');
		}
		if(\Input::has('driver_name')){
			$transport_vehicles->driver_name = \Input::get('driver_name');
		}
		

		if (\Input::hasFile('driver_photo')) {
			
			if($transport_vehicles->driver_photo != ""){
				@unlink("uploads/transport/".$transport_vehicles->driver_photo);
			}

			$fileInstance = \Input::file('driver_photo');
			$newFileName = uniqid().".".$fileInstance->getClientOriginalExtension();
			$fileInstance->move('uploads/transport/',$newFileName);

			$transport_vehicles->driver_photo = $newFileName;
		}

		if(\Input::has('driver_license')){
			$transport_vehicles->driver_license = \Input::get('driver_license');
		}
		if(\Input::has('driver_contact')){
			$transport_vehicles->driver_contact = \Input::get('driver_contact');
		}
		if(\Input::has('vehicle_notes')){
			$transport_vehicles->vehicle_notes = \Input::get('vehicle_notes');
		}
		$transport_vehicles->save();
		return $this->panelInit->apiOutput(true,$this->panelInit->language['edit_vehicle'],$this->panelInit->language['vehicle_edit']);
	}
	
	public function delete($id){

		if(!$this->panelInit->can( "trans_vehicles.del_vehicle" )){
			exit;
		}

		if ( $postDelete = \transport_vehicles::where('id', $id)->first() ){
        		if($postDelete->driver_photo != ""){ @unlink('uploads/transport/'.$postDelete->driver_photo); }
        	
        		$postDelete->delete();
			return $this->panelInit->apiOutput(true,$this->panelInit->language['del_vehicle'],$this->panelInit->language['vehicle_del']);
        	}else{
        		return $this->panelInit->apiOutput(true,$this->panelInit->language['del_vehicle'],$this->panelInit->language['vehicle_not_exist']);
        	}
	}

	public function download($id){

		if(!$this->panelInit->can( "trans_vehicles.Download" )){
			exit;
		}

		$toReturn = \transport_vehicles::where('id',$id)->select("id","driver_photo","plate_number")->first();
		if(file_exists("uploads/transport/".$toReturn->driver_photo)){
			$fileName = preg_replace('/[^a-zA-Z0-9-_\.]/','',$toReturn->plate_number). "." .pathinfo($toReturn->driver_photo, PATHINFO_EXTENSION);
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment; filename=" . $fileName);
			echo file_get_contents("uploads/transport/".$toReturn->driver_photo);
		}else{
			echo "<br/><br/><br/><br/><br/><center>File not exist, Please contact site administrator to reupload it again.</center>";
		}
		exit;
	}


}
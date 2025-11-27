<?php
class RoleController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("biology");
	}
	public function create(){
		view("biology");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtDescription"])){
		$errors["description"]="Invalid description";
	}

*/
		if(count($errors)==0){
			$role=new Role();
		$role->name=$data["name"];
		$role->description=$data["description"];

			$role->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("biology",Role::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtDescription"])){
		$errors["description"]="Invalid description";
	}

*/
		if(count($errors)==0){
			$role=new Role();
			$role->id=$data["id"];
		$role->name=$data["name"];
		$role->description=$data["description"];

		$role->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("biology");
	}
	public function delete($id){
		Role::delete($id);
		redirect();
	}
	public function show($id){
		view("biology",Role::find($id));
	}
}
?>

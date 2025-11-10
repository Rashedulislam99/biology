<?php
class SubjectController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$data["description"])){
		$errors["description"]="Invalid description";
	}

*/
		if(count($errors)==0){
			$subject=new Subject();
		$subject->name=$data["name"];
		$subject->description=$data["description"];
		$subject->created_at=$now;

			$subject->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("biology",Subject::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["description"])){
		$errors["description"]="Invalid description";
	}

*/
		if(count($errors)==0){
			$subject=new Subject();
			$subject->id=$data["id"];
		$subject->name=$data["name"];
		$subject->description=$data["description"];
		$subject->created_at=$now;

		$subject->update();
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
		Subject::delete($id);
		redirect();
	}
	public function show($id){
		view("biology",Subject::find($id));
	}
}
?>

<?php
class LectureController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("biology");
	}
	public function create(){
		view("biology");
	}
public function save($data,$file){
	global $now;
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["subject_id"])){
		$errors["subject_id"]="Invalid subject_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["chapter_id"])){
		$errors["chapter_id"]="Invalid chapter_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["photo"])){
		$errors["photo"]="Invalid photo";
	}

*/
		if(count($errors)==0){
			$lecture=new Lecture();
		$lecture->subject_id=$data["subject_id"];
		$lecture->chapter_id=$data["chapter_id"];
		$lecture->name=$data["name"];
		$lecture->photo=File::upload($file["photo"],"pdf", $data["name"]);
		$lecture->created_at=$now;

			$lecture->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("biology",Lecture::find($id));
}
public function update($data,$file){
		global $now;
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["subject_id"])){
		$errors["subject_id"]="Invalid subject_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["chapter_id"])){
		$errors["chapter_id"]="Invalid chapter_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["photo"])){
		$errors["photo"]="Invalid photo";
	}

*/
		if(count($errors)==0){
			$lecture=new Lecture();
			$lecture->id=$data["id"];
		$lecture->subject_id=$data["subject_id"];
		$lecture->chapter_id=$data["chapter_id"];
		$lecture->name=$data["name"];
		if($file["photo"]["name"]!=""){
			$lecture->photo=File::upload($file["photo"], "pdf",$data["name"]);
		}else{
			$lecture->photo=Lecture::find($data["id"])->photo;
		}
		$lecture->created_at=$now;

		$lecture->update();
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
		Lecture::delete($id);
		redirect();
	}
	public function show($id){
		view("biology",Lecture::find($id));
	}
}
?>

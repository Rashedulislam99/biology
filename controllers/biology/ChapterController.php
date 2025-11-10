<?php
class ChapterController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$data["subject_id"])){
		$errors["subject_id"]="Invalid subject_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["photo"])){
		$errors["photo"]="Invalid photo";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtFolderName"])){
		$errors["folder_name"]="Invalid folder_name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["paper_id"])){
		$errors["paper_id"]="Invalid paper_id";
	}

*/
		if(count($errors)==0){
			$chapter=new Chapter();
		$chapter->subject_id=$data["subject_id"];
		$chapter->name=$data["name"];
		$chapter->photo=File::upload($file["photo"], "img",$data["id"]);
		$chapter->folder_name=$data["folder_name"];
		$chapter->paper_id=$data["paper_id"];
		$chapter->created_at=$now;

			$chapter->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("biology",Chapter::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["subject_id"])){
		$errors["subject_id"]="Invalid subject_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["photo"])){
		$errors["photo"]="Invalid photo";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtFolderName"])){
		$errors["folder_name"]="Invalid folder_name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["paper_id"])){
		$errors["paper_id"]="Invalid paper_id";
	}

*/
		if(count($errors)==0){
			$chapter=new Chapter();
			$chapter->id=$data["id"];
		$chapter->subject_id=$data["subject_id"];
		$chapter->name=$data["name"];
		if($file["photo"]["name"]!=""){
			$chapter->photo=File::upload($file["photo"], "img",$data["id"]);
		}else{
			$chapter->photo=Chapter::find($data["id"])->photo;
		}
		$chapter->folder_name=$data["folder_name"];
		$chapter->paper_id=$data["paper_id"];
		$chapter->created_at=$now;

		$chapter->update();
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
		Chapter::delete($id);
		redirect();
	}
	public function show($id){
		view("biology",Chapter::find($id));
	}
}
?>

<?php
class QuizzeController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$data["chapter_id"])){
		$errors["chapter_id"]="Invalid chapter_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["question"])){
		$errors["question"]="Invalid question";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtOptionA"])){
		$errors["option_a"]="Invalid option_a";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtOptionB"])){
		$errors["option_b"]="Invalid option_b";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtOptionC"])){
		$errors["option_c"]="Invalid option_c";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtOptionD"])){
		$errors["option_d"]="Invalid option_d";
	}
	if(!preg_match("/^[\s\S]+$/",$data["correct_ans"])){
		$errors["correct_ans"]="Invalid correct_ans";
	}

*/
		if(count($errors)==0){
			$quizze=new Quizze();
		$quizze->chapter_id=$data["chapter_id"];
		$quizze->question=$data["question"];
		$quizze->option_a=$data["option_a"];
		$quizze->option_b=$data["option_b"];
		$quizze->option_c=$data["option_c"];
		$quizze->option_d=$data["option_d"];
		$quizze->correct_ans=$data["correct_ans"];

			$quizze->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("biology",Quizze::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["chapter_id"])){
		$errors["chapter_id"]="Invalid chapter_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["question"])){
		$errors["question"]="Invalid question";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtOptionA"])){
		$errors["option_a"]="Invalid option_a";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtOptionB"])){
		$errors["option_b"]="Invalid option_b";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtOptionC"])){
		$errors["option_c"]="Invalid option_c";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtOptionD"])){
		$errors["option_d"]="Invalid option_d";
	}
	if(!preg_match("/^[\s\S]+$/",$data["correct_ans"])){
		$errors["correct_ans"]="Invalid correct_ans";
	}

*/
		if(count($errors)==0){
			$quizze=new Quizze();
			$quizze->id=$data["id"];
		$quizze->chapter_id=$data["chapter_id"];
		$quizze->question=$data["question"];
		$quizze->option_a=$data["option_a"];
		$quizze->option_b=$data["option_b"];
		$quizze->option_c=$data["option_c"];
		$quizze->option_d=$data["option_d"];
		$quizze->correct_ans=$data["correct_ans"];

		$quizze->update();
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
		Quizze::delete($id);
		redirect();
	}
	public function show($id){
		view("biology",Quizze::find($id));
	}
}
?>

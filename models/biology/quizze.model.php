<?php
class Quizze extends Model implements JsonSerializable{
	public $id;
	public $chapter_id;
	public $question;
	public $option_a;
	public $option_b;
	public $option_c;
	public $option_d;
	public $correct_ans;

	public function __construct(){
	}
	public function set($id,$chapter_id,$question,$option_a,$option_b,$option_c,$option_d,$correct_ans){
		$this->id=$id;
		$this->chapter_id=$chapter_id;
		$this->question=$question;
		$this->option_a=$option_a;
		$this->option_b=$option_b;
		$this->option_c=$option_c;
		$this->option_d=$option_d;
		$this->correct_ans=$correct_ans;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}quizzes(chapter_id,question,option_a,option_b,option_c,option_d,correct_ans)values('$this->chapter_id','$this->question','$this->option_a','$this->option_b','$this->option_c','$this->option_d','$this->correct_ans')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}quizzes set chapter_id='$this->chapter_id',question='$this->question',option_a='$this->option_a',option_b='$this->option_b',option_c='$this->option_c',option_d='$this->option_d',correct_ans='$this->correct_ans' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}quizzes where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,chapter_id,question,option_a,option_b,option_c,option_d,correct_ans from {$tx}quizzes");
		$data=[];
		while($quizze=$result->fetch_object()){
			$data[]=$quizze;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,chapter_id,question,option_a,option_b,option_c,option_d,correct_ans from {$tx}quizzes $criteria limit $top,$perpage");
		$data=[];
		while($quizze=$result->fetch_object()){
			$data[]=$quizze;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}quizzes $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,chapter_id,question,option_a,option_b,option_c,option_d,correct_ans from {$tx}quizzes where id='$id'");
		$quizze=$result->fetch_object();
			return $quizze;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}quizzes");
		$quizze =$result->fetch_object();
		return $quizze->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Chapter Id:$this->chapter_id<br> 
		Question:$this->question<br> 
		Option A:$this->option_a<br> 
		Option B:$this->option_b<br> 
		Option C:$this->option_c<br> 
		Option D:$this->option_d<br> 
		Correct Ans:$this->correct_ans<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbQuizze"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}quizzes");
		while($quizze=$result->fetch_object()){
			$html.="<option value ='$quizze->id'>$quizze->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}quizzes $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,chapter_id,question,option_a,option_b,option_c,option_d,correct_ans from {$tx}quizzes $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"quizze/create","text"=>"New Quizze"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Chapter Id</th><th>Question</th><th>Option A</th><th>Option B</th><th>Option C</th><th>Option D</th><th>Correct Ans</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Chapter Id</th><th>Question</th><th>Option A</th><th>Option B</th><th>Option C</th><th>Option D</th><th>Correct Ans</th></tr>";
		}
		while($quizze=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"quizze/show/$quizze->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"quizze/edit/$quizze->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"quizze/confirm/$quizze->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$quizze->id</td><td>$quizze->chapter_id</td><td>$quizze->question</td><td>$quizze->option_a</td><td>$quizze->option_b</td><td>$quizze->option_c</td><td>$quizze->option_d</td><td>$quizze->correct_ans</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,chapter_id,question,option_a,option_b,option_c,option_d,correct_ans from {$tx}quizzes where id={$id}");
		$quizze=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Quizze Show</th></tr>";
		$html.="<tr><th>Id</th><td>$quizze->id</td></tr>";
		$html.="<tr><th>Chapter Id</th><td>$quizze->chapter_id</td></tr>";
		$html.="<tr><th>Question</th><td>$quizze->question</td></tr>";
		$html.="<tr><th>Option A</th><td>$quizze->option_a</td></tr>";
		$html.="<tr><th>Option B</th><td>$quizze->option_b</td></tr>";
		$html.="<tr><th>Option C</th><td>$quizze->option_c</td></tr>";
		$html.="<tr><th>Option D</th><td>$quizze->option_d</td></tr>";
		$html.="<tr><th>Correct Ans</th><td>$quizze->correct_ans</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>

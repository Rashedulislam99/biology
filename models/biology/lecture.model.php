<?php
class Lecture extends Model implements JsonSerializable{
	public $id;
	public $subject_id;
	public $chapter_id;
	public $name;
	public $photo;
	public $created_at;

	public function __construct(){
	}
	public function set($id,$subject_id,$chapter_id,$name,$photo,$created_at){
		$this->id=$id;
		$this->subject_id=$subject_id;
		$this->chapter_id=$chapter_id;
		$this->name=$name;
		$this->photo=$photo;
		$this->created_at=$created_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}lectures(subject_id,chapter_id,name,photo,created_at)values('$this->subject_id','$this->chapter_id','$this->name','$this->photo','$this->created_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}lectures set subject_id='$this->subject_id',chapter_id='$this->chapter_id',name='$this->name',photo='$this->photo',created_at='$this->created_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}lectures where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,subject_id,chapter_id,name,photo,created_at from {$tx}lectures");
		$data=[];
		while($lecture=$result->fetch_object()){
			$data[]=$lecture;
		}
			return $data;
	}
	public static function all_chapter_id($id){
		global $db,$tx;
		$result=$db->query("select id,subject_id,chapter_id,name,photo,created_at from {$tx}lectures where chapter_id= $id");
		$data=[];
		while($lecture=$result->fetch_object()){
			$data[]=$lecture;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,subject_id,chapter_id,name,photo,created_at from {$tx}lectures $criteria limit $top,$perpage");
		$data=[];
		while($lecture=$result->fetch_object()){
			$data[]=$lecture;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}lectures $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,subject_id,chapter_id,name,photo,created_at from {$tx}lectures where id='$id'");
		$lecture=$result->fetch_object();
			return $lecture;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}lectures");
		$lecture =$result->fetch_object();
		return $lecture->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Subject Id:$this->subject_id<br> 
		Chapter Id:$this->chapter_id<br> 
		Name:$this->name<br> 
		Photo:$this->photo<br> 
		Created At:$this->created_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbLecture"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}lectures");
		while($lecture=$result->fetch_object()){
			$html.="<option value ='$lecture->id'>$lecture->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}lectures $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,subject_id,chapter_id,name,photo,created_at from {$tx}lectures $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"lecture/create","text"=>"New Lecture"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Subject Id</th><th>Chapter Id</th><th>Name</th><th>Photo</th><th>Created At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Subject Id</th><th>Chapter Id</th><th>Name</th><th>Photo</th><th>Created At</th></tr>";
		}
		while($lecture=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"lecture/show/$lecture->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"lecture/edit/$lecture->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"lecture/confirm/$lecture->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$lecture->id</td><td>$lecture->subject_id</td><td>$lecture->chapter_id</td><td>$lecture->name</td><td><img src='$base_url/img/$lecture->photo' width='100' /></td><td>$lecture->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,subject_id,chapter_id,name,photo,created_at from {$tx}lectures where id={$id}");
		$lecture=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Lecture Show</th></tr>";
		$html.="<tr><th>Id</th><td>$lecture->id</td></tr>";
		$html.="<tr><th>Subject Id</th><td>$lecture->subject_id</td></tr>";
		$html.="<tr><th>Chapter Id</th><td>$lecture->chapter_id</td></tr>";
		$html.="<tr><th>Name</th><td>$lecture->name</td></tr>";
		$html.="<tr><th>Photo</th><td><img src='$base_url/img/$lecture->photo' width='100' /></td></tr>";
		$html.="<tr><th>Created At</th><td>$lecture->created_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>

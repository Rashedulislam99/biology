<?php
class Chapter extends Model implements JsonSerializable{
	public $id;
	public $subject_id;
	public $name;
	public $photo;
	public $folder_name;
	public $paper_id;
	public $created_at;

	public function __construct(){
	}
	public function set($id,$subject_id,$name,$photo,$folder_name,$paper_id,$created_at){
		$this->id=$id;
		$this->subject_id=$subject_id;
		$this->name=$name;
		$this->photo=$photo;
		$this->folder_name=$folder_name;
		$this->paper_id=$paper_id;
		$this->created_at=$created_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}chapters(subject_id,name,photo,folder_name,paper_id,created_at)values('$this->subject_id','$this->name','$this->photo','$this->folder_name','$this->paper_id','$this->created_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}chapters set subject_id='$this->subject_id',name='$this->name',photo='$this->photo',folder_name='$this->folder_name',paper_id='$this->paper_id',created_at='$this->created_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}chapters where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,subject_id,name,photo,folder_name,paper_id,created_at from {$tx}chapters");
		$data=[];
		while($chapter=$result->fetch_object()){
			$data[]=$chapter;
		}
			return $data;
	}
	public static function all_by_subject_id($subject_id,$paper_id){
		global $db,$tx;
		$result=$db->query("select id,subject_id,name,photo,folder_name,paper_id,created_at from {$tx}chapters where subject_id=$subject_id and paper_id=$paper_id");
		$data=[];
		while($chapter=$result->fetch_object()){
			$data[]=$chapter;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,subject_id,name,photo,folder_name,paper_id,created_at from {$tx}chapters $criteria limit $top,$perpage");
		$data=[];
		while($chapter=$result->fetch_object()){
			$data[]=$chapter;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}chapters $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,subject_id,name,photo,folder_name,paper_id,created_at from {$tx}chapters where id='$id'");
		$chapter=$result->fetch_object();
			return $chapter;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}chapters");
		$chapter =$result->fetch_object();
		return $chapter->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Subject Id:$this->subject_id<br> 
		Name:$this->name<br> 
		Photo:$this->photo<br> 
		Folder Name:$this->folder_name<br> 
		Paper Id:$this->paper_id<br> 
		Created At:$this->created_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbChapter"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}chapters");
		while($chapter=$result->fetch_object()){
			$html.="<option value ='$chapter->id'>$chapter->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}chapters $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,subject_id,name,photo,folder_name,paper_id,created_at from {$tx}chapters $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"chapter/create","text"=>"New Chapter"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Subject Id</th><th>Name</th><th>Photo</th><th>Folder Name</th><th>Paper Id</th><th>Created At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Subject Id</th><th>Name</th><th>Photo</th><th>Folder Name</th><th>Paper Id</th><th>Created At</th></tr>";
		}
		while($chapter=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"chapter/show/$chapter->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"chapter/edit/$chapter->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"chapter/confirm/$chapter->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$chapter->id</td><td>$chapter->subject_id</td><td>$chapter->name</td><td><img src='$base_url/img/$chapter->photo' width='100' /></td><td>$chapter->folder_name</td><td>$chapter->paper_id</td><td>$chapter->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,subject_id,name,photo,folder_name,paper_id,created_at from {$tx}chapters where id={$id}");
		$chapter=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Chapter Show</th></tr>";
		$html.="<tr><th>Id</th><td>$chapter->id</td></tr>";
		$html.="<tr><th>Subject Id</th><td>$chapter->subject_id</td></tr>";
		$html.="<tr><th>Name</th><td>$chapter->name</td></tr>";
		$html.="<tr><th>Photo</th><td><img src='$base_url/img/$chapter->photo' width='100' /></td></tr>";
		$html.="<tr><th>Folder Name</th><td>$chapter->folder_name</td></tr>";
		$html.="<tr><th>Paper Id</th><td>$chapter->paper_id</td></tr>";
		$html.="<tr><th>Created At</th><td>$chapter->created_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>

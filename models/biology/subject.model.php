<?php
class Subject extends Model implements JsonSerializable{
	public $id;
	public $name;
	public $description;
	public $created_at;

	public function __construct(){
	}
	public function set($id,$name,$description,$created_at){
		$this->id=$id;
		$this->name=$name;
		$this->description=$description;
		$this->created_at=$created_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}subjects(name,description,created_at)values('$this->name','$this->description','$this->created_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}subjects set name='$this->name',description='$this->description',created_at='$this->created_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}subjects where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,description,created_at from {$tx}subjects");
		$data=[];
		while($subject=$result->fetch_object()){
			$data[]=$subject;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,description,created_at from {$tx}subjects $criteria limit $top,$perpage");
		$data=[];
		while($subject=$result->fetch_object()){
			$data[]=$subject;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}subjects $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,description,created_at from {$tx}subjects where id='$id'");
		$subject=$result->fetch_object();
			return $subject;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}subjects");
		$subject =$result->fetch_object();
		return $subject->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Description:$this->description<br> 
		Created At:$this->created_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbSubject"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}subjects");
		while($subject=$result->fetch_object()){
			$html.="<option value ='$subject->id'>$subject->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}subjects $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,description,created_at from {$tx}subjects $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"subject/create","text"=>"New Subject"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Description</th><th>Created At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Description</th><th>Created At</th></tr>";
		}
		while($subject=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"subject/show/$subject->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"subject/edit/$subject->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"subject/confirm/$subject->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$subject->id</td><td>$subject->name</td><td>$subject->description</td><td>$subject->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,name,description,created_at from {$tx}subjects where id={$id}");
		$subject=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Subject Show</th></tr>";
		$html.="<tr><th>Id</th><td>$subject->id</td></tr>";
		$html.="<tr><th>Name</th><td>$subject->name</td></tr>";
		$html.="<tr><th>Description</th><td>$subject->description</td></tr>";
		$html.="<tr><th>Created At</th><td>$subject->created_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>

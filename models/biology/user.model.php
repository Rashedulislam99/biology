<?php
class User extends Model implements JsonSerializable{
	public $id;
	public $name;
	public $full_name;
	public $hsc_session;
	public $class_roll;
	public $Phone;
	public $email;
	public $photo;
	public $password;
	public $role_id;
	public $inactive;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$name,$full_name,$hsc_session,$class_roll,$Phone,$email,$photo,$password,$role_id,$inactive,$created_at,$updated_at){
		$this->id=$id;
		$this->name=$name;
		$this->full_name=$full_name;
		$this->hsc_session=$hsc_session;
		$this->class_roll=$class_roll;
		$this->Phone=$Phone;
		$this->email=$email;
		$this->photo=$photo;
		$this->password=$password;
		$this->role_id=$role_id;
		$this->inactive=$inactive;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}users(name,full_name,hsc_session,class_roll,Phone,email,photo,password,role_id,inactive,created_at,updated_at)values('$this->name','$this->full_name','$this->hsc_session','$this->class_roll','$this->Phone','$this->email','$this->photo','$this->password','$this->role_id','$this->inactive','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}users set name='$this->name',full_name='$this->full_name',hsc_session='$this->hsc_session',class_roll='$this->class_roll',Phone='$this->Phone',email='$this->email',photo='$this->photo',password='$this->password',role_id='$this->role_id',inactive='$this->inactive',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}users where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,full_name,hsc_session,class_roll,Phone,email,photo,password,role_id,inactive,created_at,updated_at from {$tx}users");
		$data=[];
		while($user=$result->fetch_object()){
			$data[]=$user;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,full_name,hsc_session,class_roll,Phone,email,photo,password,role_id,inactive,created_at,updated_at from {$tx}users $criteria limit $top,$perpage");
		$data=[];
		while($user=$result->fetch_object()){
			$data[]=$user;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}users $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,full_name,hsc_session,class_roll,Phone,email,photo,password,role_id,inactive,created_at,updated_at from {$tx}users where id='$id'");
		$user=$result->fetch_object();
			return $user;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}users");
		$user =$result->fetch_object();
		return $user->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Full Name:$this->full_name<br> 
		Hsc Session:$this->hsc_session<br> 
		Class Roll:$this->class_roll<br> 
		Phone:$this->Phone<br> 
		Email:$this->email<br> 
		Photo:$this->photo<br> 
		Password:$this->password<br> 
		Role Id:$this->role_id<br> 
		Inactive:$this->inactive<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbUser"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}users");
		while($user=$result->fetch_object()){
			$html.="<option value ='$user->id'>$user->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}users $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,full_name,hsc_session,class_roll,Phone,email,photo,password,role_id,inactive,created_at,updated_at from {$tx}users $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"user/create","text"=>"New User"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Full Name</th><th>Hsc Session</th><th>Class Roll</th><th>Phone</th><th>Email</th><th>Photo</th><th>Password</th><th>Role Id</th><th>Inactive</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Full Name</th><th>Hsc Session</th><th>Class Roll</th><th>Phone</th><th>Email</th><th>Photo</th><th>Password</th><th>Role Id</th><th>Inactive</th><th>Created At</th><th>Updated At</th></tr>";
		}
		while($user=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"user/show/$user->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"user/edit/$user->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"user/confirm/$user->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$user->id</td><td>$user->name</td><td>$user->full_name</td><td>$user->hsc_session</td><td>$user->class_roll</td><td>$user->Phone</td><td>$user->email</td><td>    
		
			<img  src='$base_url/img/users/$user->photo' width='100'/>
			
			</td><td>$user->password</td><td>$user->role_id</td><td>$user->inactive</td><td>$user->created_at</td><td>$user->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,name,full_name,hsc_session,class_roll,Phone,email,photo,password,role_id,inactive,created_at,updated_at from {$tx}users where id={$id}");
		$user=$result->fetch_object();
		$html="<table class='table '>";
		$html.="<tr><th colspan=\"2\">User Show</th></tr>";
		$html.="<tr><th>Id</th><td>$user->id</td></tr>";
		$html.="<tr><th>Name</th><td>$user->name</td></tr>";
		$html.="<tr><th>Full Name</th><td>$user->full_name</td></tr>";
		$html.="<tr><th>Hsc Session</th><td>$user->hsc_session</td></tr>";
		$html.="<tr><th>Class Roll</th><td>$user->class_roll</td></tr>";
		$html.="<tr><th>Phone</th><td>$user->Phone</td></tr>";
		$html.="<tr><th>Email</th><td>$user->email</td></tr>";
		$html.="<tr><th>Photo</th><td>$user->photo</td></tr>";
		$html.="<tr><th>Password</th><td>$user->password</td></tr>";
		$html.="<tr><th>Role Id</th><td>$user->role_id</td></tr>";
		$html.="<tr><th>Inactive</th><td>$user->inactive</td></tr>";
		$html.="<tr><th>Created At</th><td>$user->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$user->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}




	public static function findByEmail($email){
        global $db,$tx;
        $stmt = $db->prepare("SELECT * FROM {$tx}users WHERE email=? AND inactive=0");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
    }

    // Use bcrypt password while saving new user
    public function save2(){
        global $db,$tx;
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        $db->query("INSERT INTO {$tx}users(name,full_name,hsc_session,class_roll,Phone,email,photo,password,role_id,inactive,created_at,updated_at)
        VALUES('$this->name','$this->full_name','$this->hsc_session','$this->class_roll','$this->Phone','$this->email','$this->photo','$hashedPassword','$this->role_id','$this->inactive','$this->created_at','$this->updated_at')");
        return $db->insert_id;
    }
}
?>

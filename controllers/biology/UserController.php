<?php
class UserController extends Controller
{
	public function __construct() {}
	public function index()
	{
		view("biology");
	}
	public function create()
	{
		view("biology");
	}
	public function save($data, $file)
	{
		if (isset($data["create"])) {
			$errors = [];
			/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtFullName"])){
		$errors["full_name"]="Invalid full_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtHscSession"])){
		$errors["hsc_session"]="Invalid hsc_session";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtClassRoll"])){
		$errors["class_roll"]="Invalid class_roll";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["Phone"]="Invalid Phone";
	}
	if(!is_valid_email($data["email"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$data["photo"])){
		$errors["photo"]="Invalid photo";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPassword"])){
		$errors["password"]="Invalid password";
	}
	if(!preg_match("/^[\s\S]+$/",$data["role_id"])){
		$errors["role_id"]="Invalid role_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["inactive"])){
		$errors["inactive"]="Invalid inactive";
	}

*/
			global $now;
			if (count($errors) == 0) {
				$user = new User();
				$user->name = $data["name"];
				$user->full_name = $data["full_name"];
				$user->hsc_session = $data["hsc_session"];
				$user->class_roll = $data["class_roll"];
				$user->Phone = $data["Phone"];
				$user->email = $data["email"];
				$user->photo = upload($file["photo"], "img/users", $data["name"]);
				$user->password = $data["password"];
				$user->role_id = 4;
				$user->inactive = 1;
				$user->created_at = $now;
				$user->updated_at = $now;

				$user->save2();

				redirect();
			} else {
				print_r($errors);
			}
		}
	}
	public function edit($id)
	{
		view("biology", User::find($id));
	}
	public function update($data, $file)
	{
		if (isset($data["update"])) {
			$errors = [];
			/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtFullName"])){
		$errors["full_name"]="Invalid full_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtHscSession"])){
		$errors["hsc_session"]="Invalid hsc_session";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtClassRoll"])){
		$errors["class_roll"]="Invalid class_roll";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["Phone"]="Invalid Phone";
	}
	if(!is_valid_email($data["email"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$data["photo"])){
		$errors["photo"]="Invalid photo";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPassword"])){
		$errors["password"]="Invalid password";
	}
	if(!preg_match("/^[\s\S]+$/",$data["role_id"])){
		$errors["role_id"]="Invalid role_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["inactive"])){
		$errors["inactive"]="Invalid inactive";
	}

*/
			global $now;
			if (count($errors) == 0) {
				$user = new User();
				$user->id = $data["id"];
				$user->name = $data["name"];
				$user->full_name = $data["full_name"];
				$user->hsc_session = $data["hsc_session"];
				$user->class_roll = $data["class_roll"];
				$user->Phone = $data["Phone"];
				$user->email = $data["email"];
				$user->photo = upload($file["photo"], "img/users", $data["name"]);
				$user->password = $data["password"];
				$user->role_id = $data["role_id"];
				$user->inactive = isset($data["inactive"]) ? 1 : 0;
				$user->created_at = $now;
				$user->updated_at = $now;

				$user->update();
				redirect();
			} else {
				print_r($errors);
			}
		}
	}
	public function confirm($id)
	{
		view("biology");
	}
	public function delete($id)
	{
		User::delete($id);
		redirect();
	}
	public function show($id)
	{
		view("biology", User::find($id));
	}





	// Login form
	public function login()
	{
		view("biology");
	}

	// Process login
	public function loginsubmit($data)
	{


		$email = $data['email'] ?? '';
		$password = $data['password'] ?? '';

		$user = User::findByEmail($email);

		if ($user) {
			if (password_verify($password, $user->password)) {
				$_SESSION['user_id'] = $user->id;
				$_SESSION['user_name'] = $user->name;
				$_SESSION['role_id'] = $user->role_id;
				redirect("biology", "Courses");
				exit;
			} else {
				$_SESSION['error'] = "Invalid password!";
			}
		} else {
			$_SESSION['error'] = "User not found or inactive!";
		}

		redirect("login");
		exit;
	}

	// Logout
	public function logout()
	{
		global $base_url;
		session_destroy();
		echo "<script>window.location='$base_url'</script>";
		exit;
	}
}

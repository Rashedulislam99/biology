<style>
    label{
        color: black;
        font-weight: bold;
    }
</style>

<?php
echo Page::title(["title"=>"Edit User"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"user", "text"=>"Manage User"]);
echo Page::context_open();
echo Form::open(["route"=>"user/update"]);

    echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$user->id"]);
    
    echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$user->name"]);
    
    echo Form::input(["label"=>"Full Name","type"=>"text","name"=>"full_name","value"=>"$user->full_name"]);
    
    echo Form::input(["label"=>"Hsc Session","type"=>"text","name"=>"hsc_session","value"=>"$user->hsc_session"]);
    
    echo Form::input(["label"=>"Class Roll","type"=>"text","name"=>"class_roll","value"=>"$user->class_roll"]);
    
    echo Form::input(["label"=>"Phone","type"=>"text","name"=>"Phone","value"=>"$user->Phone"]);
    
    echo Form::input(["label"=>"Email","type"=>"email","name"=>"email","value"=>"$user->email"]);
    
    echo Form::input(["label"=>"Photo","type"=>"file","name"=>"photo","value"=>"$user->photo"]);
    
    echo Form::input(["label"=>"Password","type"=>"password","name"=>"password","value"=>"","placeholder"=>"Leave blank to keep current password"]);
    
    echo Form::input(["label"=>"Role","name"=>"role_id","table"=>"roles","value"=>"$user->role_id"]);
    
    // Fixed Inactive Checkbox
    echo Form::input([
        "label"=>"Inactive",
        "type"=>"checkbox",
        "name"=>"inactive",
        "value"=>"1",
        "checked"=>($user->inactive == 1) ? "checked" : ""
    ]);

    echo Form::input([
        "name"=>"update",
        "class"=>"btn btn-success offset-2",
        "value"=>"Save Changes",
        "type"=>"submit"
    ]);

echo Form::close();
echo Page::context_close();
echo Page::body_close();
?>
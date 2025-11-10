<?php
echo Page::title(["title"=>"Edit Lecture"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"lecture", "text"=>"Manage Lecture"]);
echo Page::context_open();
echo Form::open(["route"=>"lecture/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$lecture->id"]);
	echo Form::input(["label"=>"Subject","name"=>"subject_id","table"=>"subjects","value"=>"$lecture->subject_id"]);
	echo Form::input(["label"=>"Chapter","name"=>"chapter_id","table"=>"chapters","value"=>"$lecture->chapter_id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$lecture->name"]);
	echo Form::input(["label"=>"Photo","type"=>"file","name"=>"photo","value"=>$lecture->photo]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();

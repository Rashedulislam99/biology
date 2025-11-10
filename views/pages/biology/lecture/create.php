<?php
echo Page::title(["title"=>"Create Lecture"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"lecture", "text"=>"Manage Lecture"]);
echo Page::context_open();
echo Form::open(["route"=>"lecture/save"]);
	echo Form::input(["label"=>"Subject","name"=>"subject_id","table"=>"subjects"]);
	echo Form::input(["label"=>"Chapter","name"=>"chapter_id","table"=>"chapters"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"Photo","type"=>"file","name"=>"photo"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();

<?php
echo Page::title(["title"=>"Edit Subject"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"subject", "text"=>"Manage Subject"]);
echo Page::context_open();
echo Form::open(["route"=>"subject/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$subject->id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$subject->name"]);
	echo Form::input(["label"=>"Description","type"=>"textarea","name"=>"description","value"=>"$subject->description"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();

<?php
echo Page::title(["title"=>"Show Lecture"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"lecture", "text"=>"Manage Lecture"]);
echo Page::context_open();
echo Lecture::html_row_details($id);
echo Page::context_close();
echo Page::body_close();

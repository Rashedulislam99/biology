<?php
echo Page::title(["title"=>"Show Quizze"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"quizze", "text"=>"Manage Quizze"]);
echo Page::context_open();
echo Quizze::html_row_details($id);
echo Page::context_close();
echo Page::body_close();

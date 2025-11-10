<?php
echo Page::title(["title"=>"Show Subject"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"subject", "text"=>"Manage Subject"]);
echo Page::context_open();
echo Subject::html_row_details($id);
echo Page::context_close();
echo Page::body_close();

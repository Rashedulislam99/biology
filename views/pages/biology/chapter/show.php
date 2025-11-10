<?php
echo Page::title(["title"=>"Show Chapter"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"chapter", "text"=>"Manage Chapter"]);
echo Page::context_open();
echo Chapter::html_row_details($id);
echo Page::context_close();
echo Page::body_close();

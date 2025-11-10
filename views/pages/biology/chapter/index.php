
<style>
 .m-0{
    font-size: 30px !important
 }


</style>



<?php
echo Page::title(["title"=>"Manage Chapter"]);
echo Page::body_open();
echo Page::context_open();
$page = isset($_GET["page"]) ?$_GET["page"]:1;
echo Chapter::html_table($page,10);
echo Page::context_close();
echo Page::body_close();

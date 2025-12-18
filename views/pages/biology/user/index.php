<?php
echo Page::title(["title" => "Manage User"]);
echo Page::body_open();
echo Page::context_open();
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
if (isset($_GET['name'])) {
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $search = $_GET['name'] ?? '';
    $sql = "WHERE name LIKE '%$search%' OR class_roll LIKE '%$search%' OR phone LIKE '%$search%'";
    echo User::html_table($page, 10, $sql);
} else {
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    echo User::html_table($page, 10);
}
// echo User::html_table($page,10);
echo Page::context_close();
echo Page::body_close();

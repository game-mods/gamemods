<?php

// core functions
include_once "core.php";

// session check
seg(1);

// page
$tpl->set_param("sel_cat", -1);
$tpl->set_param("page_title", "Login");
$tpl->load("head");
$tpl->load("login");
$tpl->load("footer");
$tpl->output();
?>

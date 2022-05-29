<?php

// core functions
include_once "core.php";

// no session check needed

// mods params
$mods->page_id = 1;
$mods->page_query = 'status = 1';
$tpl->set_param("last_mods", $mods->load_list(), true);

// page
$tpl->set_param("sel_cat", 0);
$tpl->set_param("page_title", "Últimos mods");
$tpl->load("head");
$tpl->load("index");
$tpl->load("footer");
$tpl->output();
?>

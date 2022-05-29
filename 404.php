<?php

// core functions
include_once "core.php";

// no session check needed

// page
$tpl->set_param("sel_cat", -1);
$tpl->set_param("page_title", "Não encontrado");
$tpl->load("head");
$tpl->load("404");
$tpl->load("footer");
$tpl->output();
?>

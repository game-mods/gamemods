<?php

// core functions
include_once "core.php";

// no session check needed

// page
$tpl->set_param("sel_cat", -1);
$tpl->set_param("page_title", "Política de Privacidade");
$tpl->load("head");
$tpl->load("privacy");
$tpl->load("footer");
$tpl->output();
?>

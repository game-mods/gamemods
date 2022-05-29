<?php

// core functions
include_once "core.php";

// session check
seg(2);

// get curret user session information
$user = new user();
$user->load(UID, "uid");

// set page params
$tpl->set_param("email", $user->email);
$tpl->set_param("location", $user->location);
$tpl->set_param("website", $user->website);
$tpl->set_param("about_me", $user->about_me);
$tpl->set_param("cpass", $user->password);
$tpl->set_param("avatar", $user->avatar);
$tpl->set_param("mfs_image", $config["mfs_image"]);

// page
$tpl->set_param("sel_cat", -1);
$tpl->set_param("page_title", "Configurações de Conta");
$tpl->load("head");
$tpl->load("settings");
$tpl->load("footer");
$tpl->output();
?>

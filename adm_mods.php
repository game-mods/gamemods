<?php

// core functions
include_once "core.php";

// session check
seg(3);

// pagination page id
if(isset($_GET["pid"]) && is_numeric($_GET["pid"]) && $_GET["pid"] != 0){ $mods->page_id = $_GET["pid"]; } else { $mods->page_id = 1; }

// mod list type
$type = (isset($_GET["type"]))?$_GET["type"]:1;

switch($type)
{
	// all mods
	case 1:
	$pname = "Todos os mods";
	$mods->page_query = 'mid != 0 ORDER BY mid DESC';
	break;

	// approved
	case 2:
	$pname = "Mods aprovados";
	$mods->page_query = 'status = 1 ORDER BY mid DESC';
	break;

	// pending
	case 3:
	$pname = "Mods pendentes";
	$mods->page_query = 'status = 0 ORDER BY mid DESC';
	break;

	// rejected
	case 4:
	$pname = "Mods rejeitados";
	$mods->page_query = 'status = 2 ORDER BY mid DESC';
	break;

	// resent
	case 5:
	$pname = "Reenviar Mods";
	$mods->page_query = 'status = 3 ORDER BY last_edited DESC';
	break;

	// last edited (approved)
	case 6:
	$pname = "Último Editado";
	$mods->page_query = 'status = 1 ORDER BY last_edited DESC';
	break;

	default: header("Location: ".SITE_URL."404"); break;
}

// page settings
$mods->page_no_results = "Nenhum mod aqui no momento.";
$mods->pagination_url = 'adm_mods?type='.$type.'&pid=';

// set page parameters
$tpl->set_param("mods_list", $mods->adm_uploads(), true);
$tpl->set_param("pagination", $mods->pagn());

// page
$tpl->set_param("mo_id", $type);
$tpl->set_param("sel_cat", 1);
$tpl->set_param("page_title", $pname);
$tpl->load("adm_head");
$tpl->load("adm_mods");
$tpl->load("adm_footer");
$tpl->output();
?>

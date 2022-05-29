<?php

// core functions
include_once "core.php";

// security check
seg(3);

$term = "";
$pagn = "";
$results = '<font color="#666">Você deve inserir um nome válido!</font>';

// search can't be empty
if(isset($_GET["term"]) || !empty($_GET["term"]))
{
	// search term
	$term = filter($_GET["term"]);

	// check if search name/value is empty
	if(empty($term))
	{
		$results = '<div class="msg mt_e">Sua pesquisa não pode estar vazia.</div>';
	}
	else
	{
		// pagination id
		if(isset($_GET["pid"]) && is_numeric($_GET["pid"]) && $_GET["pid"] != 0){ $mods->page_id = $_GET["pid"]; } else { $mods->page_id = 1; }

		// page settings
		$mods->page_query = 'name LIKE "%'.$term.'%" ORDER BY mid DESC';
		$mods->page_no_results = "Nenhum mod foi encontrado para esta busca. Tente novamente com outros termos!";
		$mods->pagination_url = 'adm_search?term='.$term.'&pid=';

		// load mods
		$results = $mods->adm_uploads();
		$pagn = $mods->pagn();

	}
}

// page params
$tpl->set_param("term", $term);
$tpl->set_param("results", $results, true);
$tpl->set_param("pagination", $pagn);

// page
$tpl->set_param("sel_cat", 1);
$tpl->set_param("page_title", "Resultados para: ".$term);
$tpl->load("adm_head");
$tpl->load("adm_search");
$tpl->load("adm_footer");
$tpl->output();
?>

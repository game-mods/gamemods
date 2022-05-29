<?php

// core functions
include_once "core.php";

// check if is a valid ajax request
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
	// ajax identification number
	$aid = filter($_POST["aid"]);

	switch($aid)
	{
		// user login
		case 1:
		$jsn["OK"] = false;

		// check if user is already logged
		if(!ONLINE)
		{
			// variables
			$username = filter($_POST["username"]);
			$password = filter($_POST["pass"]);

			// check empty files
			if(empty($username) || empty($password))
			{
				$jsn["msg"] = "Existem campos vazios.";
			}
			else
			{
				// try to login user
				$user = new user();
				$jsn = $user->login($username, $password);
			}
		}
		else
		{
			$jsn["msg"] = "Você já está logado. Atualize a página!";
		}
		break;

		// create a new account
		case 2:
		if(!ONLINE)
		{
			// variables
			$username = filter($_POST["username"]);
			$email    = filter($_POST["email"]);
			$pass1    = filter($_POST["pass1"]);
			$pass2    = filter($_POST["pass2"]);

			// check empty fields
			if(empty($username) || empty($email) || empty($pass1) || empty($pass2))
			{
				$jsn["msg"] = "Existem campos vazios.";
			}
			// check if email is valid
			elseif(!preg_match('/@.+\./', $email))
			{
				$jsn["msg"] = "Insira um e-mail válido.";
			}
			// check if password is valid
			elseif(strlen($pass1) < 6 || strlen($pass1) > 20)
			{
				$jsn["msg"] = "Sua senha deve ter no mínimo 6 caracteres e no máximo 20.";
			}
			// check if passwords match
			elseif($pass1 != $pass2)
			{
				$jsn["msg"] = "As senhas não coincidem!";
			}
			// check if username has spaces
			elseif(preg_match('/\s/',$username))
			{
				$jsn["msg"] = "O nome de usuário não deve ter espaços!";
			}
			// check if username is valid
			elseif(!preg_match('/^[a-z\d_]{3,20}$/i', $username))
			{
				$jsn["msg"] = "O nome de usuário deve conter apenas valores alfanuméricos, com no mínimo 3 caracteres e no máximo 20 caracteres.";
			}
			else
			{
				// try to create account
				$user = new user();
				$jsn = $user->register($username, $email, $pass1);
			}
		}
		else
		{
			$jsn["msg"] = "Você não pode criar uma nova conta enquanto estiver online.";
		}
		break;

		// update account settings
		case 3:
		if(ONLINE)
		{
			// variables
			$location = filter($_POST["location"]);
			$website  = filter($_POST["website"]);
			$about_me = filter($_POST["about_me"]);

			// update data
			$user = new user();
			$jsn = $user->update_account($location, $website, $about_me);
		}
		else
		{
			// must be online message
			$jsn["msg"] = "Você deve estar online para atualizar as informações da conta.";
		}
		break;

		// change account password
		case 4:
		if(ONLINE)
		{
			$jsn["pass"] = "";

			// variables
			$cpass_key = filter($_POST["cpass"]);
			$current_pass = filter($_POST["pass0"]);
			$pass1 = filter($_POST["pass1"]);
			$pass2 = filter($_POST["pass2"]);

			// check empty fields
			if(empty($cpass_key))
			{
				$jsn["msg"] = "Não foi possível ler [CPASS KEY], por favor, atualize a página.";
			}
			elseif(empty($current_pass) || empty($pass1) || empty($pass2))
			{
				$jsn["msg"] = "Existem campos vazios.";
			}
			// check current password
			elseif(md5($current_pass) != $cpass_key)
			{
				$jsn["msg"] = "Senha atual incorreta, tente novamente.";
			}
			// check if new password is valid
			elseif(strlen($pass1) < 6 || strlen($pass1) > 20)
			{
				$jsn["msg"] = "Sua nova senha deve ter no mínimo 6 caracteres e no máximo 20.";
			}
			// check if new passwords match
			elseif($pass1 != $pass2)
			{
				$jsn["msg"] = "As senhas não coincidem!";
			}
			else
			{
				// try to change password in database
				$user = new user();
				$jsn = $user->change_password($pass1);
			}
		}
		else
		{
			// must be online message
			$jsn["msg"] = "Você deve estar online para alterar a senha da conta.";
		}
		break;

		// update profile picture
		case 5:
		$jsn["OK"] = false;

		if(ONLINE)
		{
			// variables
			$img = $_POST["image"];

			// upload class
			include_once "inc/class.upload.php";

			// upload image to server
			$up = new upload("avatar");
			$image_id = $up->save_image($img);

			if($image_id != null)
			{
				$user = new user();
				$jsn = $user->update_picture($image_id);
			}
			else
			{
				$jsn["msg"] = "Erro durante o upload da imagem, tente novamente com outra imagem.";
			}
		}
		else
		{
			// must be online message
			$jsn["msg"] = "Você deve estar online para atualizar a foto do perfil.";
		}
		break;

		// upload mod screeshot
		case 6:
		$jsn["OK"] = false;

		if(ONLINE)
		{
			// variables
			$img = $_POST["image"];

			// upload class
			include_once "inc/class.upload.php";

			// upload image to server
			$up = new upload("image");
			$image_id = $up->save_image($img);

			if($image_id != null)
			{
				$jsn["OK"] = true;
				$jsn["img_id"] = $image_id;
				$jsn["img_url"] = SITE_URL.$up->dir.$image_id.'_thumb.jpg';
			}
			else
			{
				$jsn["msg"] = "Erro durante o upload da imagem, tente novamente com outra imagem.";
			}
		}
		else
		{
			// must be online message
			$jsn["msg"] = "Você deve estar online para adicionar uma captura de tela, por favor, atualize a página.";
		}
		break;

		// upload file
		case 7:
		$jsn["OK"] = false;

		if(ONLINE)
		{
			// variables
			$file = $_FILES["file"];

			// check file errors
			if(0 < $file['error'])
			{
				// treat upload errors
				switch($file["error"])
				{
					case 1: $msg = 'O arquivo excede a diretiva PHP <b>upload_max_filesize</b> (em php.ini).<br>O tamanho máximo permitido do arquivo do servidor atual é: <b>'.ini_get('upload_max_filesize').'B</b>.'; break;
					case 2: $msg = 'O arquivo carregado excede a diretiva MAX_FILE_SIZE especificada no formulário HTML.'; break;
					case 3: $msg = 'O arquivo carregado foi carregado apenas parcialmente.'; break;
					case 4: $msg = 'Nenhum arquivo foi carregado.'; break;
					case 5: $msg = ''; break;
					case 6: $msg = 'Faltando uma pasta temporária.'; break; // PHP 5.0.3
					case 7: $msg = 'Falha ao gravar arquivo no disco.'; break; // PHP 5.1.0
					case 8: $msg = 'Uma extensão PHP interrompeu o upload do arquivo'; break; // PHP 5.2.0
				}

				$jsn["msg"] = $msg;
			}
			else
			{
				// upload class
				include_once "inc/class.upload.php";

				// upload file to server
				$up = new upload("file");

				if($up->save_file($file) != false)
				{
					// success, return json parameters
					$jsn["OK"] = true;
					$jsn["file_id"] = $up->name;
				}
				else
				{
					// file upload error message
					$jsn["msg"] = "Erro durante o upload do arquivo, por favor, entre em contato com a administração.";
				}
			}
		}
		else
		{
			// must be online message
			$jsn["msg"] = "Você deve estar online para fazer upload de um arquivo, por favor, atualize a página.";
		}
		break;

		// upload mod
		case 8:
		$jsn["OK"] = false;

		if(ONLINE)
		{
			// variables
			$mods->name     = filter($_POST["filename"]);
			$mods->version  = filter($_POST["version"]);
			$mods->author   = filter($_POST["author"]);
			$mods->category = filter($_POST["category"]);
			$mods->description = $mods->filter_desc($_POST["description"]);
			$mods->file_id  = filter($_POST["file_id"]);
			$seo = filter($_POST["seo"]);

			if($mods->category == 0)
			{
				$jsn["msg"] = "Selecione uma categoria de mod válida.";
			}
			else if(empty($mods->name) || empty($mods->author) || empty($mods->description))
			{
				$jsn["msg"] = "Existem campos vazios.";
			}
			elseif(empty($seo))
			{
				$jsn["msg"] = "O ID de SEO não foi encontrado, por favor, atualize a página e tente novamente.";
			}
			elseif(empty($mods->file_id))
			{
				$jsn["msg"] = "O ID do arquivo carregado não foi encontrado. Atualize a página e tente novamente. Ou entre em contato com a administração se o problema persistir.";
			}
			elseif(count($_POST["imgPic"]) == 0)
			{
				$jsn["msg"] = "Você deve enviar pelo menos uma captura de tela.";
			}
			else
			{
				// check seo
				$mods->seo = $mods->check_seo($seo);

				// format screenshots
				$mods->format_images($_POST["imgPic"]);

				// try to upload a new mod
				$jsn = $mods->upload();
			}
		}
		else
		{
			// must be online message
			$jsn["msg"] = "Você deve estar online para fazer upload de um mod, por favor, atualize a página.";
		}
		break;

		// add a comment
		case 9:
		$jsn["OK"] = false;

		if(ONLINE)
		{
			// variables
			$mod_id = filter($_POST["mod_id"]);
			$comment = filter($_POST["comment"]);

			// check mod id
			if(empty($mod_id) || !is_numeric($mod_id))
			{
				$jsn["msg"] = "Parâmetro MOD ID inválido, não foi possível comentar. Recarregue a página!";
			}
			// check comment
			elseif(empty($comment))
			{
				$jsn["msg"] = "Seu comentário não pode estar vazio.";
			}
			else
			{
				// try to add the comment
				$jsn = $mods->add_comment($mod_id, $comment);
			}
		}
		else
		{
			// must be online message
			$jsn["msg"] = "Você deve estar online para comentar. <a href=\"login\">Faça login agora!</a>";
		}
		break;

		// load more comments based on last comment id
		case 10:
		$jsn["OK"] = false;

		// variables
		$mod_id = filter($_POST["mod_id"]);
		$last_id = filter($_POST["last_id"]);

		// check if mod id is valid
		if(!empty($mod_id))
		{
			// check last comment id
			if(empty($last_id) || !is_numeric($last_id))
			{
				$jsn["msg"] = "ID de página inválido. Recarregue a página!";
			}
			else
			{
				// load comments html
				$jsn["OK"] = true;
				$jsn["html"] = $mods->load_comments($mod_id, $last_id);
			}
		}
		else
		{
			// error message
			$jsn["msg"] = "ID de mod inválido. Recarregue a página!";
		}
		break;

		// remove a comment
		case 11:
		$jsn["OK"] = false;

		if(ONLINE)
		{
			// variables
			$comment_id = filter($_POST["cid"]);

			// try to remove comment
			$jsn = $mods->remove_comment($comment_id);
		}
		else
		{
			// must be online message
			$jsn["msg"] = "Você deve estar online para remover um comentário.";
		}
		break;

		// edit a mod
		case 12:
		$jsn["OK"] = false;

		if(ONLINE)
		{
			// variables
			$mods->id = filter($_POST["mid"]);
			$mods->name = filter($_POST["filename"]);
			$mods->version = filter($_POST["version"]);
			$mods->author = filter($_POST["author"]);
			$mods->category = filter($_POST["category"]);
			$mods->description = $mods->filter_desc($_POST["description"]);
			$mods->file_id  = filter($_POST["file_id"]);

			if(empty($mods->id))
			{
				$jsn["msg"] = "Mod ID inválido, atualize a página.";
			}
			elseif($mods->category == 0)
			{
				$jsn["msg"] = "Selecione uma categoria de mod válida.";
			}
			elseif(empty($mods->name) || empty($mods->author) || empty($mods->description))
			{
				$jsn["msg"] = "Existem campos vazios.";
			}
			elseif(empty($mods->file_id))
			{
				$jsn["msg"] = "O ID do arquivo carregado não foi encontrado. Atualize a página e tente novamente. Ou entre em contato com a administração se o problema persistir.";
			}
			elseif(count($_POST["imgPic"]) == 0)
			{
				$jsn["msg"] = "Você deve enviar pelo menos uma captura de tela.";
			}
			else
			{
				// format images
				$mods->format_images($_POST["imgPic"]);

				// try to update the mod
				$jsn = $mods->update();
			}
		}
		else
		{
			$jsn["msg"] = "Você deve estar online para editar um mod. <a href=\"login\">Faça login aqui &raquo;</a>";
		}
		break;

		// save admin notes
		case 13:
		if(RANK == 2)
		{
			// try to update admin notes
			if(file_put_contents(ADM_NOTES, filter($_POST["notes"])) !== false)
			{
				$jsn["msg"] = "Notas do administrador salvas!";
			}
			else
			{
				// error message
				$jsn["msg"] = "Erro: Não foi possível atualizar as notas do administrador, verifique se o caminho está correto no arquivo <b>inc.vars.php</b>!";
			}
		}
		else
		{
			// must be online/admin message
			$jsn["msg"] = "Você deve estar online/ser administrador para atualizar as notas.";
		}
		break;

		// save admin website settings
		case 14:
		if(RANK == 2)
		{
			global $db;

			// variables
			$site_name = filter($_POST["site_name"]);
			$site_domain = filter($_POST["site_domain"]);
			$meta_desc = filter($_POST["description"]);
			$meta_keys = filter($_POST["keywords"]);
			$site_footer = $db->con->real_escape_string($_POST["site_footer"]);
			$mpp = filter($_POST["mpp"]);
			$cpl = filter($_POST["cpl"]);
			$noi = filter($_POST["noi"]);
			$max_upload = filter($_POST["max_upload"]);
			$max_image = filter($_POST["max_image"]);

			// check if there are empty fields
			if(empty($site_name) || empty($site_domain) || empty($site_footer) || empty($mpp))
			{
				$jsn["msg"] = "Existem campos vazios.";
			}
			// check if 'mods per page' is an integer
			elseif(!is_numeric($mpp))
			{
				$jsn["msg"] = "Os mods por página devem ser um número.";
			}
			// check if 'comments per loading' is an integer
			elseif(!is_numeric($cpl))
			{
				$jsn["msg"] = "Os comentários por carregamento devem ser um número.";
			}
			// check if 'number of images' is an integer
			elseif(!is_numeric($noi))
			{
				$jsn["msg"] = "O número máximo de imagens da galeria deve ser um número.";
			}
			// check the max number of images allowed for galleries
			elseif($noi == 0)
			{
				$jsn["msg"] = "O número máximo de imagens da galeria não pode ser zero.";
			}
			// check max upload file size for mods
			elseif(!is_numeric($max_upload) || $max_upload == 0)
			{
				$jsn["msg"] = "O tamanho máximo do arquivo de upload deve ser um número e diferente de 0.";
			}
			// check max upload file size for images
			elseif(!is_numeric($max_image) || $max_image == 0)
			{
				$jsn["msg"] = "O tamanho máximo do arquivo das imagens deve ser um número e diferente de 0.";
			}
			else
			{
				// update website settings values on database
				if(dbquery('UPDATE config SET site_name = "'.$site_name.'", site_url = "'.$site_domain.'", site_desc = "'.$meta_desc.'", site_keys = "'.$meta_keys.'", site_footer = "'.$site_footer.'", mpp = '.$mpp.', cpl = '.$cpl.', noi = '.$noi.', mfs_upload = '.$max_upload.', mfs_image = '.$max_image.''))
				{
					$jsn["msg"] = "Configurações do site salvas!";
				}
				else
				{
					// db error message
					$jsn["msg"] = "Erro de banco de dados, não foi possível atualizar as configurações do site.";
				}
			}
		}
		else
		{
			// must be online/admin message
			$jsn["msg"] = "Você deve estar online/de administrador para atualizar as configurações do site.";
		}
		break;

		// save website ads
		case 15:

		// user must be admin
		if(RANK == 2)
		{
			global $db;

			// variables
			$ads_status = filter($_POST["enable_ads"]);
			$adsense = $db->con->real_escape_string($_POST["adsense_code"]);
			$adcode_1 = $db->con->real_escape_string($_POST["adcode1"]);
			$adcode_2 = $db->con->real_escape_string($_POST["adcode2"]);
			$adcode_3 = $db->con->real_escape_string($_POST["adcode3"]);

			// check if 'enabled ads' is valid
			if($ads_status == 0 || $ads_status == 1)
			{
				// try to update website ads settings
				if(dbquery('UPDATE config SET ads_status = '.$ads_status.', adsense_code = "'.$adsense.'", ads_1 = "'.$adcode_1.'", ads_2 = "'.$adcode_2.'", ads_3 = "'.$adcode_3.'"'))
				{
					$jsn["msg"] = "Anúncios salvos!";
				}
			}
			else
			{
				// invalid ads value
				$jsn["msg"] = "Valor inválido de 'Ativar anúncios', atualize a página.";
			}
		}
		else
		{
			// must be online/admin message
			$jsn["msg"] = "Você deve estar online/ser administrador para atualizar os anúncios do site.";
		}
		break;

		// admin mod edit
		case 16:

		$jsn["OK"] = false;

		// user must be admin
		if(RANK == 2)
		{
			// item variables
			$mods->id = filter($_POST["mid"]);
			$mods->name = filter($_POST["filename"]);
			$mods->version = filter($_POST["version"]);
			$mods->author = filter($_POST["author"]);
			$mods->category = filter($_POST["category"]);
			$mods->description = $mods->filter_desc($_POST["description"]);
			$mods->file_id = filter($_POST["file_id"]);

			// item settings variables
			$mods->status = filter($_POST["status"]);
			$mods->reason = filter($_POST["reason"]);
			$mods->seo = filter($_POST["seo"]);
			$mods->downloads = filter($_POST["downs"]);

			// check if mod id is valid
			if(empty($mods->id))
			{
				$jsn["msg"] = "Mod ID inválido, atualize a página.";
			}
			// check if category is empty
			elseif($mods->category == 0)
			{
				$jsn["msg"] = "Selecione uma categoria de mod válida.";
			}
			// check if important fields are empty
			elseif(empty($mods->name) || empty($mods->author) || empty($mods->description))
			{
				$jsn["msg"] = "Existem campos vazios.";
			}
			// check if file id is valid
			elseif(empty($mods->file_id))
			{
				$jsn["msg"] = "O ID do arquivo carregado não foi encontrado. Atualize a página e tente novamente. Ou entre em contato com a administração se o problema persistir.";
			}
			// check if seo is valid
			elseif(empty($mods->seo))
			{
				$jsn["msg"] = "O URL de SEO não pode estar vazio.";
			}
			// total downloads can't be empty
			elseif($mods->downloads == "")
			{
				$jsn["msg"] = "Insira um número de downloads válido.";
			}
			// check if mod status is valid
			elseif($mods->status < 0 || $mods->status > 3)
			{
				$jsn["msg"] = "ID de status inválido, atualize a página.";
			}
			elseif($mods->status == 2 && empty($mods->reason))
			{
				$jsn["msg"] = "Você deve inserir um motivo pelo qual o mod foi rejeitado.";
			}
			// should upload at least one screenshot
			elseif(count($_POST["imgPic"]) == 0)
			{
				$jsn["msg"] = "Você deve enviar pelo menos uma captura de tela.";
			}
			else
			{
				// format images
				$mods->format_images($_POST["imgPic"]);

				// update mods informations
				$jsn = $mods->adm_update_mod();
			}
		}
		else
		{
			// must be online/admin message
			$jsn["msg"] = "Você deve estar online/ser administrador para atualizar um mod.";
		}
		break;

		// adm edit user
		case 17:

		// user must be admin
		if(RANK == 2)
		{
			// variables
			$uid = filter($_POST["uid"]);
			$rank = filter($_POST["rank"]);
			$location = filter($_POST["location"]);
			$about_me = filter($_POST["about"]);
			$website = filter($_POST["website"]);
			$avatar = filter($_POST["avatar"]);

			if(empty($avatar)){ $avatar = "default"; }

			// check if admin is trying to change it's rank to normal user
			if($uid == UID && $rank == 1)
			{
				$jsn["msg"] = 'Como administrador, você não pode alterar sua classificação de administrador para usuário normal.';
			}
			// check if admin is trying to ban itself
			elseif($uid == UID && $rank == 0)
			{
				$jsn["msg"] = 'Como administrador, você não pode se banir.';
			}
			// try to update user's informations
			else if(dbquery('UPDATE users SET rank = '.$rank.', location = "'.$location.'", about = "'.$about_me.'", website = "'.$website.'", avatar = "'.$avatar.'" WHERE uid = '.$uid))
			{
				$jsn["msg"] = 'Usuário atualizado com sucesso!';
			}
			else
			{
				// database error message
				$jsn["msg"] = "Erro de banco de dados! Não foi possível atualizar os dados do usuário.<br>Atualize a página!";
			}
		}
		else
		{
			// must be online/admin message
			$jsn["msg"] = "Você deve estar online/ser administrador para atualizar uma conta de usuário.";
		}
		break;

		// delete a mod from database
		case 18:
		$jns["OK"] = false;

		// user must be admin
		if(RANK == 2)
		{
			// variables
			$mid = filter($_POST["mid"]);

			// check agreement (this avoid user to delete by mistake)
			if(!isset($_POST["verify"]))
			{
				$jsn["msg"] = 'Você deve concordar em excluir primeiro (caixa de seleção).';
			}
			else
			{
				// try to delete the mod from database
				if(dbquery('DELETE FROM mods WHERE mid = '.$mid))
				{
					// try to delete mod comments
					dbquery('DELETE FROM comments WHERE mod_id = '.$mid);
					$jsn["OK"] = true;
				}
				else
				{
					// database error message
					$jsn["msg"] = 'Erro de banco de dados, não foi possível remover o mod ou já foi removido!';
				}
			}
		}
		else
		{
			// must be online/admin message
			$jsn["msg"] = "Você deve estar online/ser administrador para excluir um mod.";
		}
		break;
	}

	// send response as json format
	die(json_encode($jsn));
}
else
{
	// it's not an ajax request, redirect to homepage
	header("Location: ".SITE_URL); exit;
}

?>

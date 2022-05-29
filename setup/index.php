<?php

// check if installation step is valid
if(isset($_GET["step"]) && is_numeric($_GET["step"]) && $_GET["step"] != 0){ $step = $_GET["step"]; } else { $step = 1; }
if($step > 5 || $step < 1){ $step = 1; }

// get current website url/domain
function url(){ return sprintf("%s://%s%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME'], $_SERVER['REQUEST_URI']); }
?>
<html>
<head>
   <title>GameMods | Setup</title>
   <meta charset="utf-8" />
   <link rel="stylesheet" href="setup_style.css" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
   <script src="setup_scripts.js"></script>
   <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
   <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body spellcheck="false">
<div class="marg">
   <div class="wbox">
      <div class="top"><img src="setup_logo.png"></div>
<?php if($step == 1){ ?>
   <h2>Bem-vindo</h2>
   Olá, obrigado por usar o script GameMods.<br>
   Estamos honrados em servir a você o melhor sistema de gerenciamento de conteúdo de mods de jogos.<br>
   Vamos começar, estamos prontos para instalar! Se você tiver problemas, por favor, entre em contato conosco.<br><br>
   Nos próximos passos vamos:
   <ul>
      <li>Conecte-se ao banco de dados MySQL <small>(Lembre-se de criar um novo banco de dados vazio)</small></li>
      <li>Definir as configurações do site</li>
      <li>Criar uma conta de administrador</li>
   </ul><br>
   <a class="btn blue" href="index.php?step=2">Começar &raquo;</a>
<?php } elseif($step == 2) { ?>
   <h2>1 - Conecte-se ao banco de dados MySQL</h2>
   <div class="msg"></div>
   Antes de preencher os detalhes do banco de dados, primeiro você deve criar um banco de dados vazio.<br>Após a criação do banco de dados, você pode inserir os detalhes da conexão do banco de dados. Se você não sabe, entre em contato com seu programdor.
   <form>
      <table>
      <tbody>
         <tr><td>URL do banco de dados:</td><td><input type="text" name="host" autocomplete="off" placeholder="localhost"></td></tr>
         <tr><td>Nome de usuário:</td><td><input type="text" name="username" autocomplete="off"></td></tr>
         <tr><td>Senha:</td><td><input type="password" name="pass" autocomplete="off"></td></tr>
         <tr><td>Nome do banco de dados:</td><td><input type="text" name="name" autocomplete="off"></td></tr>
      </tbody>
      </table>
      <input type="button" value="Continuar &raquo;" onClick="cmd(2, this.form);"> <img id="loading" src="loading.gif">
      <br><br><small>Após clicar no botão <b>Continuar</b>, o processo pode demorar um minuto, seja paciente.</small>
   </form>
<?php } elseif($step == 3) { ?>
   <h2>2 - Configurações do site</h2>
   <div class="msg"></div>
   Banco de dados MySQL conectado com sucesso! Agora vamos definir os detalhes do site.<br>
   Você pode alterar alguns detalhes posteriormente usando o painel de administração.
   <form>
      <table>
      <tbody>
         <tr><td>Nome do site:</td><td><input type="text" name="name" autocomplete="off" placeholder="Meu website"></td></tr>
         <tr><td>URL do site:</td><td><input value="<?php echo str_replace("setup/index.php?step=3", "", url()); ?>" type="text" name="url" autocomplete="off" placeholder="http://mysite.com/"><br><small>Com a barra final (/).</small></td></tr>
         <tr><td>Descrição</td><td><textarea style="width:300px; height:60px;" name="desc"></textarea><br><small>Apenas uma descrição simples sobre o site.</small></td></tr>
         <tr><td>Palavras-chave:</td><td><input maxlength="199" type="text" name="keywords" autocomplete="off" placeholder="por exemplo. mods, jogos, upload, pc"></td></tr>
      </tbody>
      </table>
      <input type="button" value="Continuar &raquo;" onClick="cmd(3, this.form);"> <img id="loading" src="loading.gif">
   </form>
<?php } elseif($step == 4) { ?>
   <h2>3 - Conta de administrador</h2>
   <div class="msg"></div>
   Estamos quase terminando, agora precisamos criar a conta de administrador.<br>
   Você poderá alterar alguns detalhes mais tarde.
   <form>
      <table>
      <tbody>
         <tr><td>Nome de usuário:</td><td><input type="text" name="username" maxlength="15" autocomplete="off"></td></tr>
         <tr><td>E-mail:</td><td><input type="text" name="email" autocomplete="off"></td></tr>
         <tr><td>Senha:</td><td><input type="password" name="pass1" autocomplete="off"></td></tr>
         <tr><td>Confirme a Senha:</td><td><input type="password" name="pass2" autocomplete="off"></td></tr>
      </tbody>
      </table>
      <input type="button" value="Continuar &raquo;" onClick="cmd(4, this.form);"> <img id="loading" src="loading.gif">
   </form>
<?php } elseif($step == 5) { ?>
   <h2>Parabéns!</h2>
   Você instalou com sucesso o script GameMods, seu site de mods de jogo está pronto para uso! Se você precisar de suporte, ou se encontrar bugs, por favor, entre em contato conosco.
   <div class="warn">Por motivos de segurança, renomeie a pasta de configuração. Isso evitará que pessoas mal intencionadas reinstalem o script sem sua permissão.</div>
   <center><a class="btn blue" onClick="redir('../');">Ir para o site</a></center>
<?php } ?>
   </div>
   <div class="footer">
      2022 &copy; <a href="https://game-mods.github.io/" target="_blank">GameMods</a><br>
      Problemas de instalação? Leia a documentação ou <a href="https://game-mods.github.io/" target="_blank">entre em contato</a>.
   </div>
</div>
</body>
</html>

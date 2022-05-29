<div class="marg access">
   <div class="wbox">
      <center><h2>Cadastro</h2></center>
      <form class="signup_form" id="signup" style="padding:0px 50px;" onsubmit="return false;">
         <label>Nome do usuário: <input name="username" class="w380" type="text" maxlength="25"></label>
         <label>E-mail: <input name="email" class="w380" type="text" maxlength="60"></label>
         <label>Senha: <input name="pass1" maxlength="30" class="w380" type="password"></label>
         <label>Confirme sua senha: <input name="pass2" maxlength="30" class="w380" type="password"></label>
         <div id="terms">Ao clicar em "Registrar", você concorda com nossos <a href="terms" target="_blank">Termos</a> e <a href="privacy" target="_blank">Política de Privacidade</a>.</div>
         <input id="register_btn" type="button" value="Registrar" onclick="signup(this.form, this);">
      </form><br><br>
      <div class="not">Já registrado ? <b><a href="login">Clique aqui</a></b> para fazer login!</div>
   </div>
   <style>.footer{text-align:center;}</style>
   <script>$('.signup_form input[type="text"], .signup_form input[type="password"]').on('keypress', function(e){ if(e.which === 13){ $("#register_btn").click();}});</script>
</div>

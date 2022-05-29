<div class="marg access">
   <div class="wbox" style="margin:35px 0px 65px 0px;">
      <h2>Login</h2>
      <form class="login_form" id="login" onsubmit="return false;">
         <input name="username" type="text" class="w200" required="required" placeholder="Nome do usuário" value="">&nbsp;&nbsp;
         <input name="pass" type="password" class="w200" required="required" placeholder="Senha">
         <input type="button" value="Login" id="login_btn" onclick="login(this.form, this);">
      </form><br><br>
      <div class="not">Não tem uma conta? <b><a href="signup">Clique aqui</a></b> para criar!</div>
   </div>
   <style>.footer{text-align:center;}</style>
   <script>$('.login_form input[type="text"], .login_form input[type="password"]').on('keypress', function(e){ if(e.which === 13){ $("#login_btn").click();}});</script>
</div>

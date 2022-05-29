<div class="marg default-gray settings">
   <script>var MFS_IMAGE = %mfs_image%;</script>
   <h2>Configurações</h2>
   <div class="cf">

      <div class="wlft">
         <div class="wbox s_menus">
            <a class="sel" menu-tab="account">Conta</a>
            <a menu-tab="pass">Alterar senha</a>
            <a menu-tab="picture">Alterar imagem</a>
         </div>
      </div>

      <div class="wrgt">
         <div class="wbox">

            <div id="s_account" class="s_divs">
               <h3>Configurações de Conta</h3>
               <form onsubmit="return false;">
               <table>
                  <tr><td>Nome do usuário:</td><td><input type="text" readonly="readonly" value="%username%"><small>Você não pode alterar seu nome de usuário.</small></td></tr>
                  <tr><td>E-mail:</td><td><input type="text" readonly="readonly" value="%email%"><small>Você não pode alterar seu e-mail.</small></td></tr>
                  <tr><td>Localização:</td><td><input type="text" name="location" maxlength="70" value="%location%"></td></tr>
                  <tr><td>Website:</td><td><input type="text" name="website" maxlength="100" value="%website%"></td></tr>
                  <tr><td>Sobre mim:</td><td><textarea name="about_me" maxlength="300">%about_me%</textarea></td></tr>
                  <tr><td></td><td><input type="button" value="Salvar alterações" onclick="update_account(this.form, this);"></td></tr>
               </table>
               </form>
            </div>

            <div id="s_pass" class="s_divs" style="display:none;">
               <h3>Alterar a senha</h3>
               <form onsubmit="return false;" id="cpass_form">
               <input id="cpass_key" type="hidden" name="cpass" value="%cpass%">
               <table>
                  <tr><td>Senha atual:</td><td><input type="password" name="pass0"></td></tr>
                  <tr><td>Nova Senha:</td><td><input type="password" name="pass1" maxlength="25"><small>Sua nova senha deve ter pelo menos 6 caracteres.</small></td></tr>
                  <tr><td>Repita a nova senha:</td><td><input type="password" name="pass2" maxlength="25"></td></tr>
                  <tr><td></td><td><input type="button" value="Salvar senha" onclick="change_password(this.form, form);"></td></tr>
               </table>
               </form>
            </div>

            <div id="s_picture" class="s_divs" style="display:none;">
               <h3>Alterar imagem</h3>
               <form>
               <table>
                  <tr>
                     <td><img src="%site_url%uploads/avatars/%avatar%_thumb.jpg" width="75" id="pic_preview"></td>
                     <td>Faça upload de uma foto de perfil personalizada<br><small>(somente .jpg ou .png; máximo de %mfs_image%mb; recomendado 256 x 256 pixels)</small><br><input id="prof_pic" name="file" type="file" accept="image/jpeg, image/png"></td>
                  </tr>
                  <tr><td></td><td><br><input type="button" value="Salvar" onclick="update_picture(this);"></td></tr>
               </table>
               </form>
            </div>

         </div>
      </div>

   </div>
</div>
<script>bind_settings_menus();</script>

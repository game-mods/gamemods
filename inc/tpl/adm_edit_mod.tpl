<script src="assets/jquery-ui.min.js"></script>
<script>var MFS_UPLOAD = %mfs_upload%, MFS_IMAGE = %mfs_image%;</script>
<div class="marg default-gray upload">
   <h2>Editando %mod_name%</h2>
   <div class="cf up_form">
      <form>
      <input type="hidden" name="mid" value="%mod_id%">
      <div class="lft">

         <div class="wbox mods_infos">
            <table>
               <tr>
                  <td style="padding-right:15px;"><b>File Name</b><input type="text" name="filename" value="%mod_name%"></td>
                  <td><b>Versão <small>(opcional)</small></b><input type="text" name="version" style="width:100px !important;" value="%version%"></td>
               </tr>
            </table>

            <b>Autor(a)</b>
            <input type="text" name="author" value="%author%" class="w420"><br>

            <b>Categoria</b>
            <select id="drop_cats" name="category" class="w420">
               <option value="1">Personagens</option>
               <option value="2">Objetos</option>
               <option value="3">Maps</option>
               <option value="4">Veículos</option>
               <option value="5">Armas</option>
               <option value="6">Scripts</option>
               <option value="7">Ferramentas</option>
               <option value="8">Diversos</option>
            </select>
            <br>

            <b>Descrição</b>
            <textarea rows="10" class="w420" placeholder="Forneça informações e instruções de instalação, se necessário..." name="description">%description%</textarea>
            <small>Tags HTML permitidas: &lt;b&gt;, &lt;i&gt;, &lt;u&gt;, &lt;a&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;</small>

         </div>

         <div class="wbox">
            <b>Carregue seu arquivo</b>
            <small>(.zip, .rar, .7z apenas; máximo %mfs_upload%mb)</small>
            <input type="hidden" name="file_id" id="file_id" value="%file_id%">
            <input id="mod_file" type="file" onchange="pre_up_mod(this);" style="display:none;">

            <div class="pre_up"></div>

            <div class="loading_up" id="gif_file">Carregando arquivo...</div>

            <div class="file_res" style="display: block;">Arquivo carregado: <a href="request/%file_id%" target="_blank">%file_id%</a> &nbsp;&nbsp;<small><a onclick="remove_up();">(remover)</a></small></div>

         </div>

         <div class="wbox">
            <div class="up_imgs">
               <b>Adicionar capturas de tela</b>
               <small>(somente .jpg ou .png; máximo %noi%; %mfs_image%mb cada)</small>
               <input id="mod_images" type="file" accept="image/jpeg, image/png" onchange="upload_screenshot(this, %noi%);">
            </div>

            <div class="loading_up" id="gif_image">Carregando captura de tela...</div>

            <div class="gallery cf">%gallery%</div>
         </div>

      </div>

      <div class="rgt">

         <div class="wbox emsets">
            <h3>Configurações do mod</h3>
            <small>Aqui você pode gerenciar as configurações do mod.</small><br><br>

            <b>Mod ID</b>
            <input value="%mod_id%" readonly="readonly" type="text" style="width:150px;"><small>Você não pode alterar o ID do mod.</small><br><br>

            <b>Mod Status</b>
            <select name="status" id="mod_status" onchange="status_change(this);"><option value="0">Pendente</option><option value="1">Aprovado</option><option value="2">Rejeitado</option><option value="3">Pendente (reenviado)</option></select>
            <textarea name="reason" id="rej_reason" placeholder="Motivo da rejeição: por que este mod foi rejeitado? Esta mensagem será mostrada ao mod uploader, na esperança de corrigir os problemas." rows="7">%reason%</textarea>
            <br>

            <b>Mod SEO</b>
            <input name="seo" value="%mod_seo%" type="text"><small>Recomendado não tocar.</small><br><br>

            <b>Código de upload do usuário <small>(<a href="edit_user?uid=%user_id%" target="_blank">View User</a>)</small></b>
            <input type="text" value="%user_id%" style="width:150px;" readonly="readonly"><small>Você não pode alterar o ID do remetente.</small><br><br>

            <b>Número de downloads</b>
            <input name="downs" value="%downs%" type="text" style="width:150px;"><small>Quantas vezes foi baixado este mod.</small><br><br>

         </div>

         <center><input type="button" value="Salvar alterações" class="up_btn" onclick="update_mod(this.form, this, 2);"> &nbsp; <a onclick="history.go(-1);" class="btn">Cancelar</a></center>

         <div class="wbox" style="margin-top:25px;">
            <b>Excluir mod</b><br>
            O mod será removido do banco de dados, incluindo os comentários dos usuários. Não tem volta!<br><br>
            <form>
               <input type="hidden" name="mid" value="%mod_id%">
               <label><input name="verify" type="checkbox"> Sim, eu quero excluir o mod para sempre<br><br></label>
               <input type="button" class="btn" onclick="delete_mod(this.form, this);" value="Excluir">
            </form>
         </div>

      </div>
      </form>
   </div>

   <script>adm_editing_mode(%cat_id%, %mod_status%);</script>
</div>

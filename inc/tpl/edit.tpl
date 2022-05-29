<script src="assets/jquery-ui.min.js"></script>
<script>var mod_seo = "%mod_seo%", MFS_UPLOAD = %mfs_upload%, MFS_IMAGE = %mfs_image%;</script>
<div class="marg default-gray upload">
   <h2>Editando %mod_name%</h2>
   <div class="cf up_form">
      <form>
      <input type="hidden" name="mid" value="%mod_id%">
      <div class="lft">

         <div class="wbox mods_infos">
            <table>
               <tr>
                  <td style="padding-right:15px;"><b>Nome do arquivo</b><input type="text" name="filename" value="%mod_name%"></td>
                  <td><b>Versão <small>(opcional)</small></b><input type="text" name="version" style="width:100px !important;" value="%version%"></td>
               </tr>
            </table>

            <b>Autor(a)</b>
            <input type="text" name="author" value="%author%" class="w420"><br>

            <b>Categoria</b>
            <select id="drop_cats" name="category" class="w420">
                <option value="1">Caracteres</option>
                <option value="2">Objetos</option>
                <option value="3">Mapas</option>
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

      </div>

      <div class="rgt">

         %reject_div%

         <div class="wbox">
            <b>Carregue seu arquivo</b>
            <small>(.zip, .rar, .7z apenas; máximo %mfs_upload%mb)</small>
            <input type="hidden" name="file_id" id="file_id" value="%file_id%">
            <input id="mod_file" type="file" onchange="pre_up_mod(this);" style="display:none;">

            <div class="pre_up"></div>

            <div class="loading_up" id="gif_file">Carregando arquivo...</div>

            <div class="file_res" style="display: block;">Arquivo carregado: %file_id% &nbsp;&nbsp;<small><a onclick="remove_up();">(remover)</a></small></div>

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

         <input type="button" value="Salvar alterações" class="up_btn" onclick="update_mod(this.form, this, %ebtn_id%);"> &nbsp; <a onclick="history.go(-1);" class="btn">Cancelar</a>

      </div>
      </form>
   </div>

   <div class="rules">
     <div class="wbox">
        <h3>Regras de envio</h3>
        <b>NÃO faça upload de nenhum dos itens a seguir - quebrar essas regras fará com que seu arquivo seja excluído sem aviso prévio:</b>
        <ul>
           <li>Quaisquer arquivos além dos arquivos .zip, .rar, .7z</li>
           <li>Qualquer arquivo que você não tenha permissão para enviar, incluindo parte de outros mods ou pacotes de mods</li>
           <li>Qualquer arquivo contendo apenas arquivos originais do jogo</li>
           <li>Qualquer arquivo que possa ser usado para trapacear online</li>
           <li>Qualquer arquivo que contenha ou dê acesso a conteúdo pirata ou protegido por direitos autorais, incluindo cracks de jogos, filmes, programas de televisão e música</li>
           <li>Qualquer arquivo que contenha vírus ou malware ou qualquer arquivo EXE com resultado antivírus positivo</li>
           <li>Qualquer arquivo que contenha imagens pornográficas de nudez ou seminua</li>
           <li>Qualquer arquivo que descreva uma figura política ou ideologia que seja, a critério completo do administrador, considerado algo que causará debates desnecessários na seção de comentários</li>
        </ul>
     </div>
   </div>
   <script>$(".gallery").sortable();$(".gallery").disableSelection(); $('#drop_cats').val(%cat_id%);</script>
</div>

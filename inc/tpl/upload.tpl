<script src="assets/jquery-ui.min.js"></script>
<script>var MFS_UPLOAD = %mfs_upload%, MFS_IMAGE = %mfs_image%;</script>
<div class="marg default-gray upload">
   <h2>Carregar um mod</h2>
   <div class="cf up_form">
      <form>
      <div class="lft">

         <div class="wbox mods_infos">
            <table>
               <tr>
                  <td style="padding-right:15px;"><b>Nome do arquivo</b><input type="text" name="filename" onkeyup="key_seo(this.value);"><input type="hidden" name="seo" id="seo_field" value=""></td>
                  <td><b>Versão <small>(opcional)</small></b><input type="text" name="version" style="width:100px !important;"></td>
               </tr>
            </table>

            <b>Autor(a)</b>
            <input type="text" name="author" value="%username%" class="w420"><br>

            <b>Categoria</b>
            <select name="category" class="w420">
               <option value="0" selected="">Selecione uma categoria...</option>
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
            <textarea rows="10" class="w420" placeholder="Forneça informações e instruções de instalação, se necessário..." name="description"></textarea>
            <small>Tags HTML permitidas: &lt;b&gt;, &lt;i&gt;, &lt;u&gt;, &lt;a&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;</small>

         </div>

      </div>

      <div class="rgt">
         <div class="wbox">
            <b>Carregue seu arquivo</b>
            <small>(.zip, .rar, .7z apenas; máximo %mfs_upload%mb)</small>
            <input type="hidden" name="file_id" id="file_id">
            <input id="mod_file" type="file" onchange="pre_up_mod(this);">

            <div class="pre_up"></div>

            <div class="loading_up" id="gif_file">Uploading file...</div>

            <div class="file_res"></div>

         </div>

         <div class="wbox">
            <div class="up_imgs">
               <b>Adicionar capturas de tela</b>
               <small>(somente .jpg ou .png; máximo %noi%; %mfs_image%mb cada)</small>
               <input id="mod_images" type="file" accept="image/jpeg, image/png" onchange="upload_screenshot(this, %noi%);">
            </div>

            <div class="loading_up" id="gif_image">Carregando captura de tela...</div>

            <div class="gallery cf"></div>
         </div>

         <input type="button" value="Carregar" class="up_btn" onclick="upload(this.form, this);"> &nbsp; <a href="home" class="btn">Cancelar</a>

      </div>
      </form>
   </div>

   <div class="rules">
      <div class="wbox">
         <h3>Regras de carregamento</h3>
         <b>NÃO carregue nenhum dos itens a seguir - quebrar essas regras fará com que seu arquivo seja excluído sem aviso prévio:</b>
         <ul>
            <li>Qualquer arquivo além dos arquivos .zip, .rar, .7z</li>
            <li>Qualquer arquivo que você não tenha permissão para enviar, incluindo parte de outros mods ou pacotes de mods</li>
            <li>Qualquer arquivo contendo apenas arquivos originais do jogo</li>
            <li>Qualquer arquivo que possa ser usado para trapacear online</li>
            <li>Qualquer arquivo que contenha ou dê acesso a conteúdo pirata ou protegido por direitos autorais, incluindo cracks de jogos, filmes, programas de televisão e música</li>
            <li>Qualquer arquivo contendo vírus ou malware ou qualquer arquivo EXE com resultado antivírus positivo</li>
            <li>Qualquer arquivo contendo imagens pornográficas nuas ou semi-nuas</li>
            <li>Qualquer arquivo que descreva uma figura política ou ideologia que seja, a critério completo do administrador, considerado algo que causará debates desnecessários na seção de comentários</li>
         </ul>
      </div>
   </div>
   <script>$(".gallery").sortable();$(".gallery").disableSelection();</script>
</div>

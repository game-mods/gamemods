<div class="marg default-gray adm_settings">
   <h2>Configurações do site</h2>
   <div class="wbox">
   <form>
      <table>
         <tr><td>Nome do site:</td><td><input type="text" value="%site_name%" name="site_name"></td></tr>
         <tr><td>Domínio do site:</td><td><input type="text" value="%site_url%" name="site_domain"><small>Exemplo: http://mysite.com/ - Com a barra final /</small></td></tr>
         <tr><td>Meta Descrição:</td><td><input type="text" value="%site_desc%" name="description"></td></tr>
         <tr><td>Palavras-chave Meta:</td><td><input type="text" value="%site_keys%" name="keywords"></td></tr>
         <tr><td>Rodapé do site:</td><td><input type="text" value="%site_footer%" name="site_footer"></td></tr>
         <tr><td>Mods por página:</td><td><input type="text" value="%mpp%" name="mpp" style="width:30px;" maxlength="3"><small>O número de mods que são mostrados por página.</small></td></tr>
         <tr><td>Comentários por carregamento:</td><td><input type="text" value="%cpl%" name="cpl" style="width:30px;" maxlength="3"><small>O número de comentários que são carregados por cada vez.</small></td></tr>
         <tr><td>Número máximo de imagens:</td><td><input type="text" value="%noi%" name="noi" style="width:30px;" maxlength="3"><small>O número máximo de imagens de mod permitidas para upload.</small></td></tr>
         <tr><td>Tamanho máximo do arquivo de upload:</td><td><input type="text" value="%mfs_upload%" name="max_upload" style="width:50px;" maxlength="3"> MB<small>O tamanho máximo do arquivo em Megabytes de upload de arquivo.</small></td></tr>
         <tr><td>Tamanho máximo do arquivo de imagens:</td><td><input type="text" value="%mfs_image%" name="max_image" style="width:50px;" maxlength="3"> MB<small>O tamanho máximo do arquivo em Megabytes de upload de imagens.</small></td></tr>
         <tr><td></td><td><input type="button" value="Salvar alterações" onclick="save_web_settings(this.form, this);"></td></tr>
      </table>
   </form>
   </div>
   <div class="wbox up_limit">
      <h4>Limite de upload do servidor</h4>
      O limite de upload do tamanho do arquivo do servidor atual é <a><b>%mfs_server%B</b></a>.<br>
      Se você precisar definir valores mais altos, edite o parâmetro <a><b>upload_max_filesize</b></a> no arquivo de configuração ini do PHP.
   </div>

</div>

<div class="marg default-gray adm_ads">
   <h2>Anúncios</h2>

   <div class="wbox">
   <form>
   <table>
      <tr><td>Anúncios ativados:</td><td><select id="ads_status" name="enable_ads"><option value="1">Sim</option><option value="0">Não</option></select></td></tr>
      <tr><td>Código de anúncio de nível de página do AdSense:</td><td><textarea name="adsense_code">%adsense_code%</textarea><small>Este código será incluído dentro da tag head.</small></td></tr>
      <tr><td><b>336x280</b> Código do anúncio:</td><td><textarea name="adcode1">%adm_ads_1%</textarea><small>Este anúncio será mostrado no item mod e nas páginas de download.</small></td></tr>
      <tr><td><b>300x250</b> Código do anúncio:</td><td><textarea name="adcode2">%adm_ads_2%</textarea><small>Este anúncio será exibido na página inicial, perfis e categorias de mods.</small></td></tr>
      <tr><td><b>Responsivo</b> Código do anúncio:</td><td><textarea name="adcode3">%adm_ads_3%</textarea><small>Este anúncio será exibido na página do item mod, no topo da galeria de mods.</small></td></tr>
      <tr><td></td><td><input type="button" value="Save Changes" onclick="save_ads(this.form, this);"></td></tr>
   </table>
   </form>
   </div>
   <script>$('#ads_status').val(%ads_status%);</script>
</div>

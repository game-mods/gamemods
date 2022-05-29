<div class="marg dashboard">
   <h2>Bem-vindo ao painel de administração do GameMods</h2>

   <div class="cf">

      <div class="wlft">
         <div class="wbox">
            <h3>Estatísticas do site</h3>
            <table>
               <tr><td>Versão GameMods:</td><td>v1.0</td></tr>
               <tr><td>Total de Mods:</td><td>%total_mods%</td></tr>
               <tr><td>Total de usuários:</td><td>%total_users%</td></tr>
               <tr><td>Total de comentários:</td><td>%total_comments%</td></tr>
            </table>
         </div>

         <div class="wbox admins_list">
            <h3>Administradores</h3><br>
            %admins%
         </div>
      </div>

      <div class="wrgt">
         <div class="wbox">
            <h3>Notas do administrador</h3>
            <br>
            <form>
               <textarea name="notes" class="admin_notes" placeholder="Você pode usar esta seção para fazer anotações para você ou outros administradores.">%notes%</textarea>
               <input type="button" value="Salvar notas" onClick="save_notes(this.form, this);">
            </form>
         </div>
      </div>
   </div>
</div>

  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
     <h1 class="mdl-layout-title"><span>CRM</span> Admin</h1>
 

     
      <div class="mdl-layout-spacer"></div>
      
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right">
                  
<label id="tt1" class="material-icons mdl-badge mdl-badge--overlap" data-badge="5"><a href="logout.php">power_settings_new</a></label>  
<div class="mdl-tooltip" for="tt1">Logout</div> 

<label id="tt2" class="material-icons mdl-badge mdl-badge--overlap" data-badge="5">account_box</label>  
<div class="mdl-tooltip" for="tt2">Messages</div>                     
                 
<label id="tt3" class="material-icons mdl-badge mdl-badge--overlap" data-badge="4">notifications</label> 
 <div class="mdl-tooltip" for="tt3">Notifications</div>           
                  
        <label class="mdl-button mdl-js-button mdl-button--icon"
               for="fixed-header-drawer-exp">
          <i class="material-icons">search</i>
        </label>
        <div class="mdl-textfield__expandable-holder">
          <form method="post" action="browse-employees.php?">
          <input class="mdl-textfield__input" type="text" name="search"
                 id="fixed-header-drawer-exp">
          </form>
        </div>
        
      </div>
    </div>
  </header>
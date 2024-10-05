jQuery(function($){
      "use strict";

   //===== Add class for dummy import
    jQuery(function() {

        jQuery('body.edubin_unlock .ocdi .ocdi__gl-item-buttons a.ocdi__gl-item-button.button.button-primary').each(function() {
            var text = this.innerHTML;
            var firstSpaceIndex = text.indexOf("Import Demo");
            var rrrr = "Unlock Demo";
            this.innerHTML = '<span class="firstWordClass ">' + rrrr + '</span>';
            
        });

        var temp="admin.php?page=edubin-theme-active";
        $("body.edubin_unlock .ocdi .ocdi__gl-item-buttons a.ocdi__gl-item-button.button").attr('href',' '+temp);
     
    });

});
jQuery(document).ready(function(){
        jQuery(".bbnuke-result-table tr").mouseover(function(){
                jQuery(this).addClass("over");
        });
        jQuery(".bbnuke-result-table tr").mouseout(function(){
                jQuery(this).removeClass("over");
        });
        jQuery(".bbnuke-schedule-table tr").mouseover(function(){
                jQuery(this).addClass("over");
        });
        jQuery(".bbnuke-schedule-table tr").mouseout(function(){
                jQuery(this).removeClass("over");
        });

});

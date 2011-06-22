jQuery(document).ready(function($){
        $(".bbnuke-results-table").tablesorter();
        $(".bbnuke-schedule-table").tablesorter();

        jQuery(".bbnuke-results-table tr").mouseover(function(){
                jQuery(this).addClass("over");
        });
        jQuery(".bbnuke-results-table tr").mouseout(function(){
                jQuery(this).removeClass("over");
        });
        jQuery(".bbnuke-schedule-table tr").mouseover(function(){
        	jQuery(this).addClass("over");
	});
        jQuery(".bbnuke-schedule-table tr").mouseout(function(){
        	jQuery(this).removeClass("over");
	});
});


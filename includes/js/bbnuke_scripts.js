function bbnuke_show_players_info(bb_player_id) 
{
  var data = {
             action: 'bbnuke_ajax_action',
             bbnuke_object_type: 'player',
             bbnuke_player_id: bb_player_id
       };
  var bbnuke_result_page_url;
  var bbnuke_result_page_post_id;
  var bb_result;

  // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
  jQuery.ajaxSetup({ async: false });
  jQuery.post( ajaxurl, data, 
       function( return_data, response, xobj )
       {
         bb_result = xobj['responseText'];
//         alert('result: ' + bb_result);
         try
         {
           var result_obj = jQuery.parseJSON(bb_result);
         }
         catch (e)
         {
           start_pos = bb_result.indexOf('{');
           end_pos   = bb_result.lastIndexOf('}');
           var bb_result_string = bb_result.substring(start_pos, end_pos + 1);
//           alert('result string: ' + bb_result_string);
           var result_obj = jQuery.parseJSON(bb_result_string);
         }

//         alert('Post ID: ' + result_obj.post_id);
//         alert('Url: ' + result_obj.url);

         bbnuke_result_page_url = result_obj.url;
         bbnuke_result_page_post_id = result_obj.post_id;

/*
         for(key in result_obj) 
         {
           alert('Key is ' + [key] + ', Value is ' + result_obj[key]);
         }

         jQuery.each(xobj, function(key, value) 
         {
           alert('Key: ' + key + ' Value: ' + value);
         });
*/
       }
  );

  if ( bbnuke_result_page_url )
  {
    bbnuke_show_popup_window( bbnuke_result_page_url,'Players Info Page');

/*
    setTimeout(jQuery(function(){}).delay(5000).queue(
        jQuery(function()
        {   
          var data = {
             action: 'bbnuke_ajax_action',
             bbnuke_object_type: 'delete',
             bbnuke_ajax_del_post_id: bbnuke_result_page_post_id
          };
          
          jQuery.post( ajaxurl, data, function(response){ alert(response); });
        })
    ), 5000);
*/

//    bbnuke_delete_post(bbnuke_result_page_post_id);
//    window.setTimeout( bbnuke_delete_post(bbnuke_result_page_post_id), 7000 );
  }

  return;
}


function  bbnuke_delete_post(bbnuke_result_page_post_id)
{
  var data = {
             action: 'bbnuke_ajax_action',
             bbnuke_object_type: 'delete',
             bbnuke_ajax_del_post_id: bbnuke_result_page_post_id
    };
  jQuery.post( ajaxurl, data, function(response){ var success = response; } );
}



function  bbnuke_show_popup_window( url, title )
{
  var w = window.open( url, '', 'width=500,height=600,resizable=yes,scrollbars=yes,status=yes,location=yes,toolbar=yes,menubar=yes');  
  w.focus();
//  w.document.close(); // needed for chrome and safari  

  return;
}


function bbnuke_show_fields_info(bb_field_name) 
{
  var data = {
             action: 'bbnuke_ajax_action',
             bbnuke_object_type: 'field',
             bbnuke_widget_locations_info_field: bb_field_name
       };
  var bbnuke_result_page_url;
  var bbnuke_result_page_post_id;
  var bb_result;

  // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
  jQuery.ajaxSetup({ async: false });
  jQuery.post( ajaxurl, data, 
       function( return_data, response, xobj )
       {
         bb_result = xobj['responseText'];
         try
         {
           var result_obj = jQuery.parseJSON(bb_result);
         }
         catch (e)
         {
           start_pos = bb_result.indexOf('{');
           end_pos   = bb_result.lastIndexOf('}');
           var bb_result_string = bb_result.substring(start_pos, end_pos + 1);
           var result_obj = jQuery.parseJSON(bb_result_string);
         }

         bbnuke_result_page_url = result_obj.url;
         bbnuke_result_page_post_id = result_obj.post_id;
       }
  );

  if ( bbnuke_result_page_url )
  {
    bbnuke_show_popup_window( bbnuke_result_page_url,'Locations Info Page');
//    window.setTimeout( bbnuke_delete_post(bbnuke_result_page_post_id), 5000 );
  }

  return;
}


function bbnuke_show_game_results(bb_game_id) 
{
  var data = {
             action: 'bbnuke_ajax_action',
             bbnuke_object_type: 'game',
             bbnuke_game_id: bb_game_id
       };
  var bbnuke_result_page_url;
  var bbnuke_result_page_post_id;
  var bb_result;

  // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
  jQuery.ajaxSetup({ async: false });
  jQuery.post( ajaxurl, data, 
       function( return_data, response, xobj )
       {
         bb_result = xobj['responseText'];
         try
         {
           var result_obj = jQuery.parseJSON(bb_result);
         }
         catch (e)
         {
           start_pos = bb_result.indexOf('{');
           end_pos   = bb_result.lastIndexOf('}');
           var bb_result_string = bb_result.substring(start_pos, end_pos + 1);
           var result_obj = jQuery.parseJSON(bb_result_string);
         }

         bbnuke_result_page_url = result_obj.url;
         bbnuke_result_page_post_id = result_obj.post_id;
       }
  );

  if ( bbnuke_result_page_url )
  {
    bbnuke_show_popup_window( bbnuke_result_page_url,'Locations Info Page');
//    window.setTimeout( bbnuke_delete_post(bbnuke_result_page_post_id), 5000 );
  }

  return;
}

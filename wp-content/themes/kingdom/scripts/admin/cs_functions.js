var contheight;
function cs_amimate(id){
	var $ = jQuery;
	$("#"+id).animate({
		height: 'toggle'
		}, 1000, function() {
		// Animation complete.
	});
}

 function hide_all(id){
  var $ = jQuery;
  contheight = $('.page-opts').height();
  //var widthvr = $('.page-opts').outerWidth(true);
  var popd = $("#"+id).height();
  $("#"+id).css("top", popd);
  $("#"+id).css("display", "block");
  $.scrollTo( '#normal-sortables', 800, {easing:'swing'} );
  $(".poped-up").css("height", popd);
  $(".page-opts").css("height", popd);
  $("#"+id).animate({
   top: 0,
  }, 500, function() {
   // Animation complete.
  });
  
 };
 function show_all(id){
  var $ = jQuery;
  $(".page-opts").css("height", "auto");
  //var widthvr = $('.page-opts').outerHeight();
  $("#"+id).animate({
   top: contheight,
  }, 500, function() {
  // Animation complete.
  });
  $.scrollTo( '#normal-sortables', 800, {easing:'swing'} );
  $("#"+id).hide(500).delay(500);
  contheight = 0;
 };
 
 function addtrack(id){
  var $ = jQuery;
  contheight = $('.page-opts').height();
  //var widthvr = $('.page-opts').outerWidth(true);
  var popd = $("#"+id).height();
  $("#"+id).css("top", popd);
  $("#"+id).css("display", "block");
  $(".poped-up").css("height", popd);
  $(".page-opts").css("height", popd);
  $("#"+id).animate({
   top: 0,
  }, 500, function() {
   // Animation complete.
  });
  $.scrollTo( '#normal-sortables', 800, {easing:'swing'} );
 };
 
 function closetrack(id){
  var $ = jQuery;
  $(".page-opts").css("height", "auto");
  //var widthvr = $('.page-opts').outerHeight();
  $("#"+id).animate({
   top: contheight + 100,
  }, 500, function() {
  // Animation complete.
  });
  $("#"+id).hide(500).delay(500);
	$.scrollTo( '#normal-sortables', 800, {easing:'swing'} );
 };


	function update_title(id){
		var val;
		val = jQuery('#album_track_title'+id).val();
		jQuery('#album-title'+id).html(val);
	}
	function gll_search_map(){
		var vals;
		vals = jQuery('#loc_address').val();
		vals = vals + ", " + jQuery('#loc_city').val();
		vals = vals + ", " + jQuery('#loc_postcode').val();
		vals = vals + ", " + jQuery('#loc_region').val();
		vals = vals + ", " + jQuery('#loc_country').val();
		jQuery('.gllpSearchField').val(vals);
	}
	function hide_custom_color_scheme(id){
		if (id == "custom") {
			jQuery("#cs_color_scheme").show("slow");
		}
		else jQuery("#cs_color_scheme").hide("slow");
	}
	function update_logo(id){
		var $ = jQuery;
		var src;
		src = $('#'+id).val();
		$('#'+id+'_img').attr('src', src);
	}
	function remove_logo(id){
		var $ = jQuery;
		$('#'+id+'_img').attr('src', '');
		$('#'+id).val('');
	}
	function track_toggle(id){
		title = jQuery('#album_track_title'+id).val();
		jQuery('#album-title'+id).html(title);
		jQuery('#edit_track_form'+id).toggle("slow");
	}
	function tab_close(){
		jQuery(".form-msgs").slideUp("slow");
	}
	function slideout(){
		setTimeout(function(){
			jQuery(".form-msgs").slideUp("slow", function () {
			});
		}, 5000);
	}
	function slideout_msgs(){
		setTimeout(function(){
			jQuery("#newsletter_mess").slideUp("slow", function () {
			});
		}, 5000);
	}	
	function cs_div_remove(id){
		jQuery("#"+id).remove();
	}
	function cs_toggle(id){
		jQuery("#"+id).toggle("slow");
	}
	function toggle_with_value(id, value){
		if ( value == 0 ) jQuery("#"+id).hide("slow");
		else  jQuery("#"+id).show("slow");
	}
	function cs_toggle_tog(id){
		jQuery("#"+id).toggleClass("no-display");
		var newheight = $('.poped-up').height();
		jQuery(".poped-up").css("height", newheight);
		jQuery(".page-opts").css("height", newheight);
	}
	function cs_toggle_height(value,id){
		var $ = jQuery;
		if (value == "Nivo Slider"){
			jQuery("#"+id).addClass("no-display");
		}
		else {
			jQuery("#"+id).removeClass("no-display");
		}
			var newheight = $('.poped-up').height();
			jQuery(".poped-up").css("height", newheight);
			jQuery(".page-opts").css("height", newheight);
	}
	function show_sidebar(id){
		var $ = jQuery;
		jQuery('input[name="cs_layout"]').change(function(){
			jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
			jQuery(this).siblings("label").children("#check-list").addClass("check-list");
		});
		if ( id == 'left'){
			jQuery("#sidebar_right").hide();
			jQuery("#sidebar_left").show();
		}
		else if ( id == 'right'){
			jQuery("#sidebar_left").hide();
			jQuery("#sidebar_right").show();
		}
		else if ( id == 'both'){
			jQuery("#sidebar_left").show();
			jQuery("#sidebar_right").show();
		}
		else if ( id == 'none'){
			jQuery("#sidebar_left").hide();
			jQuery("#sidebar_right").hide();
		}
	}
	function select_pattern(){
		var $ = jQuery;
		jQuery('input[name="custome_pattern"]').change(function(){
			jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
			jQuery(this).siblings("label").children("#check-list").addClass("check-list");
		});
	}
	jQuery(document) .ready(function(){
	
		jQuery("#adminmenu .wp-submenu li a") .each(function(){
			var emptytextnode = jQuery(this) .text();
			if (emptytextnode == 0) {
				jQuery(this) .remove();
			}
		});
	});
	// shortcode
function cs_shortocde_selection(){
	
	jQuery("#sc_select").change(function() {
	var v = jQuery("#sc_select :selected").val();
	if(v == 'toogle'){
		tinyMCE.activeEditor.selection.setContent('[cs_toggle title="Toggle Title 1"]Toggle Content 1[/cs_toggle]<br /><br />');
	}
	else if(v == 'tabs'){
		tinyMCE.activeEditor.selection.setContent('[cs_tab] <br />\
			[cs_tab_item title="Tab Title 1" tabs="tabs"]Tab Content 1[/cs_tab_item]<br />\
			[cs_tab_item title="Tab Title 2" tabs="tabs"]Tab Content 2[/cs_tab_item]<br />\
			[cs_tab_item title="Tab Title 3" tabs="tabs"]Tab Content 3[/cs_tab_item]<br />\
			[/cs_tab]<br /><br />');
	}
	else if(v == 'accordion'){
		tinyMCE.activeEditor.selection.setContent('[cs_accordion] <br />\
			[cs_accordion_item title="Accordion Title 1" accordion="accordion"]Accordion Content 1[/cs_accordion_item] <br />\
			[cs_accordion_item title="Accordion Title 2" accordion="accordion"]Accordion Content 2[/cs_accordion_item] <br />\
			[cs_accordion_item title="Accordion Title 3" accordion="accordion"]Accordion Content 3[/cs_accordion_item] <br />\
			[/cs_accordion]<br /><br />');
	}
	else if(v == 'divider'){
		tinyMCE.activeEditor.selection.setContent('[cs_divider title="Divider Content"]<br /><br />');
	}
	else if(v == 'quote'){
		tinyMCE.activeEditor.selection.setContent('[cs_quote align="center" color="#COLOR_CODE"]Quote Content[/cs_quote]<br /><br />');
	}
	else if(v == 'button'){
		tinyMCE.activeEditor.selection.setContent('[cs_button color="#COLOR_CODE" background="#COLOR_CODE" src="LINK_URL"]Button Content[/cs_button]<br /><br />');
	}
	else if(v == 'column'){
		tinyMCE.activeEditor.selection.setContent('[cs_column size="1/2"]Column Content[/cs_column]<br /><br />');
	}
	else if(v == 'dropcap'){
		tinyMCE.activeEditor.selection.setContent('[cs_dropcap]Dropcap Content[/cs_dropcap]<br /><br />');
	}
	else if(v == 'message_box'){
		tinyMCE.activeEditor.selection.setContent('[cs_message_box color="#COLOR_CODE" background="#COLOR_CODE" border_color="#COLOR_CODE" title="Message Title"]Message Content[/cs_message_box]<br /><br />');
	}
	else if(v == 'frame'){
		tinyMCE.activeEditor.selection.setContent('[cs_frame src="IMAGE_SOURCE" width="IMAGE_WIDTH" height="IMAGE_HEIGHT" lightbox="on" title="Image Title"]<br /><br />');
	}
	else if(v == 'list'){
		tinyMCE.activeEditor.selection.setContent('[cs_list type="default"]<br />\
			[cs_list_item]List Item 1[/cs_list_item]<br />\
			[cs_list_item]List Item 2[/cs_list_item]<br />\
			[cs_list_item]List Item 3[/cs_list_item]<br />\
			[/cs_list]<br /><br />');
	}
	else if(v == 'table'){
		tinyMCE.activeEditor.selection.setContent('[cs_table color="#Color_Code"]<br />\
			[thead]<br />\
			  [tr]<br />\
				[th]Column 1[/th]<br />\
				[th]Column 2[/th]<br />\
				[th]Column 3[/th]<br />\
				[th]Column 4[/th]<br />\
			  [/tr]<br />\
			[/thead]<br />\
			[tbody]<br />\
			[tr]<br />\
				  [td]Item 1[/td]<br />\
				  [td]Item 2[/td]<br />\
				  [td]Item 3[/td]<br />\
				  [td]Item 4[/td]<br />\
				[/tr]<br />\
				[tr]<br />\
				  [td]Item 11[/td]<br />\
				  [td]Item 22[/td]<br />\
				  [td]Item 33[/td]<br />\
				  [td]Item 44[/td]<br />\
				[/tr]<br />\
			  [/tbody]<br />\
			 [/cs_table]<br /><br />');
	}
	else if(v == 'gallery'){
			tinyMCE.activeEditor.selection.setContent('[cs_minigallery width="WIDTH" post_id="Gallery_Page_ID"]<br /><br />');
	}
	return false;
	});
}
<?php
	$cs_page_builder = '';
	$cs_page_builder = get_post_meta($post->ID, "cs_page_builder", true);
	$cs_xmlObject = new SimpleXMLElement($cs_page_builder);
	
	$captcha = "";
	$cs_gs_captcha = get_option( "cs_gs_captcha" );
		if ( $cs_gs_captcha <> "" ) {
			$sxe = new SimpleXMLElement($cs_gs_captcha);
				$captcha = isset($sxe->captcha) ? $sxe->captcha : '';
		}
	contact_enqueue_scripts();
?>
<script type="text/javascript">
	jQuery().ready(function($) {
		var container = $('');
		var validator = $("#frm<?php echo $counter_gal?>").validate({
			messages:{
				contact_name: '<?php echo languageswitcher('name_error', __('Name is Required',CSDOMAIN)); ?>',
				contact_email:{
					required: '<?php echo languageswitcher('email_error', __('Email is Required',CSDOMAIN)); ?>',
					email:'<?php echo languageswitcher('email_error', __('Invalid Email Provided',CSDOMAIN)); ?>',
				},
				contact_no: {
					number: '<?php echo languageswitcher('contact_no_error', __('Please Enter Valid Contact Number',CSDOMAIN)); ?>',
				},
				contact_msg: '<?php echo languageswitcher('message_error', __('Message Field is Required',CSDOMAIN)); ?>',
				key: '<?php echo languageswitcher('captcha_error', __('Please Enter Security Key',CSDOMAIN)); ?>',
			},
			errorContainer: container,
			errorLabelContainer: $(container),
			errorElement:'div',
			errorClass:'frm_error',
			meta: "validate"
		});
	});
	function frm_capcha_verify<?php echo $counter_gal?>(){
		var $ = jQuery;
		$("#submit_btn<?php echo $counter_gal?>").hide();
		$("#loading_div<?php echo $counter_gal?>").html('<img src="<?php echo get_template_directory_uri()?>/images/contact_loading.gif" />');
		$.ajax({
			type:'POST', 
			url: '<?php echo get_template_directory_uri()?>/include/captcha_verify.php',
			data:$('#frm<?php echo $counter_gal?>').serialize(), 
			success: function(response) {
				if ( response == "Valid" ) {
					frm_submit<?php echo $counter_gal?>();
				}
				else {
					$("#loading_div<?php echo $counter_gal?>").html('');
					$("#submit_btn<?php echo $counter_gal?>").show('');
					$("#recaptcha_mess<?php echo $counter_gal?>").show('');
					$("#recaptcha_mess<?php echo $counter_gal?>").html(response);
					//alert(response);
					//Recaptcha.reload();
				}
			}
		});
	}
	function frm_submit<?php echo $counter_gal?>(){
		var $ = jQuery;
		$("#submit_btn<?php echo $counter_gal?>").hide();
		$("#loading_div<?php echo $counter_gal?>").html('<img src="<?php echo get_template_directory_uri()?>/images/contact_loading.gif" />');
		$.ajax({
			type:'POST', 
			url: '<?php echo get_template_directory_uri()?>/page_contact_submit.php',
			data:$('#frm<?php echo $counter_gal?>').serialize(), 
			success: function(response) {
				//$('#frm').get(0).reset();
				$("#loading_div<?php echo $counter_gal?>").html('');
				$("#frm_area<?php echo $counter_gal?>").hide();
				$("#succ_mess<?php echo $counter_gal?>").show('');
				$("#succ_mess<?php echo $counter_gal?>").html(response);
				//$('#frm_slide').find('.form_result').html(response);
			}
		});
	}
</script>
<div class="contact-us">
                    <div class="box-in">
                    	<?php foreach ($cs_xmlObject->children() as $cs_node) { ?>
						<?php
                            if($cs_node->getName() == "contact" and $cs_node->cs_contact_map_view == "content_view"){
                            ?>
                    	<?php echo $cs_contact_map_db ?>
                        <?php
							}
						}
						?>
                	<!-- Quick Enquiry Start -->
                	<div class="quick-enquiry">
                    	<h2 class="colr"><?php echo languageswitcher('form_title', __('Quick Inquiry',CSDOMAIN));?></h2>
						<div class="succ_mess" id="succ_mess<?php echo $counter_gal?>"></div>
						<div class="mem-form" id="frm_area<?php echo $counter_gal?>">   
							<form id="frm<?php echo $counter_gal?>" name="frm<?php echo $counter_gal?>" method="post" action="javascript:<?php if($captcha=="on")echo "frm_capcha_verify".$counter_gal."()";else echo "frm_submit".$counter_gal."()";?>">
								<ul>
									<li class="inputfield">
										<label class="txt"><?php _e('Name', CSDOMAIN); ?>:*</label>
										<input type="text" name="contact_name" id="contact_name" value="" class="bar {validate:{required:true}}" />
									</li>
									<li class="inputfield">
										<label class="txt"><?php _e('Email', CSDOMAIN); ?>:*</label>
										<input type="text" name="contact_email" id="contact_email" value="" class="bar {validate:{required:true,email:true}}" />
									</li>
									<li class="inputfield">
										<label class="txt"><?php echo languageswitcher('contact_no', __('Contact No',CSDOMAIN));?>:</label>
										<input type="text" name="contact_no" id="contact_no" value="" class="bar {validate:{number:true}}" />
									</li>
									<li class="inputfield">
										<label class="txt"><?php echo languageswitcher('message', __('Message',CSDOMAIN));?>:*</label>
										<textarea name="contact_msg" id="contact_msg" class="{validate:{required:true}}" /></textarea>
									</li>
									<?php if($captcha=="on") {?>
                                        <li>
                                            <img src="<?php echo get_template_directory_uri()?>/include/captcha.php?new_sess=sess_cap<?php echo $counter_gal?>" border="0" alt="CAPTCHA" id="captcha<?php echo $counter_gal?>"> <a class="refresh-captcha" onclick="document.getElementById('captcha<?php echo $counter_gal?>').src='<?php echo get_template_directory_uri()?>/include/captcha.php?new_sess=sess_cap<?php echo $counter_gal?>&'+Math.random();" style="cursor:pointer"><?php echo languageswitcher('refresh_captcha', __('Refresh Captcha',CSDOMAIN));?></a>
                                            
                                            <label class="enter-captcha"><?php echo languageswitcher('captcha', __('Enter CAPTCHA',CSDOMAIN));?>:</label>
                                            <input type="text" class="bar" name="key" value="" />
                                            <div class="recaptcha_mess" id="recaptcha_mess<?php echo $counter_gal?>"></div>
                                        </li>
                                    <?php }?>
									<li>
										<input type="hidden" name="cs_contact_email" value="<?php echo $cs_node->cs_contact_email?>" />
										<input type="hidden" name="bloginfo" value="<?php echo get_bloginfo()?>" />
										<input type="hidden" name="cs_contact_succ_msg" value="<?php echo $cs_node->cs_contact_succ_msg?>" />
										<input type="hidden" name="counter_gal" value="<?php echo $counter_gal?>" />
										<input class="backcolr left btn_submit" id="submit_btn<?php echo $counter_gal?>" type="submit" value="<?php _e('Submit', CSDOMAIN); ?>"/>
										<div id="loading_div<?php echo $counter_gal?>"></div>
									</li>
								</ul>
							</form>
						</div>
                    </div>
                    <!-- Quick Enquiry End -->
					<div class="clear"></div>
				</div>
			</div>

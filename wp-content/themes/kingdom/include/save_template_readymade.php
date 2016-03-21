<?php
$already_exist = '';
	require_once '../../../../wp-load.php';
	$cs_page_builder_template = get_option("cs_page_builder_template_readymade");
	if ( $cs_page_builder_template != "" ) {
		$sxe = new SimpleXMLElement( $cs_page_builder_template );
			foreach ( $sxe->children() as $cs_node ) {
				if ( $cs_node->attributes() == $_POST['template_name'] ) {
					$already_exist = __("This Template Already Exist",CSDOMAIN);
				}
			}
	}
	
if ( $_POST['template_name'] == "" ) {
	echo __("Template Name is Required",CSDOMAIN);
}
else if ( $already_exist <> "" ) {
	echo $already_exist;
}
else {
	if ( $cs_page_builder_template == "" ) { $cs_page_builder_template = "<pagebuilder_templates_readymade></pagebuilder_templates_readymade>"; }
		$sxe_main = new SimpleXMLElement( $cs_page_builder_template );
			$sxe = $sxe_main->addChild('template');
			$sxe->addAttribute('name', $_POST['template_name']);
				include get_template_directory."/include/save_all_sections.php";
					update_option( "cs_page_builder_template_readymade", $sxe_main->asXML() );
		echo "<script>hide_template_name()</script>";
	echo __("Template Saved",CSDOMAIN);
}
?>

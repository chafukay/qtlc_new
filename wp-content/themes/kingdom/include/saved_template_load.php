<?php
	require_once '../../../../wp-load.php';
	global $wpdb;
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = $values;
	}
	$cs_page_builder_template = get_option("cs_page_builder_template");
	$count_node = 0;
	if ( $cs_page_builder_template != "" ) {
		$sxe = new SimpleXMLElement( $cs_page_builder_template );
			foreach ( $sxe->children() as $template ) {
				//echo $template->attributes()."<br />";
				if ( $template->attributes() == $filter_name ) {
					//$counter = 0;
					foreach ( $template->children() as $cs_node ) {
						include get_template_directory."/include/load_all_sections.php";
					}
				}
			}

	}
?>
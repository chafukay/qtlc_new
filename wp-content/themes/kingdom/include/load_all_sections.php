<?php
if ( empty($post->ID) ) $post->ID = "";
	if ( $cs_node->getName() == "rich_editor" ) {
		$rich_editor = 1;
		include get_template_directory()."/include/cs_meta_load_rich_editor.php";
	}
	else if ( $cs_node->getName() == "gallery" ) {
		include get_template_directory()."/include/gallery_pb.php";
	}
	else if ( $cs_node->getName() == "event" ) {
		include get_template_directory()."/include/event_pb.php";
	}
	else if ( $cs_node->getName() == "slider" ) {
		include get_template_directory()."/include/slider_pb.php";
	}
	else if ( $cs_node->getName() == "blog" ) {
		include get_template_directory()."/include/cs_meta_load_blog.php";
	}
	else if ( $cs_node->getName() == "news" ) {
		include get_template_directory()."/include/cs_meta_load_news.php";
	}
	else if ( $cs_node->getName() == "contact" ) {
		include get_template_directory()."/include/cs_meta_load_contact.php";
	}
	else if ( $cs_node->getName() == "course" ) {
		include get_template_directory()."/include/album_pb.php";
	}
?>
<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
       <div class="fullwidth">
           <div class="box blog">
                <div class="box-in">
                    <div class="page-not-found">

	<div style="min-height:300px; text-align:center">
    	<h1><?php echo languageswitcher( 'title_404', __('Page Not Found',CSDOMAIN) ); ?></h1>
        <img src="<?php echo get_template_directory_uri()?>/images/404.png" />
        <p style="margin:10px 0;"><?php echo languageswitcher( 'content_404', __("It seems we can not find what you are looking for. Perhaps searching can help",CSDOMAIN) ); ?></p>
        <?php get_search_form(); ?>
    </div>

	<div class="clear"></div>

                    
                    </div>
                </div>
            </div>    
        </div>
</div>
</div>
    <div class="clear"></div>
<?php get_footer(); ?>
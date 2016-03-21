<?php get_header();?>
<div class="clear"></div>
    <!-- Content Section Start -->

            <div class="col1 left">
            	<!-- Principle Message Start -->
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('left-sidebar') ) : ?>
				<?php endif; ?>
            </div>
            <div class="col2 left">
                <!-- Course Finder Start -->
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('center-sidebar') ) : ?>
                <?php endif; ?>
            </div>
            <div class="col1 right">
            	<!-- Events Widget Start -->
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('right-sidebar') ) : ?>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
</div>    
</div>    
</div>    
<?php get_footer(); ?>
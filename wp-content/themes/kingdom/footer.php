<!-- Footer Start -->
<div id="footer">
    <div class="inner">
        <div class="widget-holder">           	
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-sidebar')) : ?>
            <?php endif; ?>
        </div>
        <div class="copyrights">
            <?php
            $cs_footer_logo = '';
            $cs_copyright = '';
            $cs_powered_by = '';
            $cs_powered_icon = '';
            $cs_analytics = '';
            $cs_gs_footer_settings = get_option("cs_gs_footer_settings");
            if ($cs_gs_footer_settings <> "") {
                $sxe = new SimpleXMLElement($cs_gs_footer_settings);
                $cs_footer_logo = isset($sxe->cs_footer_logo) ? $sxe->cs_footer_logo : '';
                $cs_copyright = isset($sxe->cs_copyright) ? $sxe->cs_copyright : '';
                $cs_powered_by = isset($sxe->cs_powered_by) ? $sxe->cs_powered_by : '';
                $cs_powered_icon = isset($sxe->cs_powered_icon) ? $sxe->cs_powered_icon : '';
                $cs_analytics = isset($sxe->cs_analytics) ? $sxe->cs_analytics : '';
            }
            ?>            
            <?php if ($cs_copyright <> '') { ?><p><?php echo $cs_copyright; ?></p><?php } ?>
            <?php if ($cs_powered_by <> '') { ?><p class="poweredby"><img src="<?php echo $cs_powered_icon; ?>" /><?php echo $cs_powered_by; ?></p><?php } ?>            
            <a href="#top" class="gotop" id="gotop">&nbsp;</a>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- Footer End -->
<div class="clear"></div>
</div>
<?php echo $cs_analytics; ?>
<?php wp_footer(); ?>
<!-- Outer Wrapper End -->
</body>
</html>
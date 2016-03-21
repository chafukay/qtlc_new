<form method="get" action="<?php echo home_url()?>" id="searchform" role="search">
    <input name="s" value="<?php _e('Search for:', CSDOMAIN); ?>"
    onfocus="if(this.value=='<?php _e('Search for:', CSDOMAIN); ?>') {this.value='';}"
    onblur="if(this.value=='') {this.value='<?php _e('Search for:', CSDOMAIN); ?>';}" type="text" class="bar s" />
    <input type="submit" id="searchsubmit" onclick="" value="<?php _e('Search', CSDOMAIN); ?>" class="backcolr" />
</form>

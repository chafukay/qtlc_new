<div id="comments">
	<?php if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', CSDOMAIN ); ?></p>
    <!-- #comments -->
    <?php return; endif;?>
    <?php if ( have_comments() ) : ?>
        <h1 class="heading"><?php printf( _n( 'Comments %2$s', '%1$s Comments %2$s', get_comments_number(), CSDOMAIN ),number_format_i18n( get_comments_number() ), ''  );?></h1>
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                <div class="navigation">
                    <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', CSDOMAIN ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', CSDOMAIN ) ); ?></div>
                </div> <!-- .navigation -->
            <?php endif; // check for comment navigation ?>
        
            <ul>
                <?php wp_list_comments( array( 'callback' => 'PixFill_comment' ) );	?>
            </ul>
        
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', CSDOMAIN ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', CSDOMAIN ) ); ?></div>
            </div><!-- .navigation -->
        <?php endif; 
        else : 
            if ( ! comments_open() ) :?>
        <?php endif; // end ! comments_open() ?>
    <?php endif; // end have_comments() ?>
</div>
<?php 
global $post_id;
$defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', 
	array(
		'author' => '<p class="comment-form-author">' .
		'<label for="author">' . __( 'Name',CSDOMAIN ) . '</label> ' .
		( $req ? '<span class="required">*</span>' : '' ) .
		
		'<input id="author" name="author" type="text" value="' .
		esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1"  />' .
		'</p><!-- #form-section-author .form-section -->',
		
		'email'  => '<p class="comment-form-email">' .
		'<label for="email">' . __( 'Email',CSDOMAIN ) . '</label> ' .
		( $req ? '<span class="required">*</span>' : '' ) .
		'<input id="email" name="email" type="text" value="' . 
		esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2"/>' .
		'</p><!-- #form-section-email .form-section -->',
		
		'<!-- #<span class="hiddenSpellError" pre="">form-section-url</span> .form-section -->' ) ),
		
		'comment_field' => '<p class="comment-form-comment">' .
		'<label for="comment">' . __( 'Comments',CSDOMAIN ) . '</label>' .
		'<textarea id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea>' .
		'</p><!-- #form-section-comment .form-section -->',
		
		'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), 
		wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%s">%s</a>. 
		<a title="Log out of this account" href="%s">Log out?</a></p>' ), admin_url( 'profile.php' ), 
		$user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ),
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email is <em>never</em> published nor shared.',CSDOMAIN ) . 
		( $req ? __( ' Required fields are marked <span class="required">*</span>' ) : '' ) . '</p>',
		//'</dt> <dd><code>' . allowed_tags() . '</code></dd>';
		'id_form' => 'forms',
		'id_submit' => 'backcolr',
		'title_reply' => __( 'Leave a Reply',CSDOMAIN ),
		'title_reply_to' => __( 'Leave a Reply to %s',CSDOMAIN ),
		'cancel_reply_link' => __( 'Cancel reply',CSDOMAIN ),
		'label_submit' => __( 'Post Comment',CSDOMAIN ),); ?>
<?php comment_form($defaults, $post_id); ?>
<?php
define('CSDOMAIN', 'kingdom');
if (!function_exists('cs_comment_tut_fields')) {

    function cs_comment_tut_fields() {

        $you_may_use = __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', CSDOMAIN);
        $cs_comment_opt_array = array(
            'std' => '',
            'id' => '',
            'classes' => 'commenttextarea',
            'extra_atr' => ' rows="55" cols="15"',
            'cust_id' => 'comment_mes',
            'cust_name' => 'comment',
            'return' => true,
            'required' => false
        );
        $html = '<p class="comment-form-comment">' .
                '<label for="comment">' . __('Comments', CSDOMAIN) . '</label>' .
                '<textarea id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea>' .
                '</p>';

        echo force_balance_tags($html);
    }

}
if (!function_exists('cs_filter_comment_form_field_comment')) {

    function cs_filter_comment_form_field_comment($field) {

        return '';
    }

}

// add the filter
add_filter('comment_form_field_comment', 'cs_filter_comment_form_field_comment', 10, 1);

add_action('comment_form_logged_in_after', 'cs_comment_tut_fields');
add_action('comment_form_after_fields', 'cs_comment_tut_fields');

add_action('after_setup_theme', 'cs_theme_setup');
if (!function_exists('cs_theme_setup')) {

    function cs_theme_setup() {

        /* Add theme-supported features. */
        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();
        // Make theme available for translation
        // Translations can be filed in the /languages/ directory
        load_theme_textdomain(CSDOMAIN, get_template_directory() . '/languages');
        if (!isset($content_width))
            $content_width = 640;
        $args = array(
            'default-color' => '',
            'flex-width' => true,
            'flex-height' => true,
            'default-image' => '',
        );
        add_theme_support('custom-background', $args);
        add_theme_support('custom-header', $args);
        // This theme uses post thumbnails
        add_theme_support('post-thumbnails');

        // Add default posts and comments RSS feed links to head
        add_theme_support('automatic-feed-links');

        add_theme_support("title-tag");
        /* Add custom actions. */
        global $pagenow;

		add_action('init', 'cs_activation_data');
        if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
            $theme = wp_get_theme();
            if (get_option('cs_theme_name') != $theme['Name']) {
                add_action('admin_head', 'cs_activate_widget');

            }
            wp_redirect(admin_url('admin.php?page=cs_demo_importer'));
        }

        $my_theme = wp_get_theme();



        $cs_import_data = get_option('cs_import_data');
        /* $front_page_settings = get_option( 'front_page_settings' );
          $home = get_page_by_title( 'Home' );
          if(isset($cs_import_data) && $cs_import_data == 'success' && (!isset($front_page_settings) || empty($front_page_settings))){
          $home = get_page_by_title( 'Home' );
          $front_page_settings = get_option( 'front_page_settings' );
          if(!isset($front_page_settings) || empty($front_page_settings)){
          if($home <> '' && get_option( 'page_on_front' ) == "0"){
          update_option( 'page_on_front', $home->ID );
          update_option( 'show_on_front', 'page' );
          update_option( 'front_page_settings', '1' );

          }
          }
          } */
        if (!session_id()) {
            //add_action('init', 'session_start');
            session_start();
        }
        add_action('admin_menu', 'my_new_theme');
        add_action('admin_enqueue_scripts', 'cs_admin_scripts_enqueue');
        add_action('wp_enqueue_scripts', 'cs_front_scripts_enqueue');
        add_filter('pre_get_posts', 'cs_change_query_vars');
        add_filter('widget_text', 'do_shortcode');
        add_filter('the_password_form', 'cs_password_form');
        add_filter('nav_menu_css_class', 'add_parent_css', 10, 2);
    }

}

// password protect post/page
if (!function_exists('cs_password_form')) {

    function cs_password_form() {
        global $post;
        $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
        $o = '<div class="password_protector">
 			<h5>' . __("This post is password protected. To view it please enter your password below:", CSDOMAIN) . '</h5>';
        $o .= '<div class="req_password">
				<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post"><input class="webkit" name="post_password" id="' . $label . '" type="password" size="20" /><input class="backcolr" type="submit" name="Submit" value="' . esc_attr__("Submit") . '" />
    			</form>
	 		</div>
       	</div>';
        return $o;
    }

}
if (!function_exists('featured')) {

    function featured() {
        global $cs_transwitch;
        if (is_sticky()):
            ?>
            <span class="featured"><strong><?php languageswitcher('featured_post', 'Featured'); ?></strong></span>
            <?php
        endif;
    }

}
if (!function_exists('social_share')) {

    function social_share() {
        $html = '';
        $twitter = '';
        $facebook = '';
        $linkedin = '';
        $digg = '';
        $delicious = '';
        $google_plus = '';
        $google_buzz = '';
        $google_bookmark = '';
        $myspace = '';
        $reddit = '';
        $stumbleupon = '';
        $rss = '';
        $pageurl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $cs_social_share = get_option("cs_social_share");
        if ($cs_social_share <> "") {
            $cs_xmlObject_album = new SimpleXMLElement($cs_social_share);

            $twitter = isset($cs_xmlObject_album->twitter) ? $cs_xmlObject_album->twitter : '';
            $facebook = isset($cs_xmlObject_album->facebook) ? $cs_xmlObject_album->facebook : '';
            $linkedin = isset($cs_xmlObject_album->linkedin) ? $cs_xmlObject_album->linkedin : '';
            $digg = isset($cs_xmlObject_album->digg) ? $cs_xmlObject_album->digg : '';
            $delicious = isset($cs_xmlObject_album->delicious) ? $cs_xmlObject_album->delicious : '';
            $google_plus = isset($cs_xmlObject_album->google_plus) ? $cs_xmlObject_album->google_plus : '';
            $google_buzz = isset($cs_xmlObject_album->google_buzz) ? $cs_xmlObject_album->google_buzz : '';
            $google_bookmark = isset($cs_xmlObject_album->google_bookmark) ? $cs_xmlObject_album->google_bookmark : '';
            $myspace = isset($cs_xmlObject_album->myspace) ? $cs_xmlObject_album->myspace : '';
            $reddit = isset($cs_xmlObject_album->reddit) ? $cs_xmlObject_album->reddit : '';
            $stumbleupon = isset($cs_xmlObject_album->stumbleupon) ? $cs_xmlObject_album->stumbleupon : '';
            $rss = isset($cs_xmlObject_album->rss) ? $cs_xmlObject_album->rss : '';
        }
        if ($twitter == 'on' or $facebook == 'on' or $linkedin == 'on' or $digg == 'on' or $delicious == 'on' or $google_plus == 'on' or $google_buzz == 'on' or $google_bookmark == 'on' or $myspace == 'on' or $reddit == 'on' or $stumbleupon == 'on' or $rss == 'on') {
            if ($twitter == 'on') {
                $html .= '<a href="http://twitter.com/home?status=' . get_the_title() . ' - ' . $pageurl . '" target="_blank" class="share_twitter"></a>';
            }
            if ($facebook == 'on') {
                $html .= '<a href="http://www.facebook.com/share.php?u=' . $pageurl . '&t=' . get_the_title() . '" target="_blank" class="share_fb"></a>';
            }
            if ($linkedin == 'on') {
                $html .= '<a href="http://www.linkedin.com/shareArticle?mini=true&#038;url=' . $pageurl . '&#038;title=' . get_the_title() . '" target="_blank" class="share_linkedin"></a>';
            }
            if ($digg == 'on') {
                $html .= '<a href="http://digg.com/submit?url=' . $pageurl . '&#038;title=' . get_the_title() . '" target="_blank" class="share_digg"></a>';
            }
            if ($delicious == 'on') {
                $html .= '<a href="http://delicious.com/post?url=' . $pageurl . '&#038;title=' . get_the_title() . '" target="_blank" class="share_delicious"></a>';
            }
            if ($google_bookmark == 'on') {
                $html .= '<a href="http://www.google.com/bookmarks/mark?op=edit&#038;bkmk=' . $pageurl . '&#038;title=' . get_the_title() . '" target="_blank" class="share_google_bookmark"></a>';
            }
            if ($google_buzz == 'on') {
                $html .= '<a href="http://www.google.com/reader/link?title=' . get_the_title() . '&url=' . get_permalink() . '" target="_blank" class="share_google_buzz"></a>';
            }
            if ($google_plus == 'on') {
                $html .= '<a href="https://plus.google.com/share?url=' . get_permalink() . '" target="_blank" class="share_google_plus"></a>';
            }
            if ($myspace == 'on') {
                $html .= '<a href="http://www.myspace.com/Modules/PostTo/Pages/?u=' . $pageurl . '" target="_blank" class="share_myspace"></a>';
            }
            if ($reddit == 'on') {
                $html .= '<a href="http://reddit.com/submit?url=' . $pageurl . '&#038;title=' . get_the_title() . '" target="_blank" class="share_reddit"></a>';
            }
            if ($stumbleupon == 'on') {
                $html .= '<a href="http://www.stumbleupon.com/submit?url=' . $pageurl . '&#038;title=' . get_the_title() . '" target="_blank" class="share_stumbleupon"></a>';
            }
            if ($rss == 'on') {
                $html .= '<a href="#" target="_blank" class="share_rss"></a>';
            }
        }
        echo $html;
    }

}
if (!function_exists('record_per_page_default_pages')) {

    function record_per_page_default_pages() {
        $record_per_page = '';
        $cs_pagination = '';
        $cs_default_pages = get_option("cs_default_pages");
        if ($cs_default_pages <> "") {
            $cs_xmlObject = simplexml_load_string($cs_default_pages);
            $record_per_page = isset($cs_xmlObject->record_per_page) ? $cs_xmlObject->record_per_page : '';
            $cs_pagination = isset($cs_xmlObject->cs_pagination) ? $cs_xmlObject->cs_pagination : '';
            if ($cs_pagination == 'Single Page')
                $record_per_page = '-1';
        }
        return $record_per_page;
    }

}
// change the default query variable start
if (!function_exists('cs_change_query_vars')) {

    function cs_change_query_vars($query) {
        if (is_search() || is_archive() || is_author() || is_tax() || is_tag() || is_category()) {
            if (empty($_GET['page_id_all']))
                $_GET['page_id_all'] = 1;
            $record_per_page = record_per_page_default_pages();
            $query->query_vars['posts_per_page'] = "$record_per_page"; // Change number of posts you would like to show
            $query->query_vars['paged'] = $_GET['page_id_all'];
            //$query->query_vars['post_type'] = array('post', 'classes-schedule', 'facility');
        }
        return $query; // Return modified query variables
    }

}
// change the default query variable end
// pagination start
if (!function_exists('cs_pagination')) {

    function cs_pagination($total_records, $per_page, $qrystr = '') {
        $html = '';
        $dot_pre = '';
        $dot_more = '';
        $total_page = ceil($total_records / $per_page);
        $loop_start = $_GET['page_id_all'] - 2;
        $loop_end = $_GET['page_id_all'] + 2;
        if ($_GET['page_id_all'] < 3) {
            $loop_start = 1;
            if ($total_page < 5)
                $loop_end = $total_page;
            else
                $loop_end = 5;
        }
        else if ($_GET['page_id_all'] >= $total_page - 1) {
            if ($total_page < 5)
                $loop_start = 1;
            else
                $loop_start = $total_page - 4;
            $loop_end = $total_page;
        }
        if ($_GET['page_id_all'] > 1)
            $html .= "<li><a href='?page_id_all=" . ($_GET['page_id_all'] - 1) . "$qrystr'>" . __('&lt; Prev', CSDOMAIN) . "</a></li>";
        if ($_GET['page_id_all'] > 3 and $total_page > 5)
            $html .= "<li><a href='?page_id_all=1$qrystr'>1</a></li>";
        if ($_GET['page_id_all'] > 4 and $total_page > 6)
            $html .= "<li> <strong>. . .</strong> </li>";
        if ($total_page > 1) {
            for ($i = $loop_start; $i <= $loop_end; $i++) {
                if ($i <> $_GET['page_id_all'])
                    $html .= "<li><a href='?page_id_all=$i$qrystr'>" . $i . "</a></li>";
                else
                    $html .= "<li><a class='active'>" . $i . "</a></li>";
            }
        }
        if ($loop_end <> $total_page and $loop_end <> $total_page - 1)
            $html .= "<li> <strong>. . .</strong> </li>";
        if ($loop_end <> $total_page)
            $html .= "<li><a href='?page_id_all=$total_page$qrystr'>$total_page</a></li>";
        if ($_GET['page_id_all'] < $total_records / $per_page)
            $html .= "<li><a href='?page_id_all=" . ($_GET['page_id_all'] + 1) . "$qrystr'>" . __('Next', CSDOMAIN) . "</a></li>";
        return $html;
    }

}
// pagination end

if (!function_exists('__CS')) {

    function __CS($str, $default = '') {
        $locale = get_locale();
        $lang = get_option('lang_theme');
        $trans[] = get_option('cs_trans_events');
        $trans[] = get_option('cs_trans_courses');
        $trans[] = get_option('cs_trans_contact');
        $trans[] = get_option('cs_trans_others');
        $value = '';
        try
        {
            foreach ($trans as $tr) {
            $sxe = new SimpleXMLElement($tr);
            if (isset($sxe->$str) && $sxe->$str != '')
                $value = $sxe->$str;
            if ($value)
                return $value;
        }
        return $default;
        }
        catch(Exception $e)
        {

        }

    }

}

if (!function_exists('languageswitcher')) {

    function languageswitcher($str, $default = '') {
        $str = isset($str) ? $str : '';
        global $cs_transwitch;
        if ($cs_transwitch == 'on') {
            echo translate($default, CSDOMAIN);
        } else {

            echo __CS($str, $default);
        }
    }

}
if (!function_exists('events_meta_save')) {

    function events_meta_save($post_id) {
        global $wpdb;
        if (empty($_POST["event_social_sharing"]))
            $_POST["event_social_sharing"] = "";
        if (empty($_POST["event_start_time"]))
            $_POST["event_start_time"] = "";
        if (empty($_POST["event_end_time"]))
            $_POST["event_end_time"] = "";
        if (empty($_POST["event_all_day"]))
            $_POST["event_all_day"] = "";
        if (empty($_POST["event_booking_url"]))
            $_POST["event_booking_url"] = "";
        if (empty($_POST["event_address"]))
            $_POST["event_address"] = "";
        $sxe = new SimpleXMLElement("<event></event>");
        $sxe->addChild('event_social_sharing', $_POST["event_social_sharing"]);
        $sxe->addChild('event_start_time', $_POST["event_start_time"]);
        $sxe->addChild('event_end_time', $_POST["event_end_time"]);
        $sxe->addChild('event_all_day', $_POST["event_all_day"]);
        $sxe->addChild('event_booking_url', htmlspecialchars($_POST["event_booking_url"]));
        $sxe->addChild('event_address', $_POST["event_address"]);
        $sxe = save_layout_xml($sxe);
        update_post_meta($post_id, 'cs_event_meta', $sxe->asXML());
    }

}
if (!function_exists('cs_get_post_thumbnail')) {

    function cs_get_post_thumbnail($post_id, $width, $height) {
        //if ( has_post_thumbnail()) {}
        $image_id = get_post_thumbnail_id($post_id);
        $image_url = wp_get_attachment_image_src((int) $image_id, array($width, $height), true);
        if ($image_url[1] == $width and $image_url[2] == $height) {
            return get_the_post_thumbnail($post_id, array($width, $height));
        } else {
            return get_the_post_thumbnail($post_id, "full");
        }
    }

}
if (!function_exists('cs_attachment_image_src')) {

    function cs_attachment_image_src($attachment_id, $width, $height) {
        $image_url = wp_get_attachment_image_src((int) $attachment_id, array($width, $height), true);
        if ($image_url[1] <> $width or $image_url[2] <> $height) {
            $image_url = wp_get_attachment_image_src((int) $attachment_id, "full", true);
        }
        return $image_url[0];
    }

}
if (!function_exists('get_google_fonts')) {

    function get_google_fonts() {
        $fonts = array("Abel", "Aclonica", "Acme", "Actor", "Advent Pro", "Aldrich", "Allerta", "Allerta Stencil", "Amaranth", "Andika", "Anonymous Pro", "Antic", "Anton", "Arimo", "Armata", "Asap", "Asul",
            "Basic", "Belleza", "Cabin", "Cabin Condensed", "Cagliostro", "Candal", "Cantarell", "Carme", "Chau Philomene One", "Chivo", "Coda Caption", "Comfortaa", "Convergence", "Cousine", "Cuprum", "Days One",
            "Didact Gothic", "Doppio One", "Dorsa", "Dosis", "Droid Sans", "Droid Sans Mono", "Duru Sans", "Economica", "Electrolize", "Exo", "Federo", "Francois One", "Fresca", "Galdeano", "Geo", "Gudea",
            "Hammersmith One", "Homenaje", "Imprima", "Inconsolata", "Inder", "Istok Web", "Jockey One", "Josefin Sans", "Jura", "Karla", "Krona One", "Lato", "Lekton", "Magra", "Mako", "Marmelad", "Marvel",
            "Maven Pro", "Metrophobic", "Michroma", "Molengo", "Montserrat", "Muli", "News Cycle", "Nobile", "Numans", "Nunito", "Open Sans", "Open Sans Condensed", "Orbitron", "Oswald", "Oxygen", "PT Mono",
            "PT Sans", "PT Sans Caption", "PT Sans Narrow", "Paytone One", "Philosopher", "Play", "Pontano Sans", "Port Lligat Sans", "Puritan", "Quantico", "Quattrocento Sans", "Questrial", "Quicksand", "Rationale",
            "Ropa Sans", "Rosario", "Ruda", "Ruluko", "Russo One", "Shanti", "Sigmar One", "Signika", "Signika Negative", "Six Caps", "Snippet", "Spinnaker", "Syncopate", "Telex", "Tenor Sans", "Ubuntu",
            "Ubuntu Condensed", "Ubuntu Mono", "Varela", "Varela Round", "Viga", "Voltaire", "Wire One", "Yanone Kaffeesatz", "Adamina", "Alegreya", "Alegreya SC", "Alice", "Alike", "Alike Angular", "Almendra",
            "Almendra SC", "Amethysta", "Andada", "Antic Didone", "Antic Slab", "Arapey", "Artifika", "Arvo", "Average", "Balthazar", "Belgrano", "Bentham", "Bevan", "Bitter", "Brawler", "Bree Serif", "Buenard",
            "Cambo", "Cantata One", "Cardo", "Caudex", "Copse", "Coustard", "Crete Round", "Crimson Text", "Cutive", "Della Respira", "Droid Serif", "EB Garamond", "Enriqueta", "Esteban", "Fanwood Text", "Fjord One",
            "Gentium Basic", "Gentium Book Basic", "Glegoo", "Goudy Bookletter 1911", "Habibi", "Holtwood One SC", "IM Fell DW Pica", "IM Fell DW Pica SC", "IM Fell Double Pica", "IM Fell Double Pica SC",
            "IM Fell English", "IM Fell English SC", "IM Fell French Canon", "IM Fell French Canon SC", "IM Fell Great Primer", "IM Fell Great Primer SC", "Inika", "Italiana", "Josefin Slab", "Judson", "Junge",
            "Kameron", "Kotta One", "Kreon", "Ledger", "Linden Hill", "Lora", "Lusitana", "Lustria", "Marko One", "Mate", "Mate SC", "Merriweather", "Montaga", "Neuton", "Noticia Text", "Old Standard TT", "Ovo",
            "PT Serif", "PT Serif Caption", "Petrona", "Playfair Display", "Podkova", "Poly", "Port Lligat Slab", "Prata", "Prociono", "Quattrocento", "Radley", "Rokkitt", "Rosarivo", "Simonetta", "Sorts Mill Goudy",
            "Stoke", "Tienne", "Tinos", "Trocchi", "Trykker", "Ultra", "Unna", "Vidaloka", "Volkhov", "Vollkorn", "Abril Fatface", "Aguafina Script", "Aladin", "Alex Brush", "Alfa Slab One", "Allan", "Allura",
            "Amatic SC", "Annie Use Your Telescope", "Arbutus", "Architects Daughter", "Arizonia", "Asset", "Astloch", "Atomic Age", "Aubrey", "Audiowide", "Averia Gruesa Libre", "Averia Libre", "Averia Sans Libre",
            "Averia Serif Libre", "Bad Script", "Bangers", "Baumans", "Berkshire Swash", "Bigshot One", "Bilbo", "Bilbo Swash Caps", "Black Ops One", "Bonbon", "Boogaloo", "Bowlby One", "Bowlby One SC",
            "Bubblegum Sans", "Buda", "Butcherman", "Butterfly Kids", "Cabin Sketch", "Caesar Dressing", "Calligraffitti", "Carter One", "Cedarville Cursive", "Ceviche One", "Changa One", "Chango", "Chelsea Market",
            "Cherry Cream Soda", "Chewy", "Chicle", "Coda", "Codystar", "Coming Soon", "Concert One", "Condiment", "Contrail One", "Cookie", "Corben", "Covered By Your Grace", "Crafty Girls", "Creepster", "Crushed",
            "Damion", "Dancing Script", "Dawning of a New Day", "Delius", "Delius Swash Caps", "Delius Unicase", "Devonshire", "Diplomata", "Diplomata SC", "Dr Sugiyama", "Dynalight", "Eater", "Emblema One",
            "Emilys Candy", "Engagement", "Erica One", "Euphoria Script", "Ewert", "Expletus Sans", "Fascinate", "Fascinate Inline", "Federant", "Felipa", "Flamenco", "Flavors", "Fondamento", "Fontdiner Swanky",
            "Forum", "Fredericka the Great", "Fredoka One", "Frijole", "Fugaz One", "Geostar", "Geostar Fill", "Germania One", "Give You Glory", "Glass Antiqua", "Gloria Hallelujah", "Goblin One", "Gochi Hand",
            "Gorditas", "Graduate", "Gravitas One", "Great Vibes", "Gruppo", "Handlee", "Happy Monkey", "Henny Penny", "Herr Von Muellerhoff", "Homemade Apple", "Iceberg", "Iceland", "Indie Flower", "Irish Grover",
            "Italianno", "Jim Nightshade", "Jolly Lodger", "Julee", "Just Another Hand", "Just Me Again Down Here", "Kaushan Script", "Kelly Slab", "Kenia", "Knewave", "Kranky", "Kristi", "La Belle Aurore",
            "Lancelot", "League Script", "Leckerli One", "Lemon", "Lilita One", "Limelight", "Lobster", "Lobster Two", "Londrina Outline", "Londrina Shadow", "Londrina Sketch", "Londrina Solid",
            "Love Ya Like A Sister", "Loved by the King", "Lovers Quarrel", "Luckiest Guy", "Macondo", "Macondo Swash Caps", "Maiden Orange", "Marck Script", "Meddon", "MedievalSharp", "Medula One", "Megrim",
            "Merienda One", "Metamorphous", "Miltonian", "Miltonian Tattoo", "Miniver", "Miss Fajardose", "Modern Antiqua", "Monofett", "Monoton", "Monsieur La Doulaise", "Montez", "Mountains of Christmas",
            "Mr Bedfort", "Mr Dafoe", "Mr De Haviland", "Mrs Saint Delafield", "Mrs Sheppards", "Mystery Quest", "Neucha", "Niconne", "Nixie One", "Norican", "Nosifer", "Nothing You Could Do", "Nova Cut",
            "Nova Flat", "Nova Mono", "Nova Oval", "Nova Round", "Nova Script", "Nova Slim", "Nova Square", "Oldenburg", "Oleo Script", "Original Surfer", "Over the Rainbow", "Overlock", "Overlock SC", "Pacifico",
            "Parisienne", "Passero One", "Passion One", "Patrick Hand", "Patua One", "Permanent Marker", "Piedra", "Pinyon Script", "Plaster", "Playball", "Poiret One", "Poller One", "Pompiere", "Press Start 2P",
            "Princess Sofia", "Prosto One", "Qwigley", "Raleway", "Rammetto One", "Rancho", "Redressed", "Reenie Beanie", "Revalia", "Ribeye", "Ribeye Marrow", "Righteous", "Rochester", "Rock Salt", "Rouge Script",
            "Ruge Boogie", "Ruslan Display", "Ruthie", "Sail", "Salsa", "Sancreek", "Sansita One", "Sarina", "Satisfy", "Schoolbell", "Seaweed Script", "Sevillana", "Shadows Into Light", "Shadows Into Light Two",
            "Share", "Shojumaru", "Short Stack", "Sirin Stencil", "Slackey", "Smokum", "Smythe", "Sniglet", "Sofia", "Sonsie One", "Special Elite", "Spicy Rice", "Spirax", "Squada One", "Stardos Stencil",
            "Stint Ultra Condensed", "Stint Ultra Expanded", "Sue Ellen Francisco", "Sunshiney", "Supermercado One", "Swanky and Moo Moo", "Tangerine", "The Girl Next Door", "Titan One", "Trade Winds", "Trochut",
            "Tulpen One", "Uncial Antiqua", "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "VT323", "Vast Shadow", "Vibur", "Voces", "Waiting for the Sunrise", "Wallpoet", "Walter Turncoat",
            "Wellfleet", "Yellowtail", "Yeseva One", "Yesteryear", "Zeyada");
        return $fonts;
    }

}
if (!function_exists('get_countries')) {

    function get_countries() {
        $get_countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan",
            "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "British Virgin Islands",
            "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China",
            "Colombia", "Comoros", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Democratic People's Republic of Korea", "Democratic Republic of the Congo", "Denmark", "Djibouti",
            "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "England", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "French Polynesia",
            "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong",
            "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan",
            "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia",
            "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique",
            "Myanmar(Burma)", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Northern Ireland",
            "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico",
            "Qatar", "Republic of the Congo", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa",
            "San Marino", "Saudi Arabia", "Scotland", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
            "South Korea", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga",
            "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "US Virgin Islands", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay",
            "Uzbekistan", "Vanuatu", "Vatican", "Venezuela", "Vietnam", "Wales", "Yemen", "Zambia", "Zimbabwe");
        return $get_countries;
    }

}
if (!function_exists('save_layout_xml')) {

    function save_layout_xml($sxe) {
        if (empty($_POST['cs_layout']))
            $_POST['cs_layout'] = "";
        if (empty($_POST['cs_sidebar_left']))
            $_POST['cs_sidebar_left'] = "";
        if (empty($_POST['cs_sidebar_right']))
            $_POST['cs_sidebar_right'] = "";
        $sxe->addChild('cs_layout', $_POST["cs_layout"]);
        if ($_POST["cs_layout"] == "left") {
            $sxe->addChild('cs_sidebar_left', $_POST['cs_sidebar_left']);
        } else if ($_POST["cs_layout"] == "right") {
            $sxe->addChild('cs_sidebar_right', $_POST['cs_sidebar_right']);
        } else if ($_POST["cs_layout"] == "both_right" or $_POST["cs_layout"] == "both_left" or $_POST["cs_layout"] == "both") {
            $sxe->addChild('cs_sidebar_left', $_POST['cs_sidebar_left']);
            $sxe->addChild('cs_sidebar_right', $_POST['cs_sidebar_right']);
        }
        return $sxe;
    }

}

// installing tables on theme activating start
if (!function_exists('cs_activate_widget')) {

    function cs_activate_widget() {
        $sidebars_widgets = get_option('sidebars_widgets');  //collect widget informations
        // ---- Principle message widget setting---
        $priciple_msg = array();
        $priciple_msg[1] = array(
            "title" => "Massage From Priciple",
            "widgettitle" => "Allen Fengosen",
            "txt_img" => get_template_directory_uri() . "/images/welcome.jpg",
            "txt_description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. In at nunc quam, ac molestie nisi. Duis nisi elit, dignissim non volutpat nec adipiscing ac odio Lorem ipsum dolor sit amet, consectetur adipiscing elit. In at nunc quam, ac molestie nisi.Lorem ipsum dolor sit amet, consectetur adipiscing elit. In at nunc quam, ac molestie nisi. Duis nisi elit, dignissim non vol...",
            "textcounter" => "800",
        );
        $priciple_msg['_multiwidget'] = '1';
        update_option('widget_princple_msg', $priciple_msg);
        $priciple_msg = get_option('widget_princple_msg');
        krsort($priciple_msg);
        foreach ($priciple_msg as $key1 => $val1) {
            $priciple_msg_key = $key1;
            if (is_int($priciple_msg_key)) {
                break;
            }
        }

        // --- Campus and comunity widget  setting ---
        $campus = array();
        $campus[1] = array(
            'title' => 'CAMPUS & COMMUNITY',
            'text' => '<div class="box-in"><a class="thumb"><img alt="CAMPUS & COMMUNITY" src="' . get_template_directory_uri() . '/images/img2.jpg"></a>
			<h4 class="colr">Schools Liaison Officer Diary Pembroke and St Catharine</h4>
			</div>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In at nunc quam, ac molestie nisi. Duis nis... </p>',
        );
        $campus['_multiwidget'] = '1';
        update_option('widget_text', $campus);
        $campus = get_option('widget_text');
        krsort($campus);
        foreach ($campus as $key1 => $val1) {
            $campus_key = $key1;
            if (is_int($campus_key)) {
                break;
            }
        }

        // --- Quick links widget  setting ---
        $quick = array();
        $quick = get_option('widget_text');
        $quick[2] = array(
            'title' => 'QUICK LINKS',
            'text' => '<div class="box-in"><a class="thumb"><img alt="QUICK LINKS" src="' . get_template_directory_uri() . '/images/img3.jpg"></a>
			<h4 class="colr">SCHOOLS & DEPARTMENTS</h4>
			</div>
			<p> Business Earth Sciences Education Engineering Departments (A - Z) As an internationalised university of technology and design, RMIT brings unique capabilities and solutions to research through a transdisciplinary approach that considers both the technological and social dimensions of the work at hand. </p>',
        );
        $quick['_multiwidget'] = '1';
        update_option('widget_text', $quick);
        $quick = get_option('widget_text');
        krsort($quick);
        foreach ($quick as $key1 => $val1) {
            $quick_key = $key1;
            if (is_int($quick_key)) {
                break;
            }
        }

        // --- Home Page Search widget setting ---
        $center_search = array();
        $center_search = get_option('widget_search_field');
        $center_search[1] = array(
            'title' => 'COLLEGE COURSE FINDER'
        );
        $center_search['_multiwidget'] = '1';
        update_option('widget_search_field', $center_search);
        $center_search = get_option('widget_search_field');
        krsort($center_search);
        foreach ($center_search as $key1 => $val1) {
            $center_search_key = $key1;
            if (is_int($center_search_key)) {
                break;
            }
        }

        // --- Home Page News widget setting ---
        $center_news = array();
        $center_news = get_option('widget_blogpost_show');
        $center_news[1] = array(
            'title' => 'UNIVERSITY NEWS',
            'get_names_posts' => '4',
            'nop' => '4'
        );
        $center_news['_multiwidget'] = '1';
        update_option('widget_blogpost_show', $center_news);
        $center_news = get_option('widget_blogpost_show');
        krsort($center_news);
        foreach ($center_news as $key1 => $val1) {
            $center_news_key = $key1;
            if (is_int($center_news_key)) {
                break;
            }
        }

        // --- Home Page Countdown widget setting ---
        $right_counter = array();
        $right_counter = get_option('widget_upcomingevents_count_recent');
        $right_counter[1] = array(
            'title' => 'UPCOMING EVENTS',
            'get_names_events' => '31',
            'numevents' => '4'
        );
        $right_counter['_multiwidget'] = '1';
        update_option('widget_upcomingevents_count_recent', $right_counter);
        $right_counter = get_option('widget_upcomingevents_count_recent');
        krsort($right_counter);
        foreach ($right_counter as $key1 => $val1) {
            $right_counter_key = $key1;
            if (is_int($right_counter_key)) {
                break;
            }
        }

        // --- Home Page Gallery widget setting ---
        $right_gallery = array();
        $right_gallery[1] = array(
            'title' => 'THIS WEEK IN PHOTOS',
            'get_names_gallery' => '52',
            'viewall_images' => '?page_id=117',
            'numevents' => '6'
        );
        $right_gallery['_multiwidget'] = '1';
        update_option('widget_cs_gallery', $right_gallery);
        $right_gallery = get_option('widget_cs_gallery');
        krsort($right_gallery);
        foreach ($right_gallery as $key1 => $val1) {
            $right_gallery_key = $key1;
            if (is_int($right_gallery_key)) {
                break;
            }
        }

        // --- Home Page facebook widget setting ---
        $right_facebook = array();
        $right_facebook[1] = array(
            'title' => 'Facebook',
            'pageurl' => 'https://www.facebook.com/envato',
            'showfaces' => 'on',
            'fb_bg_color' => '#fff',
            'likebox_height' => '270'
        );
        $right_facebook['_multiwidget'] = '1';
        update_option('widget_facebook_module', $right_facebook);
        $right_facebook = get_option('widget_facebook_module');
        krsort($right_facebook);
        foreach ($right_facebook as $key1 => $val1) {
            $right_facebook_key = $key1;
            if (is_int($right_facebook_key)) {
                break;
            }
        }

        // --- Footer logo widget setting ---
        $footer_logo = array();
        $footer_logo = get_option('widget_text');
        $footer_logo[3] = array(
            'title' => '',
            'text' => '<div class="widget latest-videos"><a href="#"><img alt="" src="' . get_template_directory_uri() . '/images/logo.png"></a>
			<p>P.O Box 1234 New York
Your City, City Name and Code 12345
Call: (800) 12-34567
Fax: (123) 345-6789
email@yourcompany.com</p></div>',
        );
        $footer_logo['_multiwidget'] = '1';
        update_option('widget_text', $footer_logo);
        $footer_logo = get_option('widget_text');
        krsort($footer_logo);
        foreach ($footer_logo as $key1 => $val1) {
            $footer_logo_key = $key1;
            if (is_int($footer_logo_key)) {
                break;
            }
        }

        // --- Footer Social widget setting ---
        $footer_social = array();
        $footer_social[1] = array(
            'title' => 'Follow Us',
            'social_sharing' => 'Yes',
        );
        $footer_social['_multiwidget'] = '1';
        update_option('widget_social_sharing', $footer_social);
        $footer_social = get_option('widget_social_sharing');
        krsort($footer_social);
        foreach ($footer_social as $key1 => $val1) {
            $footer_social_key = $key1;
            if (is_int($footer_social_key)) {
                break;
            }
        }

        // --- Footer About widget setting ---
        $footer_about = array();
        $footer_about = get_option('widget_text');
        $footer_about[4] = array(
            'title' => 'About us',
            'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In at nunc quam, ac molestie nisi. Duis nisi elit, dignissim non volutpat nec adipiscing ac odio Lorem ipsum dolor sit amet, consectetur adipiscing elit. In at nunc quam, ac molestie nisi.Lorem ipsum dolor sit amet, consectetur adipiscing elit. In at nunc quam.</p>',
        );
        $footer_about['_multiwidget'] = '1';
        update_option('widget_text', $footer_about);
        $footer_about = get_option('widget_text');
        krsort($footer_about);
        foreach ($footer_about as $key1 => $val1) {
            $footer_about_key = $key1;
            if (is_int($footer_about_key)) {
                break;
            }
        }

        // --- Footer Newsletter widget setting ---
        $footer_newsletter = array();
        $footer_newsletter[1] = array(
            'title' => 'Sing Up For Newsletter',
            'short_desc' => 'By subscribing to our mailing list you will always be update with the latest news from us.'
        );
        $footer_newsletter['_multiwidget'] = '1';
        update_option('widget_newsletter', $footer_newsletter);
        $footer_newsletter = get_option('widget_newsletter');
        krsort($footer_newsletter);
        foreach ($footer_newsletter as $key1 => $val1) {
            $footer_newsletter_key = $key1;
            if (is_int($footer_newsletter_key)) {
                break;
            }
        }

        // --- Contact Page Twitter widget setting ---
        $conatct_twitter = array();
        $conatct_twitter[1] = array(
            'title' => 'Follow Us On Twitter',
            'username' => 'Envato',
            'numoftweets' => '2'
        );
        $conatct_twitter['_multiwidget'] = '1';
        update_option('widget_cs_twitter_widget', $conatct_twitter);
        $conatct_twitter = get_option('widget_cs_twitter_widget');
        krsort($conatct_twitter);
        foreach ($conatct_twitter as $key1 => $val1) {
            $conatct_twitter_key = $key1;
            if (is_int($conatct_twitter_key)) {
                break;
            }
        }

        // --- Contact Page facebook widget setting ---
        $conatct_facebook = array();
        $conatct_facebook = get_option('widget_facebook_module');
        $conatct_facebook[2] = array(
            'title' => 'Facebook',
            'pageurl' => 'https://www.facebook.com/envato',
            'showfaces' => 'on',
            'fb_bg_color' => '#fff',
            'likebox_height' => '320'
        );
        $conatct_facebook['_multiwidget'] = '1';
        update_option('widget_facebook_module', $conatct_facebook);
        $conatct_facebook = get_option('widget_facebook_module');
        krsort($conatct_facebook);
        foreach ($conatct_facebook as $key1 => $val1) {
            $conatct_facebook_key = $key1;
            if (is_int($conatct_facebook_key)) {
                break;
            }
        }

        // --- Contact Page Newsletter widget setting ---
        $conatct_newsletter = array();
        $conatct_newsletter = get_option('widget_newsletter');
        $conatct_newsletter[2] = array(
            'title' => 'Newsletter',
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eget ullamcorper urna. Aliquam massa lacus, lobortis eg...'
        );
        $conatct_newsletter['_multiwidget'] = '1';
        update_option('widget_newsletter', $conatct_newsletter);
        $conatct_newsletter = get_option('widget_newsletter');
        krsort($conatct_newsletter);
        foreach ($conatct_newsletter as $key1 => $val1) {
            $conatct_newsletter_key = $key1;
            if (is_int($conatct_newsletter_key)) {
                break;
            }
        }

        // --- Blog Text widget setting ---
        $blog_text_img = array();
        $blog_text_img = get_option('widget_text');
        $blog_text_img[5] = array(
            'title' => '',
            'text' => '<img src="' . get_template_directory_uri() . '/images/kc.jpg" alt="">',
        );
        $blog_text_img['_multiwidget'] = '1';
        update_option('widget_text', $blog_text_img);
        $blog_text_img = get_option('widget_text');
        krsort($blog_text_img);
        foreach ($blog_text_img as $key1 => $val1) {
            $blog_text_img_key = $key1;
            if (is_int($blog_text_img_key)) {
                break;
            }
        }

        // ---- Blog tags widget setting---
        $tag_cloud = array();
        $tag_cloud[1] = array(
            "title" => 'Tags',
            "taxonomy" => 'Tags',
        );
        $tag_cloud['_multiwidget'] = '1';
        update_option('widget_tag_cloud', $tag_cloud);
        $tag_cloud = get_option('widget_tag_cloud');
        krsort($tag_cloud);
        foreach ($tag_cloud as $key1 => $val1) {
            $tag_cloud_key = $key1;
            if (is_int($tag_cloud_key)) {
                break;
            }
        }

        // ---- Blog archive widget setting---
        $archives = array();
        $archives[1] = array(
            "title" => "Archives",
            "count" => "checked",
            "dropdown" => ""
        );
        $archives['_multiwidget'] = '1';
        update_option('widget_chimp_archives', $archives);
        $archives = get_option('widget_chimp_archives');
        krsort($archives);
        foreach ($archives as $key1 => $val1) {
            $archives_key = $key1;
            if (is_int($archives_key)) {
                break;
            }
        }

        // --- Blog Page Gallery widget setting ---
        $blog_gallery = array();
        $blog_gallery = get_option('widget_cs_gallery');
        $blog_gallery[2] = array(
            'title' => 'Showcase',
            'get_names_gallery' => '52',
            'viewall_images' => '?page_id=117',
            'numevents' => '9'
        );
        $blog_gallery['_multiwidget'] = '1';
        update_option('widget_cs_gallery', $blog_gallery);
        $blog_gallery = get_option('widget_cs_gallery');
        krsort($blog_gallery);
        foreach ($blog_gallery as $key1 => $val1) {
            $blog_gallery_key = $key1;
            if (is_int($blog_gallery_key)) {
                break;
            }
        }

        // ---- Courses message widget setting---
        $courses_msg = array();
        $courses_msg = get_option('widget_princple_msg');
        $courses_msg[2] = array(
            "title" => "New Classes",
            "widgettitle" => "Join Today",
            "txt_img" => get_template_directory_uri() . "/images/new_classes.jpg",
            "txt_description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam cursus nulla ullamcorper dolor tincidunt adipiscing.ipsum dolor sit amet, consectetur adipiscing elit. Nullam cursus nulla ullamcorper dolor.ipsum dolor sit amet, consectetur adipiscing elit. Nullam cursus nulla ullamcorper dolor.",
            "textcounter" => "800",
        );
        $courses_msg['_multiwidget'] = '1';
        update_option('widget_princple_msg', $courses_msg);
        $courses_msg = get_option('widget_princple_msg');
        krsort($courses_msg);
        foreach ($courses_msg as $key1 => $val1) {
            $courses_msg_key = $key1;
            if (is_int($courses_msg_key)) {
                break;
            }
        }
        // ---- Courses recent comments widget setting---
        $courses_recent_coments = array();
        $courses_recent_coments[1] = array(
            "title" => "Recent Comments",
            "number" => "4"
        );
        $courses_recent_coments['_multiwidget'] = '1';
        update_option('widget_recent-comments', $courses_recent_coments);
        $courses_recent_coments = get_option('widget_recent-comments');
        krsort($courses_recent_coments);
        foreach ($courses_recent_coments as $key1 => $val1) {
            $courses_recent_coments_key = $key1;
            if (is_int($courses_recent_coments_key)) {
                break;
            }
        }


        $sidebars_widgets['left-sidebar'] = array("princple_msg-$priciple_msg_key", "text-$campus_key", "text-$quick_key");
        $sidebars_widgets['center-sidebar'] = array("search_field-$center_search_key", "blogpost_show-$center_news_key");
        $sidebars_widgets['right-sidebar'] = array("upcomingevents_count_recent-$right_counter_key", "cs_gallery-$right_gallery_key", "facebook_module-$right_facebook_key");
        $sidebars_widgets['footer-sidebar'] = array("text-$footer_logo_key", "social_sharing-$footer_social_key", "text-$footer_about_key", "newsletter-$footer_newsletter_key");
        $sidebars_widgets['Contact us'] = array("cs_twitter_widget-$conatct_twitter_key", "facebook_module-$conatct_facebook_key", "newsletter-$conatct_newsletter_key");
        $sidebars_widgets['Sidebar'] = array("facebook_module-$right_facebook_key", "cs_twitter_widget-$conatct_twitter_key", "text-$blog_text_img_key", "newsletter-$conatct_newsletter_key");
        $sidebars_widgets['Blog'] = array("tag_cloud-$tag_cloud_key", "cs_gallery-$blog_gallery_key", "chimp_archives-$archives_key");
        $sidebars_widgets['Courses'] = array("princple_msg-$courses_msg_key", "cs_twitter_widget-$conatct_twitter_key");
        $sidebars_widgets['Courses Both sidebar'] = array("text-$blog_text_img_key", "newsletter-$footer_newsletter_key", "text-$campus_key");
        $sidebars_widgets['Courses Both sidebar 1'] = array("text-$campus_key", "recent-comments-$courses_recent_coments_key", "text-$blog_text_img_key");
        $sidebars_widgets['Gallery'] = array("text-$blog_text_img_key", "cs_gallery-$blog_gallery_key", "text-$campus_key");

        update_option('sidebars_widgets', $sidebars_widgets);  //save widget iformations
    }

}
if (!function_exists('cs_activation_data')) {

    function cs_activation_data() {
        global $wpdb;

		if( ! get_option("cs_theme_name") ) {
			$wpdb->query("
				CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "cs_newsletter` (
				  `email` varchar(100) NOT NULL,
				  `ip` varchar(16) NOT NULL,
				  `date_time` datetime NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;
			");
			/*
			  $theme_mod_val = array();
			  $term_exists = term_exists('main-menu', 'nav_menu');
			  if ( !$term_exists ) {
			  $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "terms` VALUES ('', 'Main Menu' , 'main-menu', '0'); ");
			  $insert_id = $wpdb->insert_id;
			  $theme_mod_val['main-menu'] = $insert_id;
			  $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "term_taxonomy` VALUES ('', '".$insert_id."' , 'nav_menu', '', '0', '0'); ");
			  }
			  else $theme_mod_val['main-menu'] = $term_exists['term_id'];
			  $term_exists = term_exists('top-menu', 'nav_menu');
			  if ( !$term_exists ) {
			  $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "terms` VALUES ('', 'Top Menu' , 'top-menu', '0'); ");
			  $insert_id = mysql_insert_id();
			  $theme_mod_val['top-menu'] = $insert_id;
			  $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "term_taxonomy` VALUES ('', '".$insert_id."' , 'nav_menu', '', '0', '0'); ");
			  }
			  else $theme_mod_val['top-menu'] = $term_exists['term_id'];
			  set_theme_mod( 'nav_menu_locations', $theme_mod_val ); */

			//$gfonts = json_decode(@file_get_contents('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAmnx95iAIwGwfUBnX6D645dQPyMyRGGpc'));
			//if($gfonts)	update_option('cs_google_fonts', $gfonts);
			// adding tempalte ready made start
			$cs_page_builder_template_readymade = '<?xml version="1.0"?>
		<pagebuilder_templates><template name="Ready Made Template - Gallery"><rich_editor><cs_rich_editor_title>Yes</cs_rich_editor_title><cs_rich_editor_desc>Yes</cs_rich_editor_desc></rich_editor><gallery><layout>cs_gal_4_column</layout><album>0</album><title>On</title><desc>On</desc><pagination>Show Pagination</pagination><media_per_page>5</media_per_page></gallery></template><template name="Ready Made Template - Event"><rich_editor><cs_rich_editor_title>Yes</cs_rich_editor_title><cs_rich_editor_desc>Yes</cs_rich_editor_desc></rich_editor><event><cs_event_title/><cs_event_view>List View</cs_event_view><cs_event_type>All Events</cs_event_type><cs_event_category>0</cs_event_category><cs_event_time>Yes</cs_event_time><cs_event_organizer>Yes</cs_event_organizer><cs_event_map>Yes</cs_event_map><cs_event_excerpt>255</cs_event_excerpt><cs_event_filterables>No</cs_event_filterables><cs_event_pagination>Show Pagination</cs_event_pagination><cs_event_per_page>5</cs_event_per_page></event></template><template name="Ready Made Template - Slider"><rich_editor><cs_rich_editor_title>Yes</cs_rich_editor_title><cs_rich_editor_desc>Yes</cs_rich_editor_desc></rich_editor><slider><slider_type>Anything Slider</slider_type><slider>0</slider><width>500</width><height>300</height></slider></template><template name="Ready Made Template - Blog"><rich_editor><cs_rich_editor_title>Yes</cs_rich_editor_title><cs_rich_editor_desc>Yes</cs_rich_editor_desc></rich_editor><blog><cs_blog_title></cs_blog_title><cs_blog_cat>0</cs_blog_cat><cs_blog_excerpt>255</cs_blog_excerpt><cs_blog_num_post>5</cs_blog_num_post><cs_blog_pagination>Show Pagination</cs_blog_pagination></blog></template></pagebuilder_templates>';
			update_option("cs_page_builder_template_readymade", $cs_page_builder_template_readymade);
			// adding tempalte ready made end
			// adding general settings start
			update_option("cs_gs_color_style", '<?xml version="1.0"?><cs_gs_color_style><cs_style_sheet></cs_style_sheet><cs_color_scheme></cs_color_scheme><cs_bg></cs_bg><cs_bg_position>center</cs_bg_position><cs_bg_repeat>no-repeat</cs_bg_repeat><cs_bg_attach>scroll</cs_bg_attach><cs_bg_pattern></cs_bg_pattern><custome_pattern></custome_pattern><cs_bg_color>#e7e7e7</cs_bg_color></cs_gs_color_style>');
			update_option("cs_gs_logo", '<?xml version="1.0"?><cs_gs_logo><cs_logo>' . get_template_directory_uri() . '/images/logo.png</cs_logo><cs_width>238</cs_width><cs_height>69</cs_height></cs_gs_logo>');
			update_option("cs_gs_header_script", '<?xml version="1.0"?><cs_gs_header_script><cs_fav_icon>' . get_template_directory_uri() . '/images/favicon.ico</cs_fav_icon><cs_header_code/><header_phone>Call us : 0044123456789</header_phone></cs_gs_header_script>');
			update_option("cs_gs_footer_settings", '<?xml version="1.0"?><cs_gs_footer_settings><cs_copyright>Copyright ' . get_option("blogname") . " " . gmdate("Y") . '</cs_copyright><cs_powered_by></cs_powered_by><cs_powered_icon></cs_powered_icon><cs_analytics></cs_analytics></cs_gs_footer_settings>');
			update_option("cs_home_page_slider", '<?xml version="1.0"?><cs_home_page_slider><show_slider>on</show_slider><slider_type>Nivo Slider</slider_type><slider_id>slider</slider_id></cs_home_page_slider>');
			update_option("cs_home_page_announcement", '<?xml version="1.0"?><cs_home_page_announcement><show_announcement>on</show_announcement><announcement_title>Announcement</announcement_title><announcement_cat>4</announcement_cat></cs_home_page_announcement>');
			update_option("cs_font_settings", array('h1_size' => '24', 'h2_size' => '20', 'h3_size' => '18', 'h4_size' => '16', 'h5_size' => '14', 'h6_size' => '12', 'content_size' => '11', 'h1_g_font' => '', 'h2_g_font' => '', 'h3_g_font' => '', 'h4_g_font' => '', 'h5_g_font' => '', 'h6_g_font' => '', 'content_size_g_font' => ''));
			update_option("cs_sidebar", 'Sidebar<name>Blog<name>Courses<name>Courses Both sidebar<name>Courses Both sidebar 1<name>Gallery<name>Contact us<name>');
			update_option("cs_sliders_setttings", '<?xml version="1.0"?><sliders_setttings><anything><effect>Fade</effect><auto_play>true</auto_play><animation_speed>500</animation_speed><pause_time>3000</pause_time></anything><nivo><effect>random</effect><auto_play>true</auto_play><animation_speed>500</animation_speed><pause_time>3000</pause_time></nivo><sudo><effect>Fade</effect><auto_play>true</auto_play><animation_speed>500</animation_speed><pause_time>3000</pause_time></sudo></sliders_setttings>');
			update_option("cs_social_network", '<?xml version="1.0"?><social_network><twitter>YOUR_PROFILE_LINK</twitter><facebook>YOUR_PROFILE_LINK</facebook><linkedin>YOUR_PROFILE_LINK</linkedin><digg></digg><delicious></delicious><google_plus>YOUR_PROFILE_LINK</google_plus><google_buzz></google_buzz><google_bookmark></google_bookmark><myspace></myspace><reddit></reddit><stumbleupon></stumbleupon><youtube></youtube><feedburner></feedburner><flickr></flickr><picasa></picasa><vimeo></vimeo><tumblr></tumblr></social_network>');
			update_option("cs_social_share", '<?xml version="1.0"?><social_sharing><twitter>on</twitter><facebook>on</facebook><linkedin>on</linkedin><digg/><delicious/><google_plus>on</google_plus><google_buzz/><google_bookmark/><myspace/><reddit/><stumbleupon/><rss/></social_sharing>');
			// adding translation start
			update_option("cs_trans_events", '<?xml version="1.0"?><trans_events><event_trans_list_view>List View</event_trans_list_view><event_trans_calendar_view>Calendar View</event_trans_calendar_view><event_trans_booking_url>Booking URL</event_trans_booking_url><event_trans_all_day>All Day</event_trans_all_day><event_location>Event Location</event_location></trans_events>');
			update_option("cs_trans_courses", '<?xml version="1.0"?><trans_courses><course_name>Course Name</course_name><course_programs>Programs</course_programs><course_eligibility>Eligibility</course_eligibility><course_plan>Course Plan</course_plan><subject_title>Subject Title</subject_title><course_instructor>Instructor</course_instructor><credit_hours>Credit Hours</credit_hours><course_apply>Apply Now</course_apply></trans_courses>');
			update_option("cs_trans_contact", '<?xml version="1.0"?><trans_contact><form_title>Quick Inquiry</form_title><contact_no>Contact No</contact_no><message>Message</message><captcha>Enter Captcha</captcha><refresh_captcha>Refresh Captcha</refresh_captcha><name_error>Name field is invalid or empty</name_error><email_error>Email field is invalid or empty</email_error><contact_no_error>Contact no. field is invalid or empty</contact_no_error><message_error>Message field is invalid or empty</message_error><captcha_error>Captcha field is invalid or empty</captcha_error></trans_contact>');
			update_option("cs_trans_others", '<?xml version="1.0"?><trans_others><title_404>Page Not Found</title_404><content_404>It seems we can&#x2019;t find what you&#x2019;re looking for.</content_404><share_this_post>Share This Post</share_this_post><follow_us>Follow Us</follow_us><follow_us_on>Follow Us on</follow_us_on><need_an_account>Need an Account?</need_an_account><newsletter>Newsletter</newsletter><newsletter_thanks>Thanks for subscribing</newsletter_thanks><featured_post>Featured</featured_post><category_filter>Category Filter</category_filter><trans_days>Days</trans_days><trans_hours>Hours</trans_hours><trans_minutes>Minutes</trans_minutes><trans_seconds>Seconds</trans_seconds></trans_others>');
			// adding translation end
			update_option("cs_default_pages", '<?xml version="1.0"?><cs_default_pages><cs_pagination>Show Pagination</cs_pagination><record_per_page>5</record_per_page><cs_layout>right</cs_layout><cs_sidebar_right>Sidebar</cs_sidebar_right></cs_default_pages>');
			update_option("cs_gs_others", '<?xml version="1.0"?><cs_gs_others><responsive>on</responsive><breadcrumb>on</breadcrumb><theme_rtl/><color_picker/><translation_switcher/></cs_gs_others>');
			$theme = wp_get_theme();
			update_option("cs_theme_version", $theme['Version']);

			update_option("cs_theme_name", $theme['Name']);
		}
        // adding general settings end
    }

}
// installing tables on theme activating end
// custom sidebar start
$counter = 0;
$parts = explode("<name>", get_option("cs_sidebar"));
foreach ($parts as $val) {
    if ($val <> "") {
        $counter++;
        register_sidebar(array(
            'name' => $val,
            'id' => $val,
            'description' => 'This widget will be displayed on right side of the page.',
            'before_widget' => '<div class="widget box %2$s">',
            'after_widget' => '</div><div class="clear"></div>',
            'before_title' => '<h2 class="heading">',
            'after_title' => '</h2>'
        ));
    }
}
// custom sidebar end
//Home Page Sidebar
register_sidebar(array(
    'name' => __('Home Page Left', CSDOMAIN),
    'id' => 'left-sidebar',
    'description' => 'This Widget Show the Content of Home Sidebar.',
    'before_widget' => '<div class="widget box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="heading">',
    'after_title' => '</h3>'
));
//Home Page Sidebar
register_sidebar(array(
    'name' => __('Home Page Center', CSDOMAIN),
    'id' => 'center-sidebar',
    'description' => 'This Widget Show the Content of Home Sidebar.',
    'before_widget' => '<div class="box cent-col %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="heading">',
    'after_title' => '</h3>'
));
//Home Page Sidebar
register_sidebar(array(
    'name' => __('Home Page Right', CSDOMAIN),
    'id' => 'right-sidebar',
    'description' => 'This Widget Show the Content of Home Sidebar.',
    'before_widget' => '<div class="widget box left %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="heading">',
    'after_title' => '</h2>'
));

//footer widget Sidebar
register_sidebar(array(
    'name' => __('Footer Widget', CSDOMAIN),
    'id' => 'footer-sidebar',
    'description' => 'This Widget Area placed under the slider for small banner area.',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="white">',
    'after_title' => '</h4>'
));
if (!function_exists('cs_admin_scripts_enqueue')) :

    function cs_admin_scripts_enqueue() {
        $template_path = get_template_directory_uri() . '/scripts/admin/media_upload.js';
        wp_enqueue_script('my-upload', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider'));
        wp_enqueue_script('custom_wp_admin_script', get_template_directory_uri() . '/scripts/admin/cs_functions.js');
        wp_enqueue_style('custom_wp_admin_style', get_template_directory_uri() . '/css/admin/style-page.css', array('thickbox'));
    }

endif;
if (!function_exists('cs_front_scripts_enqueue')) :

    function cs_front_scripts_enqueue() {
        if (!is_admin()) {
            global $cs_responsive, $theme_rtl;
            wp_enqueue_script('jquery');
            wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/scripts/frontend/bootstrap.min.js');
            wp_enqueue_script('functions_js', get_template_directory_uri() . '/scripts/frontend/functions.js');
            wp_enqueue_script('contentslider_js', get_template_directory_uri() . '/scripts/frontend/contentslider.js');
            wp_enqueue_script('jquery.easing.1.3_js', get_template_directory_uri() . '/scripts/frontend/jquery.easing.1.3.js');

            wp_enqueue_style('style_css', get_stylesheet_uri());
            wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css');
            wp_enqueue_style('base_css', get_template_directory_uri() . '/css/base.css');
            wp_enqueue_style('layout_css', get_template_directory_uri() . '/css/layout.css');
            wp_enqueue_style( 'custom_css', get_template_directory_uri() . '/css/custom.css',false,'1.1','all');

            if ($theme_rtl == "on") {
                wp_enqueue_style('rtl_css', get_template_directory_uri() . '/css/rtl.css');
            }
            if ($cs_responsive == 'on') {
                wp_enqueue_style('skeleton_css', get_template_directory_uri() . '/css/skeleton.css');
            }
        }
    }

endif;
// Enqueue Slider files
if (!function_exists('slider_enqueue_style_scripts')) :

    function slider_enqueue_style_scripts($format) {

        if ($format == 'Nivo Slider')
            wp_enqueue_script('nivo.slider_js', get_template_directory_uri() . '/scripts/frontend/jquery.nivo.slider.js', '', '', TRUE);
        else if ($format == 'Sudo Slider')
            wp_enqueue_script('sudoslider.min_js', get_template_directory_uri() . '/scripts/frontend/jquery.sudoslider.min.js', '', '', TRUE);
        else {
            wp_enqueue_script('anythingslider_js', get_template_directory_uri() . '/scripts/frontend/jquery.anythingslider.js', '', '', TRUE);
            wp_enqueue_script('anythingslider.fx_js', get_template_directory_uri() . '/scripts/frontend/jquery.anythingslider.fx.js', '', '', TRUE);
            wp_enqueue_script('anythingslider.video_js', get_template_directory_uri() . '/scripts/frontend/jquery.anythingslider.video.js', '', '', TRUE);
        }
    }

endif;
// Enqueue Slider files
if (!function_exists('lightbox_enqueue_style_scripts')) :

    function lightbox_enqueue_style_scripts() {
        wp_enqueue_style('prettyPhoto_css', get_template_directory_uri() . '/css/prettyPhoto.css');
        wp_enqueue_style('fancybox_css', get_template_directory_uri() . '/css/fancybox.css');
        wp_enqueue_script('lightbox_js', get_template_directory_uri() . '/scripts/frontend/lightbox.js');
        wp_enqueue_script('jquery.prettyPhoto_js', get_template_directory_uri() . '/scripts/frontend/jquery.prettyPhoto.js');
    }

endif;
// Enqueue contact files
if (!function_exists('contact_enqueue_scripts')) :

    function contact_enqueue_scripts() {
        wp_enqueue_script('validate.metadata_js', get_template_directory_uri() . '/scripts/admin/jquery.validate.metadata.js', '', '', true);
        wp_enqueue_script('validate_js', get_template_directory_uri() . '/scripts/admin/jquery.validate.js', '', '', true);
    }

endif;
// Enqueue events files
if (!function_exists('event_enqueue_styles_scripts')) :

    function event_enqueue_styles_scripts() {
        wp_enqueue_style('fullcalendar_css', get_template_directory_uri() . '/css/fullcalendar.css');
        wp_enqueue_script('fullcalendar.min_js', get_template_directory_uri() . '/scripts/frontend/fullcalendar.min.js', '', '', true);
    }

endif;

// Enqueue Countdown files
if (!function_exists('event_countdown_enqueue_scripts')) :

    function event_countdown_enqueue_scripts() {
        wp_enqueue_script('jquery.countdown_js', get_template_directory_uri() . '/scripts/frontend/jquery.countdown.js', '', '', true);
    }

endif;

// Enqueue color picker files
if (!function_exists('color_piker_enqueue_styles_scripts')) :

    function color_piker_enqueue_styles_scripts() {
        wp_enqueue_style('farbtastic_css', get_template_directory_uri() . '/color_picker/farbtastic.css');
        wp_enqueue_script('farbtastic_js', get_template_directory_uri() . '/color_picker/farbtastic.js', '', '', true);
    }

endif;
// Enqueue Tabs files
if (!function_exists('cs_tabs_enqueue_scripts')) :

    function cs_tabs_enqueue_scripts() {
        wp_enqueue_script('tabs_js', get_template_directory_uri() . '/scripts/frontend/tabs.js', '', '', true);
    }

endif;
$inc_path = (TEMPLATEPATH . '/include/');
require_once ($inc_path . 'default_pages_manage.php');
require_once ($inc_path . 'album.php');
require_once ($inc_path . 'event.php');
require_once ($inc_path . 'newsletter_manage.php');
require_once ($inc_path . 'home_page_settings.php');
require_once ($inc_path . 'general_options.php');
require_once ($inc_path . 'social_network.php');
require_once ($inc_path . 'manage_languages.php');
require_once ($inc_path . 'translation.php');
require_once ($inc_path . 'manage_sidebars.php');
require_once ($inc_path . 'fonts.php');
require_once ($inc_path . 'cs_meta_box.php');
require_once ($inc_path . 'cs_meta_post.php');
require_once ($inc_path . 'slider.php');
require_once ($inc_path . 'slider_setting.php');
require_once ($inc_path . 'gallery.php');
require_once ($inc_path . 'short_code.php');
require_once ($inc_path . 'twitter_settings.php');

if (!function_exists('my_new_theme')) :

    function my_new_theme() {

        add_theme_page('Chimp Theme Option', 'Chimp Theme Option', 'manage_options', basename(__FILE__), 'general_options', get_template_directory_uri() . "/images/admin/cs-icon.png");
        add_theme_page('', '', 'read', 'general_options', 'general_options');
        add_theme_page('', '', 'read', 'home_page_settings', 'home_page_settings');
        add_theme_page('', '', 'read', 'fonts', 'fonts');
        add_theme_page('', '', 'read', 'manage_sidebars', 'manage_sidebars');
        add_theme_page('', '', 'read', 'slider_setting', 'slider_setting');
        add_theme_page('', '', 'read', 'social_network', 'social_network');
        add_theme_page('', '', 'read', 'manage_languages', 'manage_languages');
        add_theme_page('', '', 'read', 'translation', 'translation');
        add_theme_page('', '', 'read', 'default_pages_manage', 'default_pages_manage');
        add_theme_page('', '', 'read', 'newsletter_manage', 'newsletter_manage');
        add_theme_page('', '', 'read', 'twitter_settings', 'twitter_settings');
    }

endif;
// Add default posts and comments RSS feed links to head
// Make theme available for translation
// Translations can be filed in the /languages/ directory
//	$locale = get_locale();
//	$locale_file = get_template_directory() . "/languages/$locale.php";
//	if ( is_readable( $locale_file ) )
//		require_once( $locale_file );

if (!function_exists('register_my_menus')) :

    function register_my_menus() {
        register_nav_menus(
                array(
                    'top-menu' => __('Top Menu', CSDOMAIN),
                    'main-menu' => __('Main Menu', CSDOMAIN),
                )
        );
    }

endif;
add_action('init', 'register_my_menus');

$inc_path = (TEMPLATEPATH . '/include/widgets/');
require_once ($inc_path . 'cs_archive_widgets.php');
require_once ($inc_path . 'cs_gallery_widget.php');
require_once ($inc_path . 'cs_twitter_widget.php');
require_once ($inc_path . 'cs_recent_post_widget.php');
require_once ($inc_path . 'cs_facebook_widget.php');
require_once ($inc_path . 'cs_newsletter_widget.php');
require_once ($inc_path . 'cs_contact_us_widget.php');
require_once ($inc_path . 'cs_message_box.php');
require_once ($inc_path . 'cs_campus_comm_box.php');
require_once ($inc_path . 'cs_event_countdown_widget.php');
require_once ($inc_path . 'cs_tabs_widget.php');
require_once ($inc_path . 'cs_search_widget.php');
require_once ($inc_path . 'cs_social_sharing.php');
if (!class_exists('New_Wolker_Menu')) :

    class New_Wolker_Menu extends Walker_Nav_Menu {

        function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
            $GLOBALS['menu_children'] = ( isset($children_elements[$element->ID]) ) ? 1 : 0;
            parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }

    }

    endif;
if (!function_exists('add_parent_css')) :

    function add_parent_css($classes, $item) {
        global $menu_children;
        if ($menu_children)
            $classes[] = 'parent';
        return $classes;
    }

endif;
// adding custom images while uploading media start
add_image_size('cs_media_1', 1000, 406, true);
add_image_size('cs_media_2', 990, 200, true);
add_image_size('cs_media_3', 690, 270, true);
add_image_size('cs_media_4', 468, 288, true);
add_image_size('cs_media_5', 299, 175, true);
add_image_size('cs_media_6', 68, 68, true);
// adding custom images while uploading media end

if (!function_exists('PixFill_comment')) :

    /**
     * Template for comments and pingbacks.
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function PixFill_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case '' :
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div class="com-in" id="comment-<?php comment_ID(); ?>">

                        <div class="thumb">
                            <?php echo '<a>' . get_avatar($comment, 40) . '</a>'; ?>
                        </div>
                        <div class="desc">
                            <div class="desc-in-border">
                                <div class="desc-in">
                                    <div class="title">
                                        <h5><?php printf(__('%s', 'PixFill'), sprintf('<a class="colr">%s</a>', get_comment_author_link())); ?></h5>
                                        <p>
                                            <?php
                                            /* translators: 1: date, 2: time */
                                            printf(__('%1$s at %2$s', 'PixFill'), get_comment_date(), get_comment_time());
                                            ?>
                                            <?php edit_comment_link(__('(Edit)', CSDOMAIN), ' '); ?>
                                        </p>
                                    </div>
                                    <?php if ($comment->comment_approved == '0') : ?>
                                        <div class="comment-awaiting-moderation backcolr"><?php _e('Your comment is awaiting moderation.', CSDOMAIN); ?></div>
                                        <div class="clear"></div>
                                    <?php endif; ?>
                                    <?php comment_text(); ?>
                                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
                break;
            case 'pingback' :
            case 'trackback' :
                ?>
                <li class="post pingback">
                    <p><?php _e('Pingback:', 'PixFill'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('(Edit)', 'PixFill'), ' '); ?></p>
                </li>
                <?php
                break;
        endswitch;
        ?>
        <?php
    }

endif;

if (!function_exists('posted_in')) :

    /**
     * Prints HTML with meta information for the current post (category, tags and permalink).
     *
     * @since Twenty Ten 1.0
     */
    function posted_in() {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list('', ', ');
        if ($tag_list) {
            $posted_in = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', CSDOMAIN);
        } elseif (is_object_in_taxonomy(get_post_type(), 'category')) {
            $posted_in = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', CSDOMAIN);
        } else {
            $posted_in = __('Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', CSDOMAIN);
        }
        // Prints the string, replacing the placeholders.
        printf(
                $posted_in, get_the_category_list(', '), $tag_list, get_permalink(), the_title_attribute('echo=0')
        );
    }

endif;
// Shortcode Dropdown
add_action('media_buttons', 'cs_shortcode_dropdown', 11);
if (!function_exists('cs_shortcode_dropdown')) {

    function cs_shortcode_dropdown() {
        $cs_shortcode_tags = array('accordion', 'button', 'column', 'dropcap', 'divider', 'frame', 'gallery', 'list', 'message_box', 'quote', 'toogle', 'tabs', 'table', 'video');
        $cs_shortcodes_list = '';
        echo '&nbsp;<select id="sc_select"><option>Shortcode</option>';
        foreach ($cs_shortcode_tags as $val) {
            $cs_shortcodes_list .= "<option value='" . $val . "'>" . $val . "</option>";
        }
        echo $cs_shortcodes_list;
        echo '</select>';
    }

}
add_action('admin_head', 'cs_button_js');
if (!function_exists('cs_button_js')) {

    function cs_button_js() {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                cs_shortocde_selection();
            });
        </script>
        <?php
    }

}

// If no content, include the "No posts found" function
if (!function_exists('fnc_no_result_found')) {

    function fnc_no_result_found($search = true) {
        echo '<div class="pagenone cls-noresult-found"><i class="fa fa-warning cs-colr"></i>';
        ?>
        <h5><?php _e('No results found.', 'videoeye'); ?></h5>
        <?php
        if ($search == true) {
            echo '<div class="password_protected">';
            if (is_home() && current_user_can('publish_posts')) :
                ?>
                <p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'videoeye'), admin_url('post-new.php')); ?></p>
            <?php elseif (is_search()) : ?>
                <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'videoeye'); ?></p>
                <?php get_search_form(); ?>
            <?php else : ?>
                <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'videoeye'); ?></p>
                <?php get_search_form(); ?>
            <?php endif; ?>
            </div>
        <?php } ?>
        </div>
        <?php
    }

}


if (current_user_can('administrator')) {

    // Addmin Menu CS Theme Option
    //require_once (TEMPLATEPATH . '/include/theme_option.php');
    add_action('admin_menu', 'cs_theme');
    if (!function_exists('cs_theme')) {

        function cs_theme() {

            add_theme_page("Import Demo Data", "Import Demo Data", 'read', 'cs_demo_importer', 'cs_demo_importer');
        }

    }
}

// import demo xml file
if (!function_exists('cs_demo_importer')) {

    function cs_demo_importer() {
        ?>
        <div class="cs-demo-data">
            <h2>Import Demo Data</h2>
            <div class="inn-text">
                <p>Importing demo data helps to build site like the demo site by all means. It is the quickest way to setup theme. Following things happen when dummy data is imported;</p>
                <ul class="import-data">
                    <li>&#8226; All wordpress settings will remain same and intact.</li>
                    <li>&#8226; Posts, pages and dummy images shown in demo will be imported.</li>
                    <li>&#8226; Only dummy images will be imported as all demo images have copy right restriction.</li>
                    <li>&#8226; No existing posts, pages, categories, custom post types or any other data will be deleted or modified.</li>
                    <li>&#8226; To proceed, please click "Import Demo Data" and wait for a while.</li>
                </ul>
            </div>
            <form method="post">
                <input name="reset"  type="submit" value="Import Demo Data" id="submit_btn" />
                <input type="hidden" name="demo" value="demo-data" />
            </form>
        </div>
        <?php
        if (isset($_REQUEST['demo']) && $_REQUEST['demo'] == 'demo-data') {

            require_once ABSPATH . 'wp-admin/includes/import.php';
            if (!defined('WP_LOAD_IMPORTERS'))
                define('WP_LOAD_IMPORTERS', true);
            $cs_demoimport_error = false;

            if (!class_exists('WP_Importer')) {
                $cs_import_class = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
                if (file_exists($cs_import_class)) {
                    require_once($cs_import_class);
                } else {
                    $cs_demoimport_error = true;
                }
            }

            if (!class_exists('WP_Import')) {
                $cs_import_class = get_template_directory() . '/include/importer/wordpress-importer.php';
                if (file_exists($cs_import_class))
                    require_once($cs_import_class);
                else
                    $cs_demoimport_error = true;
            }

            if ($cs_demoimport_error) {
                echo __('Error.', 'wordpress-importer') . '</p>';
                die();
            } else {
                if (!is_file(get_template_directory() . '/include/importer/demo.xml')) {
                    echo '<p><strong>' . __('Sorry, there has been an error.', 'wordpress-importer') . '</strong><br />';
                    echo __('The file does not exist, please try again.', 'wordpress-importer') . '</p>';
                } else {

                    global $wpdb;
                    $theme_mod_val = array();
                    $term_exists = term_exists('main-menu', 'nav_menu');
                    if (!$term_exists) {
                        $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "terms` VALUES ('', 'Main Menu' , 'main-menu', '0'); ");
                        $insert_id = $wpdb->insert_id;
                        $theme_mod_val['main-menu'] = $insert_id;
                        $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "term_taxonomy` VALUES ('', '" . $insert_id . "' , 'nav_menu', '', '0', '0'); ");
                    } else
                        $theme_mod_val['main-menu'] = $term_exists['term_id'];
                    $term_exists = term_exists('top-menu', 'nav_menu');
                    if (!$term_exists) {
                        $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "terms` VALUES ('', 'Top Menu' , 'top-menu', '0'); ");
                        $insert_id = $wpdb->insert_id;
                        $theme_mod_val['top-menu'] = $insert_id;
                        $wpdb->query(" INSERT INTO `" . $wpdb->prefix . "term_taxonomy` VALUES ('', '" . $insert_id . "' , 'nav_menu', '', '0', '0'); ");
                    } else
                        $theme_mod_val['top-menu'] = $term_exists['term_id'];

                    set_theme_mod('nav_menu_locations', $theme_mod_val);

                    $cs_demo_import = new WP_Import();
                    $cs_demo_import->fetch_attachments = true;
                    $cs_demo_import->import(get_template_directory() . '/include/importer/demo.xml');

                    // Menu Location

                    /* $cs_theme_option = get_option('cs_theme_option');
                      $cs_theme_option['show_appointment_form']='on';
                      $cs_theme_option['show_slider']='on';
                      $cs_theme_option['slider_type']='flex';
                      $cs_theme_option['slider_name']='banner';

                      update_option("cs_theme_option", $cs_theme_option ); */

                    /* update_option( 'cs_import_data', 'success' );
                      $home = get_page_by_title( 'Home' );
                      if($home <> '' && get_option( 'page_on_front' ) == "0"){
                      update_option( 'page_on_front', $home->ID );
                      update_option( 'show_on_front', 'page' );
                      update_option( 'front_page_settings', '1' );
                      } */
                }
            }
        }
    }

}
if (!function_exists('px_register_required_plugins')) {
    // tgm class for (internal and WordPress repository) plugin activation start
    require_once dirname(__FILE__) . '/include/class-tgm-plugin-activation.php';
    add_action('tgmpa_register', 'px_register_required_plugins');

    function px_register_required_plugins() {
        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(
            // This is an example of how to include a plugin from the WordPress Plugin Repository

            array(
                'name' => 'WPML Multilingual',
                'slug' => 'WPML Multilingual',
                'source' => get_template_directory_uri() . '/include/plugins/sitepress-multilingual-cms.zip',
                'required' => false,
                'version' => '',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
            ),
        );
        // Change this to your theme text domain, used for internationalising strings
        $theme_text_domain = 'Kings Club';
        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'domain' => 'kingdom', // Text domain - likely want to be the same as your theme.
            'default_path' => '', // Default absolute path to pre-packaged plugins
            'parent_menu_slug' => 'themes.php', // Default parent menu slug
            'parent_url_slug' => 'themes.php', // Default parent URL slug
            'menu' => 'install-required-plugins', // Menu slug
            'has_notices' => true, // Show admin notices or not
            'is_automatic' => true, // Automatically activate plugins after installation or not
            'message' => '', // Message to output right before the plugins table
            'strings' => array(
                'page_title' => __('Install Required Plugins', 'kingdom'),
                'menu_title' => __('Install Plugins', 'kingdom'),
                'installing' => __('Installing Plugin: %s', 'kingdom'), // %1$s = plugin name
                'oops' => __('Something went wrong with the plugin API.', 'kingdom'),
                'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)
                'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)
                'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)
                'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
                'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)
                'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)
                'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)
                'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins'),
                'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins'),
                'return' => __('Return to Required Plugins Installer', 'kingdom'),
                'plugin_activated' => __('Plugin activated successfully.', 'kingdom'),
                'complete' => __('All plugins installed and activated successfully. %s', 'kingdom'), // %1$s = dashboard link
                'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );
        tgmpa($plugins, $config);
    }

    // tgm class for (internal and WordPress repository) plugin activation end
}

/* adding custom images while uploading media start */

// Banner, Blog Large
add_image_size('px_media_1', 768, 403, true);
// Spot Light, Gallery
add_image_size('px_media_2', 470, 353, true);
// Popular Players
add_image_size('px_media_3', 390, 390, true);
// Blog Medium, News
add_image_size('px_media_4', 325, 244, true);

if (!function_exists('language_selector_flags')) {

    function language_selector_flags() {
//    $languages = icl_get_languages('skip_missing=0&orderby=code');
        if (!empty($languages)) {
            foreach ($languages as $l) {
                if (!$l['active'])
                    echo '<a href="' . $l['url'] . '">';
                echo '<img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" />';
                if (!$l['active'])
                    echo '</a>';
            }
        }
    }

}

// Shortcode content
if (!function_exists('cs_content_decode')) {

    function cs_content_decode($content = '') {

        $content = htmlspecialchars(stripslashes($content));
        $content = str_replace('&', '', $content);
        $content = str_replace(array('quot;', 'amp;#8221;', 'amp;#8243;', 'lt;', 'gt;', '[', ']'), array('"', '"', '"', '<', '>', '<', '>'), $content);

        return $content;
    }

}

// Front End Functions END

if (!function_exists('cs_allow_special_char')) {

    function cs_allow_special_char($input = '') {
        $output = $input;
        return $output;
    }

}

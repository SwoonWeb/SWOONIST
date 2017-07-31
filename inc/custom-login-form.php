<?php

/**
 * Custom Login Form Redirects & Alerts
 */
$page_id = ''; // optional use a page
$login_page = site_url(!empty($page_id) ? '/?page_id='. $page_id : '/?loginModal=true');
$restrict_admin_access = false;

/**
 * Redirect the wp-login.php to the custom login page (optional use if you never want to access wp-admin login)
 */
if($restrict_admin_access){
	function goto_login_page() {
		global $login_page;
		$page = basename($_SERVER['REQUEST_URI']);

		if( $page == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
			wp_redirect($login_page);
			exit;
		}
	}
	add_action('init','goto_login_page');

	/**
	 * On logout send to login page (optional use if you never want to access the wp-admin login)
	 */
	function atg_logout_page() {
		global $login_page;
		wp_redirect(strpos($login_page,'?') !== false ? $login_page .= '&login=logout' : $login_page .= '?login=logout');
		exit;
	}
	add_action('wp_logout', 'atg_logout_page');
}

/**
 * What to do if the login attempt failed
 */
function atg_login_failed() {
	global $login_page;
	wp_redirect(strpos($login_page,'?') !== false ? $login_page .= '&login=failed' : $login_page .= '?login=logout');
	exit;
}
add_action( 'wp_login_failed', 'atg_login_failed' );


/**
 * What to do if there is no username or password
 */
function atg_blank_username_password( $user, $username, $password ) {
	global $login_page;
	global $restrict_admin_access;

	if( $username == "" || $password == "" ):
		if($restrict_admin_access){
			wp_redirect(strpos($login_page,'?') !== false ? $login_page .= '&login=blank' : $login_page .= '?login=blank');
			exit;
		} else {
			// Make it possible to hit the wp-admin login
			$page = basename($_SERVER['REQUEST_URI']);
			$query = "wp-login.php";
			if( substr($page, 0, strlen($query)) !== $query ){
				wp_redirect(strpos($login_page,'?') !== false ? $login_page .= '&login=blank' : $login_page .= '?login=blank');
				exit;
			}
		}
	endif;
}
add_filter( 'authenticate', 'atg_blank_username_password', 1, 3);


/**
 * Add Login / Logout Link to Primary Menu
 */
function atg_loginout_menu_link( $items, $args ) {
	$showModal = true;
	if($args->theme_location == 'primary'):
		$menu_item = '<li class="nav-item" class="menu-item">';
			if(!is_user_logged_in()):
				if(!$showModal):
					// make link popup modal
					$menu_item .= '<a class="nav-link" href="'.wp_login_url(get_permalink()).'">Log in</a>';
				else:
					// user standard login link
					$menu_item .= '<a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Log in</a>';
				endif;
			else:
				$menu_item .= '<a class="nav-link" href="'.wp_logout_url(get_permalink()).'">Log out</a>';
			endif;
		$menu_item .= '</li>';

	  $items .= $menu_item;
	endif;
  return $items;
}
add_filter( 'wp_nav_menu_items','atg_loginout_menu_link', 10, 2 );


/**
 * Custom Login Form
 */
function atg_wp_login_form(){
  // Login Errors
	$status = $_GET['login'];
	if($status == 'failed'):
		echo '<div id="loginError" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>ERROR:</strong> Invalid username and/or password.</div>';
	elseif($status == 'blank'):
		echo '<div id="loginError" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>ERROR:</strong> Username and/or Password is empty.</div>';
	endif;
	// Login Form
	echo '<div id="loginform-wrapper" class="'.($status == 'failed' || $status == 'blank' ? 'login-error' : '').'">';
    wp_login_form();
  echo '</div>';
}

/**
 * CustomLogin Form Modal
 */
function atg_wp_login_form_modal(){
	if(!is_user_logged_in()): ?>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
      <button class="mfp-close" type="button" data-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h3>Login</h3>
            <?php atg_wp_login_form(); ?>
          </div>
        </div>
      </div>
    </div>
    <?php if($_GET['loginModal'] && ($_GET['login'] != 'logout')): ?>
	    <script type="text/javascript">
	      jQuery(window).load(function(){
	        jQuery('#loginModal').modal('show');
	      });
	    </script>
		<?php endif;
	endif;
}
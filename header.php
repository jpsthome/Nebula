<?php $debug_class = ( is_debug() ) ? 'debug' : ''; ?>
<!doctype html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="<?php echo $debug_class; ?> no-js ie ie6 lt-ie7 lte-ie7 lt-ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="<?php echo $debug_class; ?> no-js ie ie7 lte-ie7 lt-ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="<?php echo $debug_class; ?> no-js ie ie8 lte-ie8 lt-ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="<?php echo $debug_class; ?> no-js ie ie9 lte-ie9 lt-ie10"><![endif]-->
<!--[if IEMobile]><html <?php language_attributes(); ?> class="<?php echo $debug_class; ?> no-js ie iem7" dir="ltr"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class=" <?php echo $debug_class; ?> no-js"><!--<![endif]-->
	<?php /* manifest="<?php echo get_template_directory_uri(); ?>/includes/manifest.appcache" */ //To begin setting up ApplicationCache, move this attribute to the <html> tag. ?>
	<head>
		<?php do_action('nebula_head_open'); ?>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="referrer" content="always">
		<meta charset="<?php bloginfo('charset'); ?>" />

		<title><?php wp_title('-', true, 'right'); ?></title>

		<meta name="HandheldFriendly" content="True" />
		<meta name="MobileOptimized" content="320" />
		<meta name="mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/includes/manifest.json" /> <!-- Web App Manifest Icons/Settings -->
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />

		<?php //Stylesheets are loaded at the top of functions.php (so they can be registerred and enqueued). ?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<?php include_once('includes/metagraphics.php'); //All graphic components of metadata are declared in this file. ?>

		<!-- Open Graph Metadata -->
		<?php //Check that all Open Graph data is working: https://developers.facebook.com/tools/debug ?>
		<?php if ( !file_exists(WP_PLUGIN_DIR . '/wordpress-seo') || is_front_page() ) : ?>
			<?php if ( nebula_settings_conditional_text_bool('nebula_google_webmaster_tools_verification') ): ?>
				<meta name="google-site-verification" content="<?php echo nebula_settings_conditional_text('nebula_google_webmaster_tools_verification', ''); ?>" />
			<?php endif; ?>

			<meta property="og:type" content="business.business" />
			<meta property="og:locale" content="<?php echo str_replace('-', '_', get_bloginfo('language')); ?>" />
			<meta property="og:title" content="<?php the_title(); ?>" />
			<meta property="og:description" content="<?php echo nebula_the_excerpt('', 30, 1); ?>" />
			<?php if ( !file_exists(WP_PLUGIN_DIR . '/wordpress-seo') ) : ?>
				<meta property="og:url" content="<?php the_permalink(); ?>" />
			<?php endif; ?>
			<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />

			<link rel="canonical" href="<?php the_permalink(); ?>" />

			<meta name="description" content="<?php echo nebula_the_excerpt('', 100, 0); ?>" />
			<meta name="keywords" content="<?php echo nebula_settings_conditional_text('nebula_keywords', ''); ?>" /><!-- @TODO "Metadata" 1: Replace '' with comma-separated keywords. -->
			<meta name="news_keywords" content="<?php echo nebula_settings_conditional_text('nebula_news_keywords', ''); ?>" /><!-- @TODO "Metadata" 1: Replace '' with comma-separated news event keywords. --> <!-- @TODO "Nebula" 0: W3 Validator Invalid: "Keyword news_keywords is not registered." -->
			<meta name="author" content="<?php echo nebula_the_author(); ?>" />

			<meta property="business:contact_data:website" content="<?php echo home_url('/'); ?>" />
			<meta property="business:contact_data:email" content="<?php echo nebula_settings_conditional_text('nebula_contact_email', get_option('admin_email', $GLOBALS['admin_user']->user_email)); //@TODO "Metadata" 2: Verify admin email address. ?>" />
			<meta property="business:contact_data:phone_number" content="+<?php echo nebula_settings_conditional_text('nebula_phone_number', ''); //Ex: "1-315-478-6700" ?>" />
			<meta property="business:contact_data:fax_number" content="+<?php echo nebula_settings_conditional_text('nebula_fax_number', ''); //Ex: "1-315-478-6700" ?>" />
			<meta property="business:contact_data:street_address" content="<?php echo nebula_settings_conditional_text('nebula_street_address', ''); ?>" />
			<meta property="business:contact_data:locality" content="<?php echo nebula_settings_conditional_text('nebula_locality', ''); //City ?>" />
			<meta property="business:contact_data:region" content="<?php echo nebula_settings_conditional_text('nebula_region', ''); //State ?>" />
			<meta property="business:contact_data:postal_code" content="<?php echo nebula_settings_conditional_text('nebula_postal_code', ''); //Zip ?>" />
			<meta property="business:contact_data:country_name" content="<?php echo nebula_settings_conditional_text('nebula_country_name', 'USA'); //Country ?>" />
		<?php endif; ?>

		<?php //Business hours of operation. Times should be in the format "5:30 pm" or "17:30". Remove from Foreach loop to override Nebula Settings. ?>
		<?php foreach ( array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday') as $weekday ) : ?>
			<?php if ( get_option('nebula_business_hours_' . $weekday . '_enabled') && get_option('nebula_business_hours_' . $weekday . '_open') != '' && get_option('nebula_business_hours_' . $weekday . '_close') != '' ) : ?>
				<meta property="business:hours:day" content="<?php echo $weekday; ?>" />
				<meta property="business:hours:start" content="<?php echo get_option('nebula_business_hours_' . $weekday . '_open'); ?>" />
				<meta property="business:hours:end" content="<?php echo get_option('nebula_business_hours_' . $weekday . '_close'); ?>" />
			<?php endif; ?>
		<?php endforeach; ?>

		<!-- Facebook Metadata -->
		<?php $GLOBALS['social']['facebook_url'] = nebula_settings_conditional_text('nebula_facebook_url', ''); //@TODO "Social" 1: Enter the URL of the Facebook page here. ?>
		<?php $GLOBALS['social']['facebook_access_token'] = nebula_settings_conditional_text('nebula_facebook_access_token', ''); //@TODO "Social" 1: Enter Facebook Access Token. This only stored in PHP for reference. Do NOT share or store in browser-facing code. ?>
		<meta property="fb:app_id" content="<?php echo $GLOBALS['social']['facebook_app_id'] = nebula_settings_conditional_text('nebula_facebook_app_id', ''); //@TODO "Social" 1: Enter Facebook App ID. Instructions: http://smashballoon.com/custom-facebook-feed/access-token/ ?>" />
		<meta property="fb:page_id" content="<?php echo $GLOBALS['social']['facebook_page_id'] = nebula_settings_conditional_text('nebula_facebook_page_id', ''); //@TODO "Social" 1: Enter Facebook Page ID. ?>" />
		<meta property="fb:admins" content="<?php echo $GLOBALS['social']['facebook_admin_ids'] = nebula_settings_conditional_text('facebook_admin_ids', ''); //@TODO "Social" 1: Comma separated IDs of FB admins. Ex: "1234,2345,3456" ?>" />

		<!-- Twitter Metadata -->
		<?php //twitter:image is located in includes/metagraphics.php ?>
		<?php $GLOBALS['social']['twitter_url'] = nebula_settings_conditional_text('nebula_twitter_url', ''); //@TODO "Social" 1: Enter the URL of the Twitter page here. ?>
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:title" content="<?php the_title(); ?>" />
		<meta name="twitter:description" content="<?php echo nebula_the_excerpt('', 30, 1); ?>" />
		<meta name="twitter:site" content="" /> <!-- "@username" of website -->
		<meta name="twitter:creator" content="" /> <!-- "@username" of content creator -->

		<!-- Other Social Metadata -->
		<?php //@TODO "SEO" 3: Create/update information on Google Business! http://www.google.com/business/ ?>
		<?php $GLOBALS['social']['google_plus_url'] = nebula_settings_conditional_text('nebula_google_plus_url', ''); //@TODO "Social" 1: Enter the URL of the Google+ page here. ?>
		<?php $GLOBALS['social']['linkedin_url'] = nebula_settings_conditional_text('nebula_linkedin_url', ''); //@TODO "Social" 1: Enter the URL of the LinkedIn page here. ?>
		<?php $GLOBALS['social']['youtube_url'] = nebula_settings_conditional_text('nebula_youtube_url', ''); //@TODO "Social" 1: Enter the URL of the Youtube page here. ?>
		<?php $GLOBALS['social']['instagram_url'] = nebula_settings_conditional_text('nebula_instagram_url', ''); //@TODO "Social" 1: Enter the URL of the Instagram page here. ?>

		<!-- Local/Geolocation Metadata -->
		<meta name="geo.placename" content="<?php echo nebula_settings_conditional_text('nebula_locality', ''); ?>, <?php echo nebula_settings_conditional_text('nebula_region', ''); ?>" /> <!-- The city (and state if needed). Replace each respective '' with the appropriate value. -->
		<meta name="geo.position" content="<?php echo nebula_settings_conditional_text('nebula_latitude', ''); ?>;<?php echo nebula_settings_conditional_text('nebula_longitude', ''); ?>" /> <!-- Semi-colon separated latitude;longitude. Replace each respsective '' with the appropriate value. -->
		<meta name="geo.region" content="<?php echo bloginfo('language'); ?>" />
		<meta name="ICBM" content="<?php echo nebula_settings_conditional_text('nebula_latitude', ''); ?>, <?php echo nebula_settings_conditional_text('nebula_longitude', ''); ?>" /> <!-- Comma and space separated latitude;longitude. Replace each respsective '' with the appropriate value. -->
		<meta property="place:location:latitude" content="<?php echo nebula_settings_conditional_text('nebula_latitude', ''); ?>" />
		<meta property="place:location:longitude" content="<?php echo nebula_settings_conditional_text('nebula_longitude', ''); ?>" />

		<script>
			social = []; //Not localized with WP because needs to be able to be modified in header.php if desired.
			social['facebook_url'] = "<?php echo $GLOBALS['social']['facebook_url']; ?>";
			social['facebook_app_id'] = "<?php echo $GLOBALS['social']['facebook_app_id']; ?>";
			social['twitter_url'] = "<?php echo $GLOBALS['social']['twitter_url']; ?>";
			social['google_plus_url'] = "<?php echo $GLOBALS['social']['google_plus_url']; ?>";
			social['linkedin_url'] = "<?php echo $GLOBALS['social']['linkedin_url']; ?>";
			social['youtube_url'] = "<?php echo $GLOBALS['social']['youtube_url']; ?>";
			social['instagram_url'] = "<?php echo $GLOBALS['social']['instagram_url']; ?>";
		</script>

		<script> //Universal Analytics
			var analyticsScript = ( <?php echo ( is_debug() ) ? 1 : 0; ?> ? 'analytics_debug.js' : 'analytics.js' );

			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/' + analyticsScript,'ga');

			ga('create', '<?php echo $GLOBALS['ga']; ?>', 'auto'); <?php //Change Tracking ID in Nebula Settings or functions.php! ?>
			//ga('require', 'displayfeatures'); //Uncomment this to enable remarketing and advertising reporting features for this web property (AdWords)
			ga('send', 'pageview');
			<?php //@TODO "Analytics" 5: Admin > View Settings - Turn on Site Search Tracking and enter "s,rs" in the Query Parameter input field! ?>
		</script>

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="fullbodywrapper">
			<div id="fb-root"></div>

			<noscript>
				<?php //Certain security plugins and htaccess settings can prevent the query strings in this iframe src from working. If page info for "JavaScript Disabled" in GA is not right, that is a likely reason. ?>
				<iframe class="hidden" src="<?php echo get_template_directory_uri(); ?>/includes/no-js.php?h=<?php echo home_url('/'); ?>&amp;p=<?php echo nebula_url_components('all'); ?>&amp;t=<?php echo urlencode(get_the_title($post->ID)); ?>" width="0" height="0" style="display:none;position:absolute;"></iframe>
			</noscript>

			<?php do_action('nebula_body_open'); ?>

			<div id="mobilebarcon">
				<div class="row mobilenavcon">
					<div class="sixteen columns clearfix">
						<a class="mobilenavtrigger alignleft" href="#mobilenav" title="Navigation"><i class="fa fa-bars"></i></a>
						<nav id="mobilenav">
							<?php
								if ( has_nav_menu('mobile') ){
									wp_nav_menu(array('theme_location' => 'mobile', 'depth' => '9999'));
								} elseif ( has_nav_menu('primary') ){
									wp_nav_menu(array('theme_location' => 'header', 'depth' => '9999'));
								}
							?>
						</nav><!--/mobilenav-->

						<form id="mobileheadersearch" class="nebula-search-iconable search" method="get" action="<?php echo home_url('/'); ?>">
							<?php
								if ( $_GET['s'] ) {
									$current_search = $_GET['s'];
								} elseif ( $_GET['rs'] ) {
									$current_search = $_GET['rs'];
								}
								$header_search_placeholder = ( isset($current_search) ) ? $current_search : 'What are you looking for?' ;
							?>
							<input class="nebula-search open input search" type="search" name="s" placeholder="<?php echo $header_search_placeholder; ?>" autocomplete="off" x-webkit-speech />
						</form>
					</div><!--/columns-->
				</div><!--/row-->
			</div><!--/topbarcon-->

			<?php if ( has_nav_menu('secondary') ) : ?>
				<div id="secondarynavcon" class="container">
					<div class="row">
						<div class="sixteen columns">
							<nav id="secondarynav">
			        			<?php wp_nav_menu(array('theme_location' => 'secondary', 'depth' => '2')); ?>
			        		</nav>
						</div><!--/columns-->
					</div><!--/row-->
				</div><!--/container-->
			<?php endif; ?>

			<div id="logonavcon" class="container">
				<div class="row">
					<div class="six columns">
						<?php
							//@TODO "Graphics" 4: Logo should have at least two versions: logo.svg and logo.png - Save them out in the images directory then update the paths below.
							//Important: Do not delete the /phg/ directory from the server; we use our logo in the WP Admin (among other places)!
						?>
						<a class="logocon" href="<?php echo home_url(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/logo.png'" alt="<?php bloginfo('name'); ?>"/>
						</a>
					</div><!--/columns-->
					<div class="ten columns">
						<?php if ( has_nav_menu('primary') ) : ?>
							<nav id="primarynav" class="clearfix">
								<?php wp_nav_menu(array('theme_location' => 'primary', 'depth' => '2')); ?>
			        		</nav>
		        		<?php endif; ?>
		        	</div><!--/columns-->
				</div><!--/row-->
			</div><!--/container-->

			<?php if ( !is_search() && (array_key_exists('s', $_GET) || array_key_exists('rs', $_GET)) ) : ?>
				<div class="container headerdrawercon">
					<hr/>
					<div class="row">
						<div class="sixteen columns headerdrawer">
							<span>Your search returned only one result. You have been automatically redirected.</span>
							<a class="close" href="<?php the_permalink(); ?>"><i class="fa fa-times"></i></a>
							<?php echo get_search_form(); echo '<script>document.getElementById("s") && document.getElementById("s").focus();</script>' . PHP_EOL; ?>
						</div><!--/columns-->
					</div><!--/row-->
					<hr class="zero" />
				</div><!--/container-->
			<?php elseif ( (is_page('search') || is_page_template('tpl-search.php')) && array_key_exists('invalid', $_GET) ) : ?>
				<div class="container headerdrawercon">
					<hr/>
					<div class="row">
						<div class="sixteen columns headerdrawer invalid">
							<span>Your search was invalid. Please try again.</span>
							<a class="close" href="<?php the_permalink(); ?>"><i class="fa fa-times"></i></a>
							<?php echo get_search_form(); echo '<script>document.getElementById("s") && document.getElementById("s").focus();</script>' . PHP_EOL; ?>
						</div><!--/columns-->
					</div><!--/row-->
					<hr class="zero" />
				</div><!--/container-->
			<?php elseif ( is_404() || array_key_exists('s', $_GET) ) : ?>
				<div id="suggestedpage" class="container headerdrawercon">
					<hr/>
					<div class="row">
						<div class="sixteen columns headerdrawer">
							<h3>Did you mean?</h3>
							<p><a class="suggestion" href="#"></a></p>
							<a class="close" href="<?php the_permalink(); ?>"><i class="fa fa-times"></i></a>
						</div><!--/columns-->
					</div><!--/row-->
					<hr class="zero" />
				</div><!--/container-->
			<?php endif; ?>
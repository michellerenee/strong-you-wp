<?php
/*
Template Name: Contact
*/

global $virtue, $post; 
$map 				= get_post_meta( $post->ID, '_kad_contact_map', true ); 
$form_math 			= get_post_meta( $post->ID, '_kad_contact_form_math', true );
$contactformtitle 	= get_post_meta( $post->ID, '_kad_contact_form_title', true );
$form 				= get_post_meta( $post->ID, '_kad_contact_form', true );
	if ($form == 'yes') { ?>
		<script type="text/javascript">jQuery(document).ready(function ($) {$.extend($.validator.messages, {required: "<?php echo esc_attr(__('This field is required.', 'virtue-toolkit')); ?>",email: "<?php echo esc_attr(__('Please enter a valid email address.', 'virtue-toolkit')); ?>",});$("#contactForm").validate();});</script>
			<script type="text/javascript" src="<?php echo VIRTUE_TOOLKIT_URL ?>assets/jquery.validate.js"></script>
		<?php } 
			if ($map == 'yes') { 
    		 	$address 	= get_post_meta( $post->ID, '_kad_contact_address', true ); 
				$maptype 	= get_post_meta( $post->ID, '_kad_contact_maptype', true ); 
				$height 	= get_post_meta( $post->ID, '_kad_contact_mapheight', true );
				$mapzoom 	= get_post_meta( $post->ID, '_kad_contact_zoom', true );
				if(isset($virtue['google_map_api']) && !empty($virtue['google_map_api'])) {
		    		$gmap_api = $virtue['google_map_api'];
			    } else {
			    	$gmap_api = 'AIzaSyBt7JOCM4XQTEi9jzdqB8alFc1Vm_3mbfQ';
			    }
				if(!empty($height)) {
					$mapheight = $height;
				} else {
					$mapheight = 300;
				}
				if(!empty($mapzoom)) {
					$zoom = $mapzoom;
				} else {
					$zoom = 15;
				} ?>
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($gmap_api);?>"></script>
		    	<script type="text/javascript">
					jQuery(window).load(function() {
					jQuery('#map_address').gmap3({
						map: {
						    address:"<?php echo esc_js($address);?>",
							options: {
			              		zoom:<?php echo esc_js($zoom);?>,
								draggable: true,
								mapTypeControl: true,
								mapTypeId: google.maps.MapTypeId.<?php echo esc_attr($maptype);?>,
								scrollwheel: false,
								panControl: true,
								rotateControl: false,
								scaleControl: true,
								streetViewControl: true,
								zoomControl: true
							}
						},
						marker:{
			            values:[
			            		 {address: "<?php echo esc_js($address);?>",
						 	    data:"<div class='mapinfo'>'<?php echo esc_js($address);?>'</div>",
						 	},
			            ],
			            options:{
			              draggable: false,
			            },
						events:{
			              click: function(marker, event, context){
			                var map = jQuery(this).gmap3("get"),
			                  infowindow = jQuery(this).gmap3({get:{name:"infowindow"}});
			                if (infowindow){
			                  infowindow.open(map, marker);
			                  infowindow.setContent(context.data);
			                } else {
			                  jQuery(this).gmap3({
			                    infowindow:{
			                      anchor:marker, 
			                      options:{content: context.data}
			                    }
			                  });
			                }
			              },
			              closeclick: function(){
			                var infowindow = jQuery(this).gmap3({get:{name:"infowindow"}});
			                if (infowindow){
			                  infowindow.close();
			                }
						  }
						}
			          }
			        });
			      });
			</script>
		    <?php echo '<style type="text/css" media="screen">#map_address {height:'.esc_attr($mapheight).'px; margin-bottom:20px;}</style>';
    }
	if(isset($_POST['submitted'])) {
		if(isset($form_math) && $form_math == 'yes') {
			$math_answer = trim($_POST['kad_captcha']);
			if(md5($math_answer) != $_POST['hval']) {
				$kad_captchaError = __('Check your math.', 'virtue-toolkit');
				$hasError = true;
			}
		}
	if(trim($_POST['contactName']) === '') {
		$nameError = __('Please enter your name.', 'virtue-toolkit');
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = __('Please enter your email address.', 'virtue-toolkit');
		$hasError = true;
	} else if (!is_email($_POST['email'])) {
		$emailError = __('You entered an invalid email address.', 'virtue-toolkit');
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = __('Please enter a message.', 'virtue-toolkit');
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$name = wp_filter_kses( $name );
		$email = wp_filter_kses( $email );
		$comments = wp_filter_kses( $comments );

		if (isset($virtue['contact_email'])) {
			$emailTo = $virtue['contact_email'];
		} else {
			$emailTo = get_option('admin_email');
		}
		$sitename = get_bloginfo('name');
		$subject = '['.esc_html($sitename) . ' ' . __("Contact", "kadencetoolkit").'] '. __("From", "kadencetoolkit") . ' ' . esc_html($name);
		$body = __('Name', 'virtue-toolkit').": $name \n\n";
		$body .= __('Email', 'virtue-toolkit').": $email \n\n";
		$body .= __('Comments', 'virtue-toolkit').":\n $comments";
		$headers = 'Reply-To: ' . esc_html($name) . '<' . $email . '>' . "\r\n";

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>
  	<div id="pageheader" class="titleclass">
		<div class="container">
			<?php get_template_part('templates/page', 'header'); ?>
		</div><!--container-->
	</div><!--titleclass-->
	<?php if ($map == 'yes') { ?>
        <div id="mapheader" class="titleclass">
            <div class="container">
		        <div id="map_address">
	            </div>
	        </div><!--container-->
        </div><!--titleclass-->
  	<?php } ?>
	<div id="content" class="container">
   		<div class="row">
   		<?php if ($form == 'yes') { ?>
	  		<div id="main" class="main col-md-6" role="main"> 
	  	<?php } else { ?>
      		<div id="main" class="main col-md-12" role="main">
	      <?php } ?>
	      <?php get_template_part('templates/content', 'page'); ?>
	      </div>

      		<?php if ($form == 'yes') { ?>
      		<div class="contactformcase col-md-6">
      			<?php if (!empty($contactformtitle)) { 
      					echo '<h3>'. esc_html($contactformtitle).'</h3>';
      					} 
      					if(isset($emailSent) && $emailSent == true) { ?>
							<div class="thanks">
								<p><?php _e('Thanks, your email was sent successfully.', 'virtue-toolkit');?></p>
							</div>
						<?php } else {
							
							if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error"><?php _e('Sorry, an error occured.', 'virtue-toolkit');?><p>
							<?php } ?>

							<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
								<div class="contactform">
									<p>
										<label for="contactName"><b><?php _e('Name:', 'virtue-toolkit'); ?></b></label>
										<?php if(isset($nameError)) { ?>
											<span class="error"><?php echo esc_html($nameError);?></span>
										<?php } ?>
										<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo esc_attr($_POST['contactName']);?>" class="required requiredField full" />
									</p>

									<p>
										<label for="email"><b><?php _e('Email:', 'virtue-toolkit'); ?></b></label>
											<?php if(isset($emailError)) { ?>
												<span class="error"><?php echo esc_html($emailError);?></span>
											<?php } ?>
										<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo esc_attr($_POST['email']);?>" class="required requiredField email full" />
									</p>

									<p>
										<label for="commentsText"><b><?php _e('Message:', 'virtue-toolkit'); ?></b></label>
											<?php if(isset($commentError)) { ?>
												<span class="error"><?php echo esc_html($commentError);?></span>
											<?php } ?>
										<textarea name="comments" id="commentsText" rows="10" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo esc_textarea(stripslashes($_POST['comments'])); } else { echo esc_textarea($_POST['comments']); } } ?></textarea>
									</p>
									<?php if(isset($form_math) && $form_math == 'yes') {
										$one = rand(5, 50);
										$two = rand(1, 9);
										$result = md5($one + $two); ?>
										<p>
											<label for="kad_captcha"><b><?php echo $one.' + '.$two; ?> = </b></label>
											<input type="text" name="kad_captcha" id="kad_captcha" class="required requiredField kad_captcha kad-quarter" />
												<?php if(isset($kad_captchaError)) { ?>
													<label class="error"><?php echo esc_html($kad_captchaError);?></label>
												<?php } ?>
											<input type="hidden" name="hval" id="hval" value="<?php echo esc_attr($result);?>" />
										</p>
									<?php } ?>
									<p>
										<input type="submit" class="kad-btn kad-btn-primary" id="submit" value="<?php _e('Send Email', 'virtue-toolkit'); ?>"></input>
									</p>
								</div><!-- /.contactform-->
								<input type="hidden" name="submitted" id="submitted" value="true" />
							</form>
						<?php } ?>
      		</div><!--contactform-->
      		<?php } ?>
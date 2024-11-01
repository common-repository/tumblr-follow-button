<?php
/*
Plugin Name: Tumblr Follow Button
Plugin URI: n/a
Description: Adds a button which allows a user to follow your tumblr blog when clicked
Author: Joe Birch
Version: 1
Author URI: hitherejoe.tumblr.com
*/

add_action("plugins_loaded", "tumblrFollowButton_init");

function placeButton()
{
$options = get_option("widget_tumblrFollowButton");
	if($options['colour'] == 'light'){
		echo "<a href='http://www.tumblr.com/follow/" . $options['user'] . "' style='display:inline-block; text-indent:-9999px; width:81px; height:20px; background:url(http://platform.tumblr.com/v1/share_1.png) top left no-repeat transparent;'>Follow on Tumblr</a> - Follow " . $options['user'];
	
	}
	else if($options['colour'] == 'dark'){
		echo "<a href='http://www.tumblr.com/follow/" . $options['user'] . "' style='display:inline-block; text-indent:-9999px; width:81px; height:20px; background:url(http://platform.tumblr.com/v1/share_1T.png) top left no-repeat transparent;'>Follow on Tumblr</a> - Follow " . $options['user'];
	}
	
}


function widget_tumblrFollowButton($args) {
  extract($args);
  $options = get_option("widget_tumblrFollowButton");
	if (!is_array( $options ))
	{
	$options = array( 'colour' => 'Button Colour', 'user' => 'tumblr name' );
	}
	
  echo $before_widget;
  echo $before_title;
  echo $after_title;
  placeButton();
  echo $after_widget;

}

function tumblrFollowButton_init()
{
	register_sidebar_widget(__('Tumblr Follow Button'), 'widget_tumblrFollowButton');
	register_widget_control(   'Tumblr Follow Button', 'tumblrFollowButton_control', 300, 200 );
}

function tumblrFollowButton_control()
{
	$options = get_option("widget_tumblrFollowButton");
	if (!is_array( $options ))
	{
	$options = array( 'colour' => 'Button Colour', 'user' => 'tumblr name' );
	}

	if ($_POST['tumblrFollowButton-Submit'])
	{
		$options['colour'] = htmlspecialchars($_POST['tumblrFollowButton-WidgetColour']);
		$options['user'] = htmlspecialchars($_POST['tumblrFollowButton-WidgetUser']);
		update_option("widget_tumblrFollowButton", $options);
	}
?>

	<p>
		<label for="tumblrFollowButton-WidgetColour">Button Colour: </label> <br />		
		<input type="radio" id="tumblrFollowButton-WidgetColour" name="tumblrFollowButton-WidgetColour" value="light" <?php if ( $options['colour'] == 'light' ) echo 'checked="checked"'; ?> /> Light<br />
		<input type="radio" id="tumblrFollowButton-WidgetColour" name="tumblrFollowButton-WidgetColour" value="dark" <?php if ( $options['colour'] == 'dark' ) echo 'checked="checked"'; ?> /> Dark <br /> <br />
		<label for="tumblrFollowButton-WidgetUser">Tumblr Username ( <strong>yourusername</strong>.tumblr.com ) : </label>
		<input type="text" id="tumblrFollowButton-WidgetUser" name="tumblrFollowButton-WidgetUser" value="<?php echo $options['user'];?>" />
		<input type="hidden" id="tumblrFollowButton-Submit" name="tumblrFollowButton-Submit" value="1" />	
	</p>
<?php
}
?>
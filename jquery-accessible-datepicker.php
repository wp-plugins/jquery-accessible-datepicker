<?php
/*
Plugin Name: JQuery Accessible Datepicker
Plugin URI: http://wordpress.org/extend/plugins/jquery-accessible-datepicker/
Description: WAI-ARIA Enabled Datepicker Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 1.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/

add_action("plugins_loaded", "JQueryAccessibleDarepicker_init");
function JQueryAccessibleDarepicker_init() {
    register_sidebar_widget(__('JQuery Accessible Datepicker'), 'widget_JQueryAccessibleDarepicker');
    register_widget_control(   'JQuery Accessible Datepicker', 'JQueryAccessibleDarepicker_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_JQueryAccessibleDarepicker') ) {
        wp_register_style('jquery.ui.all', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-datepicker/lib/jquery-ui/themes/base/jquery.ui.all.css'));
        wp_enqueue_style('jquery.ui.all');

        wp_deregister_script('jquery');

        // add your own script
        wp_register_script('jquery-1.6.4', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-datepicker/lib/jquery-ui/jquery-1.6.4.js'));
        wp_enqueue_script('jquery-1.6.4');

        wp_register_script('jquery.ui.core', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-datepicker/lib/jquery-ui/ui/jquery.ui.core.js'));
        wp_enqueue_script('jquery.ui.core');

        wp_register_script('jquery.ui.widget', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-datepicker/lib/jquery-ui/ui/jquery.ui.widget.js'));
        wp_enqueue_script('jquery.ui.widget');

        wp_register_script('jquery.ui.datepicker', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-datepicker/lib/jquery-ui/ui/jquery.ui.datepicker.js'));
        wp_enqueue_script('jquery.ui.datepicker');

        wp_register_style('demos', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-datepicker/lib/jquery-ui/demos.css'));
        wp_enqueue_style('demos');

        wp_register_script('JQueryAccessibleDatepicker', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-datepicker/lib/JQueryAccessibleDatepicker.js'));
        wp_enqueue_script('JQueryAccessibleDatepicker');
    }
}
    
function widget_JQueryAccessibleDarepicker($args) {
    extract($args);

    $options = get_option("widget_JQueryAccessibleDarepicker");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'jQuery Accessible Datepicker',
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
    JQueryAccessibleDarepickerContent();
//    getDaysWithPosts();
    echo $after_widget;
}

function JQueryAccessibleDarepickerContent() {

  
    $options = get_option("widget_JQueryAccessibleDarepicker");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'JQuery Accessible Datepicker',
        );
    }
    $widgetTheme = $options['theme'];
    echo '<div class="demo">

<p>Date: <input type="text" id="datepicker"></p>

</div><!-- End demo -->';
}

function JQueryAccessibleDarepicker_control() {
    $options = get_option("widget_JQueryAccessibleDarepicker");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'JQuery Accessible Datepicker',
        );
    }

    if ($_POST['JQueryAccessibleDarepicker-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['JQueryAccessibleDarepicker-WidgetTitle']);
        update_option("widget_DojoAccessibleCalendar", $options);
    }
	
    ?>
    <p>
        <label for="JQueryAccessibleDatepicker-WidgetTitle">Widget Title: </label>
        <input type="text" id="JQueryAccessibleDatepicker-WidgetTitle" name="JQueryAccessibleDatepicker-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="JQueryAccessibleDatepicker-SubmitTitle" name="JQueryAccessibleDatepicker-SubmitTitle" value="1" />
    </p>
    <?php
}
?>

<?php
/*
Plugin Name: Ajax Load More: Custom Repeaters
Plugin URI: http://connekthq.com/ajax-load-more/custom-repeaters/
Description: Ajax Load More extension to allow for additional custom repeater templates.
Author: Darren Cooney
Twitter: @KaptonKaos
Author URI: http://connekthq.com
Version: 1.3
License: GPL
Copyright: Darren Cooney & Connekt Media
*/


define('ALM_REPEATER_PATH', plugin_dir_path(__FILE__));
define('ALM_REPEATER_URL', plugins_url('', __FILE__));
define('ALM_REPEATER_VERSION', '1.3');
define('ALM_REPEATER_RELEASE', 'August 17, 2014');

require 'plugin-updates/plugin-update-checker.php';
$ExampleUpdateChecker = PucFactory::buildUpdateChecker(
	'http://download.connekthq.com/alm-repeater.json',
	__FILE__
);

/*
*  alm_repeater_install
*  Install the extra repeaters and add them to the alm database table
*
*  @since 1.0
*/

register_activation_hook( __FILE__, 'alm_repeater_install' );
function alm_repeater_install() {   
   //if Ajax Load More is activated
   if(is_plugin_active('ajax-load-more/ajax-load-more.php')){	
   	global $wpdb;	
   	$table_name = $wpdb->prefix . "alm";	
   	   		
   	// Create rows for new repeater templates if they don't exist.   
   	// Updated 1.3 to count rows using count()
   	$rows = $wpdb->get_results("SELECT * FROM $table_name");
   	$num_results = count($rows);
   	if($num_results < 2) { // If row count is less than 2, create the rows in DB for Custom Repeaters
   	   $r=2;
         while($r<=6) {
            $repeater = 'repeater'.$r;
            $wpdb->insert($table_name , array('name' => $repeater, 'repeaterDefault' => '', 'pluginVersion' => ALM_REPEATER_VERSION));
            $r++;
         } 		
   	}	  	   	              
	}else{
   	die('You must install and activate Ajax Load More before installing the Custom Repeaters Add-on.');
	}	
}



if( !class_exists('ALMRepeater') ):
class ALMRepeater{	
	var $repeaters;
	function __construct(){			
		add_action('alm_custom_repeaters', array(&$this, 'alm_repeater_add_ons'));
		add_action('alm_get_custom_repeaters', array(&$this, 'alm_get_repeater_add_ons'));
		add_action('alm_repeater_installed', array(&$this, 'alm_is_repeater_installed'));		
		add_action( 'admin_init', array(&$this, 'alm_update_repeaters' ));
		
		//Load text domain
		load_plugin_textdomain( 'ajax-load-more-repeater', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
		
		$this->repeaters = array(
		    array(
		        'name' => __('Template #2'),
		        'file' => 'repeater2',
		    ),
		    array(
		        'name' => __('Template #3'),
		        'file' => 'repeater3',
		    ),
		    array(
		        'name' => __('Template #4'),
		        'file' => 'repeater4',
		    ),
		    array(
		        'name' => __('Template #5'),
		        'file' => 'repeater5',
		    ),
		    array(
		        'name' => __('Template #6'),
		        'file' => 'repeater6',
		    )
		);	
		define('ALM_REPEATER_LENGTH', count($this->repeaters));	
	}
		
		
	
   /**
   * alm_update_repeaters
   * Update repeaters if the databse version of the repeater doesn't match the current plugin version. Check by version numbers
   *
   * @since 1.0
   */
   
   function alm_update_repeaters() {  
   	 global $wpdb;
   	 $table_name = $wpdb->prefix . "alm";	
   	 $repeaters_row = $wpdb->get_var("SELECT pluginVersion FROM $table_name WHERE name = 'repeater6'");   
       $the_repeaters = $this->repeaters; 
       if($the_repeaters){
          // Loop repeaters
          foreach( $the_repeaters as $repeater ) {
   			$repeater = $repeater['file'];
            $version = $wpdb->get_var("SELECT pluginVersion FROM $table_name WHERE name = '$repeater'");	    
            //If version in DB is not the same as the repeater add-on version then update each file with DB values.    
            if($version != ALM_REPEATER_VERSION){
               //Write to repeater file
      		   $data = $wpdb->get_var("SELECT repeaterDefault FROM $table_name WHERE name = '$repeater'");
      			$f = ALM_REPEATER_PATH. '/repeaters/'.$repeater.'.php'; // File
      			$o = fopen($f, 'w+'); //Open file
      			$w = fwrite($o, $data); //Save the file
      			$r = fread($o, 100000); //Read it
      			fclose($o); //now close it
      	  }
         }
      }
   }	
		
	
	
	/*
	*  get_repeater_add_ons
	*  List our repeaters for selection on shortcode builder page
	*
	*  @since 1.0
	*/
	
	function alm_get_repeater_add_ons(){		
			//Repeater loop
			$repeaters = $this->repeaters; 
		   global $wpdb;
      	$table_name = $wpdb->prefix . "alm";
			foreach( $repeaters as $repeater ) {  
			   // Get repeater alias, if avaialble		
			   $repeater_file = $repeater['file'];
			   $repeater_name = $repeater['name'];
         	$repeater_alias = $wpdb->get_var("SELECT alias FROM $table_name WHERE name = '$repeater_file'");
         	if(empty($repeater_alias)){
         	   echo '<option name="'.$repeater_file.'" id="chk-'.$repeater_file.'" value="'.$repeater_file.'">'.$repeater_name.'</option>';
         	}else{				
         	   echo '<option name="'.$repeater_file.'" id="chk-'.$repeater_file.'" value="'.$repeater_file.'">'.$repeater_alias.'</option>';            	
         	}
			}
	}
	
	
	/*
	*  alm_get_repeater_list
	*  Get full list of repeaters
	*
	*  @since 1.0
	*/
	
	function alm_get_repeater_list(){
		$repeaters = $this->repeaters; 
		return $repeaters;
	}
	
	
	/*
	*  is_repeater_installed
	*  an empty function to determine if custom repeater is true.
	*
	*  @since 1.0
	*/
	
	function alm_is_repeater_installed(){
	   //Empty return
	}
	
	
	
	/*
	*  repeater_add_ons
	*  Our front end for the repeaters
	*
	*  @since 1.0
	*/
	
	function alm_repeater_add_ons(){	
		//Repeater loop
		global $wpdb;
      $table_name = $wpdb->prefix . "alm";
		$repeaters = $this->repeaters; 
		foreach( $repeaters as $repeater ) { 
   		$repeater_file = $repeater['file'];
   	   $repeater_name = $repeater['name'];
      	$repeater_alias = $wpdb->get_var("SELECT alias FROM $table_name WHERE name = '$repeater_file'");
      	
      	if(!empty($repeater_alias)){
         	$heading = $repeater_alias;
      	}else{
         	$heading = $repeater_name;
      	}		
		?>
		<div class="row">   		   
			<h3 class="heading" data-default="<?php echo $repeater_name; ?>"><?php echo $heading; ?></h3>
			<div class="expand-wrap">
				<div class="wrap repeater-wrap" data-name="<?php echo $repeater_file; ?>">
				   <div class="one_half">
   			      <label class="template-title" for="alias-<?php echo $repeater_file; ?>">
   			         <?php _e('Template Alias', ALM_NAME); ?>:
   			      </label>
   			      <?php   			         		         
      			      if(empty($repeater_alias)){
               	      echo '<input type="text" id="alias-'.$repeater_file.'" class="_alm_repeater_alias" value="'.$repeater_name.'" maxlength="55">';
                     }else{				
               	      echo '<input type="text" id="alias-'.$repeater_file.'" class="_alm_repeater_alias" value="'.$repeater_alias.'" maxlength="55">';            	
                     }
   			      ?>
				   </div>
				   <div class="one_half">
			         <label class="template-title" for="id-<?php echo $repeater_file; ?>">
			            <?php _e('Template ID', ALM_NAME); ?>:
                  </label>
                  <input type="text" class="disabled-input" id="id-<?php echo $repeater_file; ?>" value="<?php echo $repeater_file; ?>" disabled="disabled">
				   </div>
               				
               <label class="template-title" for="template-<?php echo $repeater_file; ?>">
                  <?php _e('Enter the HTML and PHP code for this template', ALM_NAME); ?>:
               </label>
   				<?php         
      				$filename = plugin_dir_path(__FILE__).'repeaters/'.$repeater_file.'.php';
      				$handle = fopen ($filename, "r");
      				$content = '';
      				if(filesize ($filename) != 0){
      				   $content = fread ($handle, filesize ($filename));		               
      				}
      				fclose ($handle);
   				?> 
   				<div class="textarea-wrap">
   					<textarea rows="10" id="template-<?php echo $repeater_file; ?>" class="_alm_repeater"><?php if($content) echo $content; ?></textarea>
   					<script>
                     var editor_<?php echo $repeater_file; ?> = CodeMirror.fromTextArea(document.getElementById("template-<?php echo $repeater_file; ?>"), {
                       mode:  "application/x-httpd-php",
                       lineNumbers: true,
                       lineWrapping: true,
                       indentUnit: 0,
                       matchBrackets: true,
                       viewportMargin: Infinity,
                       extraKeys: {"Ctrl-Space": "autocomplete"},
                     });
                   </script>
   				</div>
   				<input type="submit" value="<?php _e('Save Template', ALM_NAME); ?>" class="button button-primary save-repeater" data-editor-id="template-<?php echo $repeater_file; ?>">
   				<div class="saved-response">&nbsp;</div>
				</div> 					           
			</div>
			<div class="clear"></div>
		</div>	
		<?php } 	
		//End Repeater Loop 	
		?>
		<script>		
		   jQuery('._alm_repeater_alias').each(function(){
		      var el = jQuery(this),
		          heading = el.parent().parent().parent().parent().find('h3.heading');		      
   		   el.keyup(function(){
   		      var val = el.val(),
   		          defaultVal = heading.data('default');
   		      if(val === ''){
      		      heading.text(defaultVal);
   		      }else{
      		      heading.text(val);
   		      }
            });
		   });
   		
		</script>
		<?php
	 }	
}
	
	
	
/*
*  ALMRepeater
*  The main function responsible for returning Ajax Load More.
*
*  @since 1.0
*/	

function ALMRepeater(){
	global $alm_repeater;

	if( !isset($alm_repeater) )
	{
		$alm_repeater = new ALMRepeater();
	}

	return $alm_repeater;
}


// initialize
ALMRepeater();

endif; // class_exists check

<?php
function customAdmin() {
    //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_menu_page('Theme settings','BLIT-control', 'manage_options','tut_theme_settings', 'google_codes');
//add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function)
// $menu_slug must be the same for the menu page and the master submenu_page .. in our case =  tut_theme_settings'
add_submenu_page('tut_theme_settings','Google Codes', 'Google codes', 'manage_options', 'tut_theme_settings', 'google_codes'); 
}
  
function google_codes() {
	
	
	?>
    
      <div id="analatycs" >
  
  
  <h2>Google Analaytics Code</h2>
  <?php
  
  
  if (isset($_POST[add_code])){
	  
	  $update_code = mysql_query("UPDATE filters SET name='$_POST[code_name]',content='$_POST[the_code]' WHERE ID = 1 ");
	  	  
  }
  
   ?>
   
    <?php $get_google_analatics = mysql_query("SELECT * FROM filters WHERE ID = 1");
	
	$get_code = mysql_fetch_array($get_google_analatics); ?>
    
    <form action="" method="POST" >
    
    <p>
    <input type="text" name="code_name" value="<?php echo $get_code[name]; ?>" placeholder="Past code here" >
    <textarea name="the_code"  ><?php echo $get_code[content]; ?></textarea>
    <input type="submit" name="add_code" value="Add Code" >
    </p>
    
    </form>
    
    <h2>Google web master code</h2>
    
    <?php
  
  
  if (isset($_POST[add_code2])){
	  
	  $update_code = mysql_query("UPDATE filters SET name='$_POST[code_name]',content='$_POST[the_code]' WHERE ID = 2 ");
	  	  
  }
  
   ?>
    
    <?php $get_google_analatics = mysql_query("SELECT * FROM filters WHERE ID = 2");
	
	$get_code2 = mysql_fetch_array($get_google_analatics); ?>
    
    <form action="" method="POST" >
    
    <p>
    <input type="text" name="code_name" value="<?php echo $get_code2[name]; ?>" placeholder="Past code here" >
    <textarea name="the_code"  ><?php echo $get_code2[content]; ?></textarea>
    <input type="submit" name="add_code2" value="Add Code" >
    </p>
    
    </form>
  
  </div><!-- End of analatics -->
    <?php
	
}
add_action( 'admin_menu', 'customAdmin' );
//add_action('admin_head', 'customAdmin');
?>
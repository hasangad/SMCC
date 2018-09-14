<? function post_prp(){ ?>
<div id="post_prp" >
<?php // post properties
				$post_id = get_the_id();
				
				////////// SET the variable to integer ////////////////////////////////////
				//                                                                       //
				//        //settype($post_id ,"integer");                                //
			    //        //echo (int)$post_id;                                          //
				//                                                                       //
				///////////////////////////////////////////////////////////////////////////
				 $_GET[p] = $post_id ;
				
                function get_key($key){$get_prp = mysql_query("SELECT * FROM wp_postmeta WHERE post_id = '$_GET[p]' AND meta_key = '$key' ");
                
                $prp = mysql_fetch_array($get_prp);
                
                echo $prp[meta_value];
                
                if(isset($_POST[edit_prp])){
                    
                    update_post_meta( $_GET[p], '_owner', $_POST['owner']);
        update_post_meta( $_GET[p], '_price', $_POST['price']);
        update_post_meta( $_GET[p], '_quantity', $_POST['quantity']);
		update_post_meta( $_GET[p], '_phone', $_POST['phone']);
        update_post_meta( $_GET[p], '_mobile', $_POST['mobile']);
        update_post_meta( $_GET[p], '_email', $_POST['email']);
        update_post_meta( $_GET[p], '_address', $_POST['address']);
        update_post_meta( $_GET[p], '_duration', $_POST['duration']);
                }
                
                } ?>
                
                <h2>تواصل مع المعلن</h2>
                
                <?php if ( is_user_logged_in() && current_user_can('delete_others_pages') ) { ?>
                  
                  
                
                <form method="post" action="" enctype="multipart/form-data" >
                <p><label>المعلن</label><input type="text" name="owner" value="<?php get_key(_owner); ?>" /></p>
                <p><label>السعر</label><input type="text" name="price" value="<?php get_key(_price); ?>" /></p>
                <p><label>عدد</label><input type="text" name="quantity" value="<?php get_key(_quantity); ?>" /></p>
                <p><label>الهاتف</label><input type="text" name="phone" value="<?php get_key(_phone); ?>" /></p>
                <p><label>الموبايل</label><input type="text" name="mobile" value="<?php get_key(_mobile); ?>" /></p>
                <p><label>البريد الإلكتروني</label><input type="text" name="email" value="<?php get_key(_email); ?>" /></p>
                <p><label>العنوان</label><input type="text" name="address" value="<?php get_key(_address); ?>" /></p>
                <p><label>تاريخ الإعلان</label><input type="text" name="duration" value="<?php the_date( $format, 'في يوم ', ' م', true ); ?>" /></p>
                <input type="submit" name="edit_prp" value="تعديل" />
                </form>
                
                <?php }else{ ?>
                
                <form method="post" action="" enctype="multipart/form-data" >
                <p><label>المعلن</label><label class="green"><?php get_key(_owner); ?></label></p>
                <p><label>السعر</label><label class="green"><?php get_key(_price); ?></label></p>
                <p><label>عدد</label><label class="green"><?php get_key(_quantity); ?></label></p>
                <p><label>الهاتف</label><label class="green"><?php get_key(_phone); ?></label></p>
                <p><label>الموبايل</label><label class="green"><?php get_key(_mobile); ?></label></p>
                <p><label>البريد الإلكتروني</label><label class="green"><?php get_key(_email); ?></label></p>
                <p><label>العنوان</label><label class="green"><?php get_key(_address); ?></label></p>
                <p><label>تاريخ الإعلان</label><label class="green"><?php the_date( $format, 'في يوم ', ' م', true ); //the_date( $format, $before, $after, $echo );  ?></label></p>
                </form>
                
                
                
                <?php } ?>
                
                </div>
                
                                <?php } ?>

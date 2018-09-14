<?php
function main_func()
{
global $wpdb;
?>
	<div class="wrap">
		<form action="" method="post">
            <div class="wrap-style">
            	<?php
					//if($_POST['save'] == 'changes')
					if($_POST['save'])
					{
						update_option('_shipping',$_POST['_shipping']);
						update_option('_tax',$_POST['_tax']);
echo "<p class='success'>تم التحديث</p>";
					}
				?>
                
                <div class="block">
                    <h3>إدعدادات متجر جيوان وول</h3>
                    <div class="content">
                        <span>
                            <label> تكلفة الشحن </label>
                            <input type="text" value="<?= get_option('_shipping') ?>" name="_shipping">
                        </span>
                        
                         <span>
                            <label>الضريبة ( نسبة مئوية )</label>
                            <input type="text" value="<?= get_option('_tax') ?>" name="_tax">
                        </span>
                        
                    </div>
            	</div>
              
                
              <!--<input type="hidden" name="save" value="changes" />-->
              <input type="submit"  name="save" class="button button-primary button-large" value="حفظ التغيرات"  />
        </form>    
        </div>
        
        
    </div>
<?php	
}
?>
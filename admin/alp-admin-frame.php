<?php $options = get_option('alp_setting_field'); ?>
<div class="alp">
  <form class="alp-form" method="post" action="options.php">
    <?php settings_fields( 'alp-settings-group' ); ?>
    <?php do_settings_sections( 'alp-settings-group' ); ?>
    <div class="alp-main">
        <div class="alp-title">基本設定</div> 
        <div class="alp-basic-setting">
            <div class="alp-setting-option">
              <div class="alp-setting-left">           
                <label>狀態</label>
              </div>
              <div class="alp-setting-right">           
                <input name="alp_setting_field[status]" type="checkbox" value="1" <?php !empty($options[status]) ? $status = "checked" : "" ; echo $status; ?>>
                <span>啟用/關閉</span>
              </div>
            </div>
            <div class="alp-setting-option">
              <div class="alp-setting-left">           
                <label>分頁類型</label>
              </div>
              <div class="alp-setting-right">           
                <select name="alp_setting_field[pagination_type]">
                    <option <?php $options[pagination_type] == 'ajax_pagination' ? $pagination_type_ap = "selected" : "" ; echo $pagination_type_ap; ?> value="ajax_pagination">Ajax Pagination</option>
                    <option <?php $options[pagination_type] == 'infinite_scroll' ? $pagination_type_is = "selected" : "" ; echo $pagination_type_is; ?> value="infinite_scroll">Infinite Scroll</option>
                    <option <?php $options[pagination_type] == 'load_more_button' ? $pagination_type_lb = "selected" : "" ; echo $pagination_type_lb; ?> value="load_more_button">Load More Button</option>
                </select>
              </div>
            </div> 
            <div class="alp-setting-option">
              <div class="alp-setting-left">           
                <label>動畫</label>
              </div>
              <div class="alp-setting-right">           
                <select name="alp_setting_field[animation]" id="animation">
                    <option <?php selected($options[animation], 'none'); ?> value="none">None</option>
                    <?php
                        $animations = $this->parent->get_animation_style();
                        if(isset($animations)) {
                            foreach($animations as $animation_key => $animation) {
                                echo '<optgroup label="'.$animation_key.'">';
                                foreach($animation as $anim_key => $anim)
                                echo '<option '.selected($options[animation], $anim_key).' value="'.$anim_key.'">'.$anim.'</option>';
                                echo '</optgroup>';
                            }
                        }
                    ?>
                </select>
               <img id="animate-img" src="<?php echo $this->parent->plugin_dir_url; ?>inc/asset/image/placeholder.jpg" />
                <script>
                  jQuery('#animation').change(function() {
                    var animation = jQuery(this).val();
                    jQuery('#animate-img').attr('class', '');
                    jQuery('#animate-img').addClass('animated '+animation).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                      jQuery('#animate-img').attr('class', '');
                    });
                  });
                </script>  
              </div>
            </div> 
        </div>
    </div>
    <?php submit_button(); ?>
  </form>
</div>

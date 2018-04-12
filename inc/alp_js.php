<?php $options = get_option('alp_setting_field'); ?>
<?php if($options[status] == '1'){ ?>
<?php    if($options[pagination_type] == 'ajax_pagination'){ ?>
          <script>
          jQuery(function($) {
              $('body').on('click', '.woocommerce-pagination a', function(e) {
                event.preventDefault();
                var href = $.trim($(this).attr('href'));
                history.pushState(null, null, href);
                $('.woocommerce-pagination').before('<div class="load-img"><img src="http://35.193.143.136.xip.io/wp-content/uploads/2018/04/Spinner-1s-200px.gif" width="50"></div>');
                $.get(href, function(response) {
                    <?php
                    $content_selectors = 'ul.products'.','.'.woocommerce-pagination';
                    $content_selectors = explode(',', $content_selectors);
                    foreach($content_selectors as $content_selector) {
                      if(trim($content_selector) == '')
                        continue;
                    ?>
                      var html = $(response).find('<?php echo $content_selector; ?>').html();
                      $('<?php echo $content_selector; ?>').html(html);
                    <?php } ?>
                   $('.load-img').remove();
                   $('html, body').animate({scrollTop:0},500); 
                });
              });
          });
          </script>
    <?php } ?>
<?php    if($options[pagination_type] == 'load_more_button' || $options[pagination_type] == 'infinite_scroll'){ ?>
          <script>
          jQuery(function($) {
              if($('.woocommerce-pagination').length == '1'){
                  $('.woocommerce-pagination').before('<div class="alp-load-more"><a alp-processing="0"></a><button class="alp-load-more-button">Load more</button></div>');               
              }
              $('body').on('click', '.alp-load-more-button', function(e) {
                  e.preventDefault();
                  $('.alp-load-more a').attr('alp-processing', 1);
                  if($('.woocommerce-pagination').length){
                      var href = $('.woocommerce-pagination .next').attr('href');
                      $('.woocommerce-pagination').before('<div class="load-img"><img src="http://35.193.143.136.xip.io/wp-content/uploads/2018/04/Spinner-1s-200px.gif" width="50"></div>');
                      $('.alp-load-more-button').hide();
                      $('ul.products li.product').addClass('added-animation');
                      $.get(href, function(response) {
                         $('.woocommerce-pagination').html($(response).find('.woocommerce-pagination').html());
                         $(response).find('.products li.product').each(function() {
                            $('.products li.product:last').after($(this));
                         });
                        $('.alp-load-more a').attr('alp-processing', 0);
                        $('.load-img').remove();
                        $('.alp-load-more-button').show();
                        $('ul.products li.product').not('.added-animation').addClass('animated <?php echo $options[animation]; ?>').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                            $(this).removeClass('animated <?php echo $options[animation]; ?>').addClass('added-animation');
											  });
                        if($('.woocommerce-pagination a.next').length == '0'){
                          $('.alp-load-more a').attr('alp-processing', 1);
                          $('.alp-load-more-button').hide();
                          $('.woocommerce-pagination').before('<div class="alp-empty-msg">已經沒有商品了</div>');
                        } 
                      });
                  }
              });
            $('.woocommerce-pagination').addClass('alp-hide');
          });
          </script>          
    <?php } ?>
<?php    if($options[pagination_type] == 'infinite_scroll'){ ?>
          <script>
             jQuery(function($) {
                $(window).scroll(function(event){
                    if(jQuery('ul.products').length && jQuery('.woocommerce-pagination a.next').length == '1') {
                        var a = jQuery('ul.products').offset().top;
                        var c = jQuery(window).scrollTop() + 200;
                        var b = a - c;
                        if (c > a) {
                            if($('.alp-load-more a').attr('alp-processing') == 0) {
                              jQuery('.alp-load-more-button').trigger('click');
                            }  
                        }
                    }
                });
             });
          </script>          
    <?php } ?>
<?php } ?>
        <div class="clear"></div>
        
        </div><!--.container-->    
    
        <?php
            /* footer slider */
            global $ozy_data;
            ozy_put_footer_slider($ozy_data->footer_slider);

            /*footer widget bar and footer*/
            include('include/footer-bars.php');
        ?>
        
    </div><!--#main-->
    
  	<?php echo $ozyHelper->footer_html; ?>
    <?php wp_footer(); ?>

</body>
</html>
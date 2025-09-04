</div><!-- end content -->
</div><!--end wrap-->
<div class="logo"></div>
<footer role="contentinfo">
    <div class="footer_container">
 <div class="footer_logo">
        <img src="<?php echo img('GCHA_logoFinal.png', 'css')?>"></img>
    </div>
    <div class="footer_menu">
        <?php echo public_nav_main(); ?>
    </div>
    <div class="footer_sponsor">
        <div class="sshrc">
            <img src="<?php echo img('sshrc_color.svg') ?>"></img>
        </div>
        <div class="dhil">
            <a href="https://dhil.lib.sfu.ca">
             <img src="<?php echo img('DHIL.png') ?>"></img>
            </a>
           
        </div>
    </div>
    </div>
   

     <?php fire_plugin_hook('public_footer', array('view' => $this)); ?>
</footer>



<script type="text/javascript">
jQuery(document).ready(function () {
    Omeka.showAdvancedForm();
    Omeka.skipNav();
    Omeka.megaMenu("#top-nav");
    Seasons.mobileSelectNav();
});
</script>

</body>

</html>

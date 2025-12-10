</div><!-- end content -->
    <div class="logo"></div>
</div><!--end wrap-->
<footer role="contentinfo">
    <div class="footer_container">
 <div class="footer_logo">
        <img src="<?php echo img('GCHA_logoFinal.png')?>"></img>
    </div>
    <div class="footer_menu">
        <?php echo public_nav_main(); ?>
        <ul class="navigation">
            <li><a href="https://docs.dhil.lib.sfu.ca/privacy.html" target="_blank"><?php echo __('Privacy Policy'); ?></a></li>
        </ul>
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

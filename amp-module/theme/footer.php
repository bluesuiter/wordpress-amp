<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress AMP
 * @subpackage WordPress_AMP
 * @since WordPress AMP 1.0
 */
?>
</div><!-- #main .wrapper -->
<footer class="footer-wrapper">
    <div class="container">
        <P class="coppyright-text"><?php bloginfo('name') ?></p>
        <p class="coppyright-text">Copyright &copy; <?= date('Y') ?> All rights reserved</p>
    </div>
</footer>
</div><!-- #page -->
<?php _cfAmpFooter(); ?>
</body>
</html>

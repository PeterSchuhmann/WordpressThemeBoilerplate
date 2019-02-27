		</div> <!-- /.container -->
	</section>

	<footer>
		<div class="container">
			<nav id="footer-nav">
				<?php
					wp_nav_menu(array(
						'theme_location' => 'footer_menu',
						'menu_class' => 'footer-menu',
						'container' => false
					));
				?>
			</nav>
		</div>
	</footer>

    <div class="cookie-notice">
        <div class="cookie-notice-content">
            <p>
                Diese Seite verwendet Cookies, um Ihnen den bestmöglichen Service zu gewährleisten. Wenn Sie auf der Seite weitersurfen stimmen du der Cookie-Nutzung zu.
            </p>
            <a href="/datenschutz" title="Datenschutz">Weitere Informationen »</a>
            <a href="#" class="btn-accept">Ok passt</a>
        </div>
    </div>

	<?php wp_footer(); ?>
</body>
</html>
<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package wpcmedical
 */

get_header(); ?>

    <div id="primary" class="content-area">

        <main id="main" class="site-main" role="main">

            <div class="error-404 not-found">
                <div class="page-content">
                    <header class="page-header">
                        <p class="error-heading"><?php echo esc_html__( '404', 'wpcmedical' ); ?></p>
                        <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wpcmedical' ); ?></h1>
                    </header><!-- .page-header -->
                    <p><a href="<?php echo esc_url( home_url( '/' ) ) ?>" target="_self"
                          class="button btn-in-404-page"><?php esc_html_e( 'HOMEPAGE', 'wpcmedical' ) ?></a></p>
                </div><!-- .page-content -->
            </div><!-- .error-404 -->

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();

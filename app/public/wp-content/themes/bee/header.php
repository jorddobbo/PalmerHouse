<!doctype html>
<html lang="en">
    <head>

        <!-- Google Tag Manager
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TQNZRDT');</script>
        End Google Tag Manager -->
        
        <link href='https://api.mapbox.com/mapbox-gl-js/v0.38.0/mapbox-gl.css' rel='stylesheet' />

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://d1azc1qln24ryf.cloudfront.net/114779/Socicon/style-cf.css?u8vidh">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

      <header class="header">
        <div class="header__inner">
          <a class="header__logo" href="<?= esc_url(home_url('/')); ?>">
            <img class="header__logo-img" src="<?= get_template_directory_uri(); ?>/assets/img/header/logo.svg">
          </a>

          <div class="header__menu-toggle">
            <div class="header__menu-icon">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
          <div class="header__menu">
            <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'header__nav']);
            endif;
            ?>
          </div>
        </div>
        
      </header>
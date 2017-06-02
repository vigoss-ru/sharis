<?php
/**
 * @package   Eat
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>"  data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>

<head>
    <?php echo $this['template']->render('head'); ?>
    <input type="hidden" value="<?php echo ICL_LANGUAGE_CODE ?>" id="languageCode">
</head>

<body class="<?php echo $this['config']->get('body_classes'); ?>">

<?php if ($this['widgets']->count('toolbar-l + toolbar-r')) : ?>
    <div class="tm-toolbar uk-clearfix uk-hidden-small">

        <div class="uk-container uk-container-center">

            <?php if ($this['widgets']->count('toolbar-l')) : ?>
                <div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('toolbar-r')) : ?>
                <div class="uk-float-right"><?php echo $this['widgets']->render('toolbar-r'); ?></div>
            <?php endif; ?>

        </div>

    </div>
<?php endif; ?>

<?php if ($this['widgets']->count('logo + headerbar')) : ?>

    <div class="tm-headerbar uk-clearfix uk-hidden-small">

        <div class="uk-container uk-container-center">
            <div class="uk-grid" data-uk-grid-match="">
                <div class="uk-width-medium-6-10">
                    <a href="<?php echo $this['config']->get('site_url');?>" class="sh-company-link">SHARIS GmbH</a> - A PHOENIX MEDIA COMPANY | Tel: +49 (30) 69 80 80 80
                </div>
                <div class="uk-width-medium-4-10">
                    <?php if ($this['widgets']->count('search')) : ?>
                        <div class="uk-navbar-flip uk-hidden-small uk-float-right">
                            <div class="uk-navbar-content"><?php echo $this['widgets']->render('search'); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php echo $this['widgets']->render('headerbar'); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($this['widgets']->count('menu + search')) : ?>
    <div class="tm-top-block tm-grid-block">

        <?php if ($this['widgets']->count('menu + search')) : ?>
            <nav class="tm-navbar uk-navbar" <?php echo 'data-uk-sticky'; ?>>
                <div class="uk-navbar-margin">

                    <?php if ($this['widgets']->count('menu')) : ?>
                        <?php if ($this['widgets']->count('logo')) : ?>
                            <a class="tm-logo uk-hidden-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ($this['widgets']->count('offcanvas')) : ?>
                        <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
                    <?php endif; ?>

                    <?php if ($this['widgets']->count('logo-small')) : ?>
                        <div class="uk-navbar-content uk-navbar-center uk-visible-small"><a class="tm-logo-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a></div>
                    <?php endif;?>
                </div>

            </nav>
        <?php endif; ?>

    </div>
<?php endif; ?>

<?php if ($this['config']->get('fullscreen_image')) : ?>
    <div id="tm-fullscreen" class="tm-fullscreen <?php echo $display_classes['fullscreen']; ?>">
        <?php
        if(ICL_LANGUAGE_CODE == 'de')$postId = 1748;
        elseif(ICL_LANGUAGE_CODE == 'en')$postId = 1750;
        ?>
        <?php if(get_post($postId)) { ?>
            <?php
            $content_post = get_post($postId);
            $content = $content_post->post_content;
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]&gt;', $content);
            echo $content;
            ?>
        <?php } ?>
    </div>
<?php endif; ?>

<!-- <div class="tm-page"> -->

<?php if ($this['widgets']->count('top-a')) : ?>
    <div class="sh-list-articles tm-block<?php echo $block_classes['top-a']; echo $display_classes['top-a']; ?>">
        <div class="uk-container uk-container-center">

            <ul class="uk-grid uk-grid-width-medium-1-3" data-uk-grid-margin data-uk-grid-match="{target:'> div > .uk-panel'}">
                <?php
                global $post;
                if(ICL_LANGUAGE_CODE == 'de')$parentId = 1761;
                elseif(ICL_LANGUAGE_CODE == 'en')$parentId = 1763;
                $args = array('numberposts' => -1,
                    'order' => 'ASC',
                    'post_type' => get_post_types('', 'names'),
                    'post_parent' => $parentId);
                $arr = array("Private:" => "", "Privat:" => "",);
                $myposts = get_posts( $args );
                foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                    <li>
                        <div class="uk-panel uk-panel-space uk-text-center" data-uk-scrollspy="{cls:'uk-animation-fade'}">
                            <h2 class="uk-h4">
                                <?php echo $post->post_content;?>
                                <br/><br/>
                                <?php echo strtr(the_title('', '', false), $arr); ?>
                            </h2>
                            <p>

                                <?php
                                $params = array('numberposts' => -1,
                                    'order' => 'ASC',
                                    'post_type' => get_post_types('', 'names'),
                                    'post_parent' => $post->ID);
                                $childPosts = get_children( $params );
                                $get_children_array = get_children( $params, ARRAY_A );  //returns Array ( [$image_ID].

                                $childPosts = array_values( $get_children_array );


                                foreach ( $childPosts as $childPost ) :
                                ?>
                            <div class="sh-article-item"><a href="<?php echo $childPost['guid'] ; ?>"><?php echo $childPost['post_title'] ; ?></a></div>
                            <?php
                            endforeach;
                            ?>


                            </p>
                        </div>
                    </li>
                <?php endforeach;
                wp_reset_postdata();
                ?>

            </ul>

        </div>
    </div>
<?php endif; ?>


<?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
    <div class="tm-block<?php echo $block_classes['middle'] ?>">

        <!-- <div class="uk-container uk-container-center"> -->

        <div class="uk-grid" data-uk-grid-match data-uk-grid-margin>

            <?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
                <!--<div class="<?php echo $columns['main']['class'] ?>"> -->
                <div class="tm-main uk-width-medium-1-1 uk-row-first">

                    <?php if ($this['widgets']->count('main-top')) : ?>
                        <section class="<?php echo $grid_classes['main-top']; echo $display_classes['main-top']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?></section>
                    <?php endif; ?>

                    <?php if ($this['config']->get('system_output', true)) : ?>
                        <main class="tm-content">
                            <div class="uk-container uk-container-center">
                                <?php if ($this['widgets']->count('breadcrumbs')) : ?>
                                    <?php echo $this['widgets']->render('breadcrumbs'); ?>
                                <?php endif; ?>
                            </div>
                            <?php echo $this['template']->render('content'); ?>

                        </main>
                    <?php endif; ?>

                    <?php if ($this['widgets']->count('main-bottom')) : ?>
                        <section class="<?php echo $grid_classes['main-bottom']; echo $display_classes['main-bottom']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?></section>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <!--<?php foreach($columns as $name => &$column) : ?>
						<?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
						<aside class="<?php echo $column['class'] ?>"><?php echo $this['widgets']->render($name) ?></aside>
						<?php endif ?>
						<?php endforeach ?> -->

        </div>

        <!-- </div> -->

    </div>
<?php endif; ?>

<?php if ($this['widgets']->count('bottom-image')) : ?>
    <div class="tm-block-full">
        <?php echo $this['widgets']->render('bottom-image'); ?>
    </div>
<?php endif; ?>

<?php if ($this['widgets']->count('bottom-a')) : ?>
    <div class="tm-block<?php echo $block_classes['bottom-a']; echo $display_classes['bottom-a']; ?>">
        <div class="uk-container uk-container-center">
            <section class="<?php echo $grid_classes['bottom-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?></section>
        </div>
    </div>
<?php endif; ?>

<?php if ($this['widgets']->count('bottom-b')) : ?>
    <div class="tm-block<?php echo $block_classes['bottom-b']; echo $display_classes['bottom-b']; ?>">
        <div class="uk-container uk-container-center">
            <section class="<?php echo $grid_classes['bottom-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?></section>
        </div>
    </div>
<?php endif; ?>

<?php if ($this['widgets']->count('bottom-c')) : ?>
    <div class="tm-bottom tm-block<?php echo $display_classes['bottom-c']; ?>">
        <div class="uk-container uk-container-center">
            <section class="<?php echo $grid_classes['bottom-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin id="sh-upper-bottom"><?php echo $this['widgets']->render('bottom-c', array('layout'=>$this['config']->get('grid.bottom-c.layout'))); ?></section>
        </div>
    </div>
<?php endif; ?>

<!-- </div> -->

<?php if ($this['widgets']->count('footer + debug') || $this['config']->get('warp_branding', true) || $this['config']->get('totop_scroller', true)) : ?>
    <div class="tm-block">
        <div class="uk-container uk-container-center">
            <footer class="tm-footer uk-text-center">

                <div>
                    <?php
                    echo $this['widgets']->render('footer');
                    /*$this->output('warp_branding');*/
                    echo $this['widgets']->render('debug');
                    ?>
                </div>

                <div>
                    <?php if ($this['config']->get('totop_scroller', true)) : ?>
                        <a class="uk-button uk-button-small uk-button-primary tm-totop-scroller" data-uk-smooth-scroll href="#"><i class="uk-icon-chevron-up"></i></a>
                    <?php endif; ?>
                </div>

            </footer>
        </div>
    </div>
<?php endif; ?>

<?php echo $this->render('footer'); ?>

<?php if ($this['widgets']->count('offcanvas')) : ?>
    <div id="offcanvas" class="uk-offcanvas">
        <div class="uk-offcanvas-bar"><?php echo $this['widgets']->render('offcanvas'); ?></div>
    </div>
<?php endif; ?>

</body>
</html>
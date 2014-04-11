<?php
/*
Template Name: 10 anos
*/
?>

<?php get_header(); ?>
<div class="container-fluid">
    <div class="row">
        <section id="main-section" class="virada-10-anos">
            <?php if ( have_posts()) : while ( have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('row parent');?>>

                    <header>
                        <div class="block">
                            <div class="centered textcenter">
                                <?php html::image("logo-roxo-1024.png", "", array("class" => "img-responsive")); ?>
                            </div>
                        </div>
                    </header>

                    <section>
                        <div class="block">
                            <div class="centered textcenter" style="width: 90%;">
                                <div class="content col-md-8 col-md-offset-2"><?php the_content(); ?></div>
                            </div>
                        </div>
                    </section>

                    <figure class="hidden">
                        <?php if ( has_post_thumbnail() ) the_post_thumbnail("large", array("class" => "background-image")); ?>
                    </figure>
                </article>

                <?php
                    $children = new WP_Query( array( 'post_parent' => $post->ID, 'post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'DESC', 'nopaging' => true));
                    if( $children->have_posts() ) : while( $children->have_posts() ) : $children->the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" data-nav='#nav-<?php the_ID(); ?>' <?php post_class('row children');?>>
                        <figure id='figure-<?php the_ID(); ?>'>
                            <?php the_post_thumbnail("large", array("class" => "background-image")); ?>
                        </figure>
                        <hr style="z-index:10000; position: relative;">

                        <header>
                            <h1><?php the_title(); ?></h1>
                        </header>
                        <section class="clearfix">
                            <?php the_content(); ?>
                            <p><button class="btn btn-large btn-success">Baixar programação</button></p>
                        </section>
                    </article>

                <?php endwhile; endif; ?>
                <!-- .page -->
            <?php endwhile; ?>
            <?php else : ?>
               <p><?php _e('No results found.', 'viradacultural'); ?></p>
            <?php endif; ?>
        </section>
        <!-- #main-section -->
        <nav id="years-nav">
            <div class="year block">
                <div class="centered"><span class="icon icon_house"></span></div>
            </div>
            <?php if( $children->have_posts() ) : while( $children->have_posts() ) : $children->the_post(); ?>
                <div id='nav-<?php the_ID() ?>' class="year block">
                    <div class="centered"><?php the_title(); ?></div>
                </div>
            <?php endwhile; endif; ?>
        </nav>
    </div>
    <?php // get_footer(); ?>
</div>
<!-- .container-fluid -->


<script type="text/javascript" charset="utf-8">
(function($){
    $(document).ready(function() {
        var $win             = $(window),
            $bg              = $("figure > img"),
            $navBar          = $('#site-navbar'),
            $header          = $('#main-header'),
            $footer          = $('#main-footer'),
            aspectRatio      = $bg.width() / $bg.height(),
            win_height       = $win.height(),
            win_width        = $win.width(),
            navbar_height    = $navBar.height(),
            header_width     = $header.width(),
            article_height = win_height - navbar_height;

        $("#main-section > article").css({'position': 'fixed', 'top': 1000});
        $("#main-section > article figure").css({'position': 'fixed', 'top': 0});

        function resize() {
            article_height = win_height - navbar_height;
            win_height = $win.height();
            
            // Altura da seção principal
            $("#main-section").height(article_height)
            // Altura e largura dos artigos
            $("#main-section > article").height(article_height).width(win_width - header_width);
            // Altura do artigo pai
            $("#main-section > article.parent").height(article_height * 2);
            // Margem do header do artigo pai
            $("#main-section > article.parent > header").css({ marginTop: navbar_height });
            // Altura da seção do artigo pai
            $("#main-section > article.parent .block").height(article_height);
            // Altura da imagem do artigo pai
            $("#main-section > article.parent .block > .centered > img").css({height: win_height - navbar_height * 2, width: "auto"});

            // Ano
            $("#years-nav").css({height: article_height, top: navbar_height});

            $('body').css('height',  article_height * ($("#main-section > article").length + 2) + navbar_height);
        }

        $win.resize(resize).trigger("resize");

        $("#main-section > article.parent").animascroll({
            startAt: 0,
            finishAt: function(){ console.log(win_height); return win_height; },
            animation: function(p){
                $(this).css('top', $.PVAL(0, -win_height, p));
            }
        });

        $("#main-section > article.children").each(function(i){
            var index = i+2;
            var $nav = $($(this).data('nav'));
            var $this = $(this);
            var $figure = $this.find('figure');

            $this.animascroll({
                startAt: function(){
                    return index * article_height;
                },
                finishAt: function(){
                    return (index + 1) * article_height;
                },
                animation: function(p){
                    $this.css('top', $.PVAL(win_height, navbar_height, p));
                    if(p >= 50){
                        $('#years-nav a.active').removeClass('active');
                        $nav.addClass('active');
                    }

                }
            }).animascroll({
                startAt: function(){
                    return index * article_height + article_height/2;
                },
                finishAt: function(){
                    return (index + 1) * article_height - article_height/8;
                },
                animation: function(p){
                    $figure.css('opacity',$.PVAL(0,1,p));
                }
            });
        });
    })
})(jQuery);
</script>
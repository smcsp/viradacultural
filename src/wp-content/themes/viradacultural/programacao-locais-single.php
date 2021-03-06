<!-- .container-fluid -->

<?php get_header(); ?>

<div ng-controller="espaco">

    <div class="container-fluid container-menu-large">
        <section id='programacao-loading'></section>
        <section id="main-section" class="row">
            <article id="space-00" class="space-single">
                <header>
                    <h1>{{space.name}}</h1>
                </header>
                <img class="center-block" ng-src="{{conf.templateURL}}/img/virada-icon-2x.png">
                <div class="timeline clearfix">
                    <div class="event-group" ng-repeat="event in spaceEvents">
                        <div class="timeline-time" ng-if="event.duration === '24h00'">24 horas</div>
                        <div class="timeline-time" ng-if="event.duration !== '24h00'">{{event.startsAt}}</div>
                        <article class="event clearfix event-grid" ng-class="{'no-thumb' : !event.defaultImageThumb, 'evento-24h': event.duration === '24h00'}">
                            <img ng-src="{{event.defaultImageThumb}}"/>
                            <a href="{{event.url}}">
                                <div class="event-content clearfix">
                                    <h1>{{event.name}}</h1>
                                </div>
                            </a>
                            <a class="icon favorite favorite-wait favorite-event-{{event.id}}" ng-click="favorite(event.id)"><!--qdo selecionado adicionar classe 'active'--></a>
                        </article>
                    </div>
                </div>
                <!-- .timeline -->
                <div class="servico col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    <p>
                        <span><span>Endereço:</span> {{space.endereco}}<br></span>
                        <span><span>Telefone:</span> {{space.telefonePublico}}<br></span>
                        <span ng-if='space.acessibilidade'><span>Acessibilidade:</span> Sim<br></span>
                    </p>

                    <iframe width="100%" height="220" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                            ng-src="{{getTrustedURI(mapUrl)}}"></iframe>
                    <p class="hidden-md hidden-lg">
                        <a class="btn btn-primary btn-xs" target="_blank" href="{{mapUrl}}">
                            <span class="icon icon_pin"></span> Ver no mapa
                        </a>
                    </p>
                </div>
            </article>
            <!-- .event-single -->
        </section>
        <!-- #main-section -->
        <?php get_footer(); ?>
    </div>
    <!-- .container-fluid -->
</div>
<?php html::part('countdown'); ?>

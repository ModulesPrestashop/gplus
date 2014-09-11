<div class="block_gplus_footer" id="gplus_footer">
    <span class="title_block">{l s="Social"}</span>
    <a class="toggler"></a>
    <ul>
        <li>
            <!-- Inserta esta etiqueta donde quieras que aparezca Botón +1. -->
            <div class="g-plusone" data-size="tall" data-href="{$base_dir}"></div>

            <!-- Inserta esta etiqueta después de la última etiqueta de widget. -->
            <script type="text/javascript">
                window.___gcfg = { lang: 'es' };

                (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                 })();
            </script>
        </li>
        <li>
            <!-- Gplus Module Facebook -->
            <div id="fb-root"></div>
            <script type="text/javascript">
                (function(d, s, id)
                 {
                     var js, fjs = d.getElementsByTagName(s)[0];
                     if (d.getElementById(id)) return;
                     js = d.createElement(s); js.id = id;
                     js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=196021770450060";
                     fjs.parentNode.insertBefore(js, fjs);
                 
                 }
                 (document, 'script', 'facebook-jssdk'));
            </script>
            <div class="fb-like" data-href="{$base_dir}" data-layout="box_count" data-action="like" data-show-faces="true" data-share="true"></div>
        </li>
        <li>
            <!-- Gplus Module Twitter -->
            
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="{$base_dir}" data-via="espirometros" data-lang="es" data-size="large" data-hashtags="espirometros">Twittear</a>
        </li>
    </ul>
</div>







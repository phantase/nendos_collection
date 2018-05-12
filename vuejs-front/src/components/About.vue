<template>
  <div class="db-box">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Acknowledgement</h3>
          </div>
          <div class="box-body">
            <p>Nendoroids-db is a service to manage online your collection of Nendoroids. You can join us to start collecting Nendoroids and viewing what is inside the boxes. You can also view toy photographies of Nendoroids that will help you to find new inspiration as our photos are tagged with the specifics elements that are in the Nendoroids boxes.</p>
            <p>This website is not affiliated with <i>Good Smile Company</i> or any other company producing Nendoroids. <i>Nendoroid Series</i> is a brand created by <i>Good Smile Company</i>.</p>
          </div>
        </div>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Technical point</h3>
          </div>
          <div class="box-body">
            <p>This website has been developed by <i>phantase</i> on free time.</p>
            <p>The front side is made with the following technologies:</p>
            <ul>
              <li><a href="https://adminlte.io/themes/AdminLTE/index2.html">AdminLTE</a>: An amazing CSS and JS board theme from <a href="https://adminlte.io/">Almsaeed Studio</a>.</li>
              <li><a href="http://getbootstrap.com/">Bootstrap</a>: The most popular HTML, CSS, and JS framework for developing responsive, mobile first projects on the web.</li>
              <li><strike><a href="http://elasticlunr.com/">Elasticlunr.js</a>: Lightweight full-text search engine in Javascript for browser search and offline search.</strike></li>
              <li><a href="http://filedropjs.org/">Filedrop.js</a>: Self-contained cross-browser HTML5, legacy, AJAX, drag & drop JavaScript file upload.</li>
              <li><a href="http://fontawesome.io/">Font Awesome</a>: The iconic font and CSS toolkit.</li>
              <li><a href="http://ionicons.com/">Ionicons</a>: The premium icon font from Ionic Framework.</li>
              <li><a href="https://jquery.com/">jQuery</a>: The write less, do more library.</li>
              <li><a href="https://alex-d.github.io/Trumbowyg/">Trumbowyg</a>: A lightweight WYSIWYG editor.</li>
              <li><a href="https://vuejs.org/">Vue.js</a>: The Progressive JavaScript Framework.</li>
              <li><a href="https://github.com/pagekit/vue-resource">Vue-resource</a>: The HTTP client for Vue.js.</li>
              <li><a href="http://router.vuejs.org/">Vue-router</a>: The official router for Vue.js.</li>
              <li><a href="https://vuex.vuejs.org/">Vuex</a>: Centralized State Management for Vue.js.</li>
              <li><strike><a href="https://select2.github.io/">Select2</a>: The jQuery replacement for select boxes.</strike></li>
              <li><a href="https://www.npmjs.com/package/vue-autosuggest">Vue-Autosuggest</a>: Autosuggest component built for Vue.</li>
            </ul>
            <p>The Server side is made with:</p>
            <ul>
              <li><a href="http://www.php.net/">php</a>: A popular general-purpose scripting language that is especially suited to web development.</li>
              <li><a href="https://www.mysql.com/">MySQL</a>: An open-source relational database management system (RDBMS).</li>
              <li><a href="https://www.slimframework.com/">Slim</a>: A micro framework for PHP.</li>
              <li><a href="https://seldaek.github.io/monolog/">Monolog</a>: Logging for PHP.</li>
              <li><a href="https://github.com/slimphp/PHP-View">SlimPHP/PHP-View</a>: A simple PHP renderer for Slim3.</li>
              <li><a href="http://appelsiini.net/projects/slim-jwt-auth/">JWT Authentication Middleware</a>: A middleware implementing JSON Web Token Authentication.</li>
              <li><a href="https://github.com/tuupola/base62">Tuupola/base62</a>: An encoder and decoder for arbitraty data.</li>
              <li><a href="https://github.com/paragonie/random_compat">Paragonie/random_compat</a>: A PHP 5.x support for random_bytes() and random_int().</li>
              <li><a href="https://github.com/PHPMailer/PHPMailer">PHPMailer</a>: The classic email sending library for PHP.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppBoxHeader from './layouts/BoxHeader'

export default {
  name: 'Credits',
  components: {
    AppBoxHeader
  },
  data () {
    return {
    }
  }
}
</script>

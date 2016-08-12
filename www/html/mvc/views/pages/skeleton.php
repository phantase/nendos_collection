<!DOCTYPE HTML>
<!--
  Phantom by HTML5 UP
  html5up.net | @ajlkn
  Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
  <head>
    <title>Nendoroids DB</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <base href="/nendos/">
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
  </head>
  <body>
    <!-- Wrapper -->
      <div id="wrapper">

        <!-- Header -->
          <header id="header">
            <div class="inner">

              <!-- Logo -->
                <a href="/nendos/" class="logo">
                  <span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Nendoroids DB</span>
                </a>

              <!-- Nav -->
                <nav>
                  <ul>
                    <li><a href="#menu">Menu</a></li>
                  </ul>
                </nav>

            </div>
          </header>

        <!-- Menu -->
          <nav id="menu">
            <h2>Menu</h2>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="generic.html">Ipsum veroeros</a></li>
              <li><a href="generic.html">Tempus etiam</a></li>
              <li><a href="generic.html">Consequat dolor</a></li>
              <li><a href="elements.html">Elements</a></li>
            </ul>
          </nav>

<?php
  include_once('mvc/views/pages-parts/'.$action.'.php');
?>

        <!-- Footer -->
          <footer id="footer">
            <div class="inner">
              <ul class="copyright">
                <li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
              </ul>
            </div>
          </footer>

      </div>

    <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.paging.min.js"></script>
      <script src="assets/js/jquery.ba-hashchange.min.js"></script>
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/util.js"></script>
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="assets/js/main.js"></script>

  </body>
</html>

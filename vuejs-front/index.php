<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Nendoroids db</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="/static/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/static/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/static/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/static/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/static/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/static/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/static/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/static/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/static/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/static/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/static/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/static/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/static/favicon/favicon-16x16.png">
    <link rel="manifest" href="/static/favicon/manifest.json">
    <?php /* Create meta for social */
      $params = explode("/",$_SERVER['REQUEST_URI']);
      try
      {
        $bdd = new PDO('mysql:host=db;dbname=nendos;charset=utf8', 'nendos', 'nendospass');
        switch ($params[1]) {
          case 'boxes':
            // We are in boxes
            $req = $bdd->prepare("SELECT c.count, b.internalid, b.category, b.number, b.name FROM (SELECT count(*) AS count FROM boxes) AS c, (SELECT internalid, category, number, name FROM boxes ORDER BY creationdate DESC LIMIT 1) AS b");
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Already ".$rep['count']." boxes described in Nendoroids-db";
            $og_description = "We have ".$rep['count']." boxes described in Nendoroids-db. The last one is ".$rep['category']."".(isset($rep['number'])?" #".$rep['number']:"")." - ".$rep['name'];
            $og_image = "https://api.nendoroids-db.net/images/boxes/".$rep['internalid']."/1/thumb";
            break;
          case 'box':
            // We are in single box
            $req = $bdd->prepare("SELECT b.internalid, b.category, b.number, b.name, series, manufacturer FROM boxes b WHERE internalid = :internalid");
            $req->bindParam(':internalid',$params[2]);
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - ".$rep['category']."".(isset($rep['number'])?" #".$rep['number']:"")." - ".$rep['name'];
            $og_description = "A box described in Nendoroids-db, Box: ".$rep['category']."".(isset($rep['number'])?" #".$rep['number']:"")." - ".$rep['name']." - From series: ".$rep['series']." - From manufacturer: ".$rep['manufacturer'];
            $og_image = "https://api.nendoroids-db.net/images/boxes/".$rep['internalid']."/1/thumb";
            break;
          case 'nendoroids':
            // We are in nendoroids
            $req = $bdd->prepare("SELECT c.count, p.internalid, p.name, p.version, p.box_category, p.box_number, p.box_name FROM (SELECT count(*) AS count FROM nendoroids) AS c, (SELECT p.internalid, p.name, p.version, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM nendoroids p, boxes b WHERE p.boxid = b.internalid ORDER BY p.creationdate DESC LIMIT 1) AS p");
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Already ".$rep['count']." nendoroids described in Nendoroids-db";
            $og_description = "We have ".$rep['count']." nendoroids described in Nendoroids-db. The last one is ".$rep['name']."".(isset($rep['version'])?" - ".$rep['version']:"")." - From box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/nendoroids/".$rep['internalid']."/thumb";
            break;
          case 'nendoroid':
            // We are in single nendoroid
            $req = $bdd->prepare("SELECT p.internalid, p.name, p.version, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM nendoroids p, boxes b WHERE p.boxid = b.internalid AND p.internalid = :internalid");
            $req->bindParam(':internalid',$params[2]);
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Nendoroid: ".$rep['name']."".(isset($rep['version'])?" - ".$rep['version']:"")." - From box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_description = "A nendoroid described in Nendoroids-db, ".$rep['name']."".(isset($rep['version'])?" - ".$rep['version']:"")." - From box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/nendoroids/".$rep['internalid']."/thumb";
            break;
          case 'faces':
            // We are in faces
            $req = $bdd->prepare("SELECT c.count, p.internalid, p.box_category, p.box_number, p.box_name FROM (SELECT count(*) AS count FROM faces) AS c, (SELECT p.internalid, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM faces p, boxes b WHERE p.boxid = b.internalid ORDER BY p.creationdate DESC LIMIT 1) AS p");
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Already ".$rep['count']." faces described in Nendoroids-db";
            $og_description = "We have ".$rep['count']." faces described in Nendoroids-db. The last one comes from box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/faces/".$rep['internalid']."/thumb";
            break;
          case 'face':
            // We are in singe face
            $req = $bdd->prepare("SELECT p.internalid, p.eyes, p.eyes_color, p.mouth, p.skin_color, p.sex, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM faces p, boxes b WHERE p.boxid = b.internalid AND p.internalid = :internalid");
            $req->bindParam(':internalid',$params[2]);
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Face: ".$rep['eyes']." from ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_description = "A face described in Nendoroids-db, a ".$rep['sex']." face, the eyes are ".$rep['eyes']."[".$rep['eyes_color']."] and the mouth is ".$rep['mouth']." [".$rep['skin_color']."] - From box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/faces/".$rep['internalid']."/thumb";
            break;
          case 'hairs':
            // We are in hairs
            $req = $bdd->prepare("SELECT c.count, p.internalid, p.haircut, p.box_category, p.box_number, p.box_name FROM (SELECT count(*) AS count FROM hairs) AS c, (SELECT p.internalid, p.haircut, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM hairs p, boxes b WHERE p.boxid = b.internalid ORDER BY p.creationdate DESC LIMIT 1) AS p");
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Already ".$rep['count']." hairs described in Nendoroids-db";
            $og_description = "We have ".$rep['count']." hairs described in Nendoroids-db. The last one is a ".$rep['haircut']." - From box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/hairs/".$rep['internalid']."/thumb";
            break;
          case 'hair':
            // We are in single hair
            $req = $bdd->prepare("SELECT p.internalid, p.frontback, p.haircut, p.description, p.main_color, p.other_color, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM hairs p, boxes b WHERE p.boxid = b.internalid AND p.internalid = :internalid");
            $req->bindParam(':internalid',$params[2]);
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Hairs: ".$rep['haircut']." from ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_description = "Some hairs described in Nendoroids-db, ".$rep['frontback']." - ".$rep['haircut']." [".$rep['main_color'].(isset($rep['other_color'])?"/".$rep['other_color']:"")."] - ".$rep['description']." - From box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/hairs/".$rep['internalid']."/thumb";
            break;
          case 'hands':
            // We are in hands
            $req = $bdd->prepare("SELECT c.count, p.internalid, p.box_category, p.box_number, p.box_name FROM (SELECT count(*) AS count FROM hands) AS c, (SELECT p.internalid, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM hands p, boxes b WHERE p.boxid = b.internalid ORDER BY p.creationdate DESC LIMIT 1) AS p");
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Already ".$rep['count']." hands described in Nendoroids-db";
            $og_description = "We have ".$rep['count']." hands described in Nendoroids-db. The last one comes from box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/hands/".$rep['internalid']."/thumb";
            break;
          case 'hand':
            // We are in single hand
            $req = $bdd->prepare("SELECT p.internalid, p.posture, p.leftright, p.skin_color, p.description, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM hands p, boxes b WHERE p.boxid = b.internalid AND p.internalid = :internalid");
            $req->bindParam(':internalid',$params[2]);
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Hand: ".$rep['posture']." from ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_description = "A hand described in Nendoroids-db, ".$rep['leftright']." - ".$rep['posture']." [".$rep['skin_color']."] - ".$rep['description']." - From box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/hands/".$rep['internalid']."/thumb";
            break;
          case 'bodyparts':
            // We are in bodyparts
            $req = $bdd->prepare("SELECT c.count, p.internalid, p.part, p.box_category, p.box_number, p.box_name FROM (SELECT count(*) AS count FROM bodyparts) AS c, (SELECT p.internalid, p.part, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM bodyparts p, boxes b WHERE p.boxid = b.internalid ORDER BY p.creationdate DESC LIMIT 1) AS p");
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Already ".$rep['count']." bodyparts described in Nendoroids-db";
            $og_description = "We have ".$rep['count']." bodyparts described in Nendoroids-db. The last one is a ".$rep['part']." - From box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/bodyparts/".$rep['internalid']."/thumb";
            break;
          case 'bodypart':
            // We are in single bodypart
            $req = $bdd->prepare("SELECT p.internalid, p.part, p.main_color, p.other_color, p.description, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM bodyparts p, boxes b WHERE p.boxid = b.internalid AND p.internalid = :internalid");
            $req->bindParam(':internalid',$params[2]);
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Bodypart: ".$rep['part']." from ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_description = "A bodypart described in Nendoroids-db, ".$rep['part']." [".$rep['main_color'].(isset($rep['other_color'])?"/".$rep['other_color']:"")."] - ".$rep['description']." - From box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/bodyparts/".$rep['internalid']."/thumb";
            break;
          case 'accessories':
            // We are in accessories
            $req = $bdd->prepare("SELECT c.count, p.internalid, p.type, p.box_category, p.box_number, p.box_name FROM (SELECT count(*) AS count FROM accessories) AS c, (SELECT p.internalid, p.type, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM accessories p, boxes b WHERE p.boxid = b.internalid ORDER BY p.creationdate DESC LIMIT 1) AS p");
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Already ".$rep['count']." accessories described in Nendoroids-db";
            $og_description = "We have ".$rep['count']." accessories described in Nendoroids-db. The last one is a ".$rep['type']." - From box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/accessories/".$rep['internalid']."/1/thumb";
            break;
          case 'accessory':
            // We are in accessory
            $req = $bdd->prepare("SELECT p.internalid, p.type, p.main_color, p.other_color, p.description, b.category AS box_category, b.number AS box_number, b.name AS box_name FROM accessories p, boxes b WHERE p.boxid = b.internalid AND p.internalid = :internalid");
            $req->bindParam(':internalid',$params[2]);
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Accessory: ".$rep['type']." from ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_description = "An accessory described in Nendoroids-db, ".$rep['type']." [".$rep['main_color'].(isset($rep['other_color'])?"/".$rep['other_color']:"")."] - ".$rep['description']." - From box: ".$rep['box_category']."".(isset($rep['box_number'])?" #".$rep['box_number']:"")." - ".$rep['box_name'];
            $og_image = "https://api.nendoroids-db.net/images/accessories/".$rep['internalid']."/1/thumb";
            break;
          case 'photos':
            // We are in photos
            $req = $bdd->prepare("SELECT c.count, p.internalid, p.title, p.uploader FROM (SELECT count(*) AS count FROM photos) AS c, (SELECT p.internalid, p.title, u.username AS uploader FROM photos p, users u WHERE p.userid = u.internalid ORDER BY p.uploaded DESC LIMIT 1) AS p");
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Already ".$rep['count']." photos described in Nendoroids-db";
            $og_description = "We have ".$rep['count']." photos described in Nendoroids-db. The last one is named «".$rep['title']."» and comes from ".$rep['uploader'];
            $og_image = "https://api.nendoroids-db.net/images/photos/".$rep['internalid']."/thumb";
            break;
          case 'photo':
            // We are in a single photo
            $req = $bdd->prepare("SELECT p.internalid, p.title, u.username AS uploader FROM photos p, users u WHERE p.userid = u.internalid AND p.internalid = :internalid");
            $req->bindParam(':internalid',$params[2]);
            $req->execute();
            $rep = $req->fetch();

            $og_title = "Nendoroids-db - Photo: «".$rep['title']."»";
            $og_description = "A photo uploaded in Nendoroids-db, «".$rep['title']."» from ".$rep['uploader'];
            $og_image = "https://api.nendoroids-db.net/images/photos/".$rep['internalid']."/thumb";
            break;
          default:
            // We are in home
            $req = $bdd->prepare("SELECT b.boxes, n.nendoroids, f.faces, hr.hairs, bp.bodyparts, hd.hands, a.accessories FROM (SELECT count(*) AS boxes FROM boxes) AS b, (SELECT count(*) AS nendoroids FROM nendoroids) AS n, (SELECT count(*) AS faces FROM faces) AS f, (SELECT count(*) AS hairs FROM hairs) AS hr, (SELECT count(*) AS bodyparts FROM bodyparts) AS bp, (SELECT count(*) AS hands FROM hands) AS hd, (SELECT count(*) AS accessories FROM accessories) AS a");
            $req->execute();
            $rep = $req->fetch();
            
            $og_title = "Nendoroids-db - Collect all your Nendoroids parts";
            $og_description = "Nendoroids-db, the unique database for all the Nendoroids parts. Already ".$rep['boxes']." boxes, ".$rep['nendoroids']." nendoroids, ".$rep['faces']." faces, ".$rep['hairs']." hairs, ".$rep['bodyparts']." bodyparts, ".$rep['hands']." hands, ".$rep['accessories']." accessories in the database!";
            $og_image = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/static/favicon/android-icon-192x192.png";
            break;
        }
      }
      catch(Exception $e)
      {
        $og_title = "Nendoroids-db - Collect all your Nendoroids parts";
        $og_description = "Nendoroids-db, the unique database for all the Nendoroids parts.";
        $og_image = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/static/favicon/android-icon-192x192.png";
      }
    ?>
    <meta name="og:type" content="summary" />
    <meta name="og:title" content="<?= $og_title ?>" />
    <meta name="og:description" content="<?= $og_description ?>" />
    <meta name="og:image" content="<?= $og_image ?>" />
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/static/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Piwik -->
    <script type="text/javascript">
      var _paq = _paq || [];
      /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//stats.phantase.com/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <!-- End Piwik Code -->
  </head>
  <body class="hold-transition skin-yellow sidebar-mini">
    <div id="app"></div>

    <script type="text/javascript">
        window.fd = {logging: false}
        // https://piwik.org/blog/2017/02/how-to-track-single-page-websites-using-piwik-analytics/
        var currentUrl = location.href;
        window.addEventListener('hashchange', function() {
            _paq.push(['setReferrerUrl', currentUrl]);
             currentUrl = '' + window.location.hash.substr(1);
            _paq.push(['setCustomUrl', currentUrl]);
            _paq.push(['setDocumentTitle', document.title]);

            // remove all previously assigned custom variables, requires Piwik 3.0.2
            _paq.push(['deleteCustomVariables', 'page']);
            _paq.push(['setGenerationTimeMs', 0]);
            _paq.push(['trackPageView']);

            // make Piwik aware of newly added content
            var content = document.getElementById('content');
            _paq.push(['MediaAnalytics::scanForMedia', content]);
            _paq.push(['FormAnalytics::scanForForms', content]);
            _paq.push(['trackContentImpressionsWithinNode', content]);
            _paq.push(['enableLinkTracking']);
        });
    </script>
    <!-- built files will be auto injected -->
  </body>
</html>


<!DOCTYPE HTML>
<html><head>
        <meta charset="UTF-8">
        <meta name="keywords" content="Ferien, Ferienwohnung, Adelboden, Berner Oberland, Chalet, Skiferien, Familienurlaub, Schweizer Alpen" />
        <meta name="description" content="Gem&uuml;tliche 4,5-Zimmer-Ferienwohnung in Adelboden zu vermieten. 3 Schlafzimmer, grosser Balkon mit herrlicher Aussicht auf Lohner und Steghorn. Ideal f&uuml;r Familien - Sommer und Winter." />
        <meta name="Content-Language" content="de" />

        <!-- Open Graph / Social Media -->
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Ferienwohnung Chalet Arnika - Adelboden" />
        <meta property="og:description" content="Gem&uuml;tliche 4,5-Zimmer-Ferienwohnung mit herrlicher Aussicht im Berner Oberland. 3 Schlafzimmer, grosser Balkon - ideal f&uuml;r Familien." />
        <meta property="og:image" content="https://www.chalet-adelboden.ch/img/chalet-slide-3.jpg" />
        <meta property="og:url" content="https://www.chalet-adelboden.ch/" />
        <meta property="og:locale" content="de_CH" />

        <!-- Canonical URL -->
        <link rel="canonical" href="https://www.chalet-adelboden.ch/" />
        <meta name="author" content="ferrari@web5.ch">
        <meta name="copyright" content="(c)Chalet Arnika, Dora Wettstein">
        <meta name="page-topic" content="Ferien, Immobilien">
        <meta name="robots" content="index,follow">
        <meta name="revisit-after" content="7 days">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chalet Arnika - Adelboden - Ferienwohnung zu vermieten</title>
        <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <link href="lightbox/css/lightbox.css" rel="stylesheet" />
	    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
        <meta name="apple-mobile-web-app-title" content="Arnika" />
        <link rel="manifest" href="/site.webmanifest" />
        <link href='https://fonts.googleapis.com/css?family=Courgette|Baumans|Yellowtail|Satisfy|Raleway' rel='stylesheet' type='text/css'>



        <script src="js/vendor/modernizr.min.js"></script>
        <script src="js/vendor/respond.min.js"></script>

        <!-- include extern jQuery file but fall back to local file if extern one fails to load !-->
        <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script type="text/javascript">window.jQuery || document.write('<script type="text/javascript" src="js\/vendor\/1.7.2.jquery.min"><\/script>')</script>

        <script src="lightbox/js/lightbox.js"></script>
        <script src="js/vendor/prefixfree.min.js"></script>
        <script src="js/vendor/jquery.slides.min.js"></script>
        <script src="js/script.js"></script>

        <!--[if lt IE 9]>
            <style>
                header
                {
                    margin: 0 auto 20px auto;
                }
                #four_columns .img-item figure span.thumb-screen
                {
                    display:none;
                }
            </style>
        <![endif]-->





        <script>
        $(function() {
          var winterInited = false;
          var sommerInited = false;

          var slidesConfig = {
            height: 300,
            navigation: false,
            pagination: false,
            effect: {
              fade: { speed: 400 }
            },
            callback: {
              start: function(number) {
                $("#slider_content1,#slider_content2,#slider_content3").fadeOut(1000);
              },
              complete: function(number) {
                $("#slider_content" + number).delay(1000).fadeIn(2000);
              }
            },
            play: {
              active: false,
              auto: true,
              interval: 5000,
              pauseOnHover: false,
              effect: "fade"
            }
          };

          function initWinter() {
            if (!winterInited) {
              $('#slides-winter').slidesjs(slidesConfig);
              winterInited = true;
            }
          }

          function initSommer() {
            if (!sommerInited) {
              $('#slides-sommer').slidesjs(slidesConfig);
              sommerInited = true;
            }
          }

          function applyMode(mode) {
            if (mode === 'sommer') {
              $('#slides-wrapper-winter').hide();
              $('#slides-wrapper-sommer').show();
              initSommer();
              $('#season-toggle').html('❄ Winter').attr('title', 'Zu Winteransicht wechseln').removeClass('mode-sommer').addClass('mode-winter');
            } else {
              $('#slides-wrapper-sommer').hide();
              $('#slides-wrapper-winter').show();
              initWinter();
              $('#season-toggle').html('☀ Sommer').attr('title', 'Zu Sommeransicht wechseln').removeClass('mode-winter').addClass('mode-sommer');
            }
            localStorage.setItem('seasonMode', mode);
          }

          var savedMode = localStorage.getItem('seasonMode') || 'winter';
          applyMode(savedMode);

          $('#season-toggle').click(function() {
            var current = localStorage.getItem('seasonMode') || 'winter';
            applyMode(current === 'winter' ? 'sommer' : 'winter');
          });
        });
        </script>


       <!-- Scroll Top -->
 <script>
	$(function() {
	  $('a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top
	        }, 1000);
	        return false;
	      }
	    }
	  });
	});
	</script>



	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="fancybox/source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-buttons.css" />
	<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-thumbs.css" />
	<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js"></script>

	<script type="text/javascript">





	/*
	 *  Fancy Box
	 */

	$(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
	</script>


        <!-- Strukturierte Daten / Schema.org -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "LodgingBusiness",
            "name": "Chalet Arnika",
            "description": "Gemütliche 4,5-Zimmer-Ferienwohnung in Adelboden mit herrlicher Aussicht auf Lohner und Steghorn",
            "url": "https://www.chalet-adelboden.ch/",
            "image": "https://www.chalet-adelboden.ch/img/chalet-slide-3.jpg",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Röschtalweg 8",
                "addressLocality": "Adelboden",
                "postalCode": "3715",
                "addressRegion": "BE",
                "addressCountry": "CH"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": "46.485896",
                "longitude": "7.5506234"
            },
            "priceRange": "CHF 500/Woche",
            "amenityFeature": [
                {"@type": "LocationFeatureSpecification", "name": "3 Schlafzimmer", "value": true},
                {"@type": "LocationFeatureSpecification", "name": "Balkon", "value": true},
                {"@type": "LocationFeatureSpecification", "name": "Küche", "value": true},
                {"@type": "LocationFeatureSpecification", "name": "WLAN", "value": true},
                {"@type": "LocationFeatureSpecification", "name": "Parkplatz", "value": true}
            ],
            "numberOfRooms": "4.5",
            "petsAllowed": "Auf Anfrage"
        }
        </script>
    </head>

	<body>
        <header>
          <div class="toggleMobile">
                <span class="menu1"></span>
                <span class="menu2"></span>
                <span class="menu3"></span>
            </div>
            <div id="mobileMenu">
                <ul>

                  <li><a href="/#spacer">Ferienwohnung</a></li>
                    <li><a href="/#galerie">Galerie</a></li>
                    <li><a href="/#reservation">Reservation</a></li>
                </ul>
            </div>
            <h1>Chalet Arnika</h1>
            <p>Röschtalweg 8 | 3715 Adelboden </p>

            <nav>
                <ul>

                  <li><a href="/#spacer">Ferienwohnung</a></li>
                    <li><a href="/#galerie">Galerie</a></li>
                    <li><a href=/"#reservation">Reservation</a></li>

              </ul>
            </nav>
            <button id="season-toggle" title="Zu Sommeransicht wechseln">☀ Sommer</button>
        </header>
    <section class="container">
            <div id="slides-wrapper-sommer">
                <div id="slides-sommer">
                    <picture>
                        <source srcset="img/slide13.avif" type="image/avif">
                        <source srcset="img/slide13.webp" type="image/webp">
                        <img src="img/slide13.jpg" alt="Sommerimpressionen Adelboden – blühende Alpwiesen beim Chalet Arnika">
                    </picture>
                    <picture>
                        <source srcset="img/slide11.avif" type="image/avif">
                        <source srcset="img/slide11.webp" type="image/webp">
                        <img src="img/slide11.jpg" alt="Sommerliche Berglandschaft rund um das Chalet Arnika in Adelboden">
                    </picture>
                    <picture>
                        <source srcset="img/slide15.avif" type="image/avif">
                        <source srcset="img/slide15.webp" type="image/webp">
                        <img src="img/slide15.jpg" alt="Idyllische Sommerlandschaft mit Aussicht auf das Berner Oberland">
                    </picture>
                </div>
            </div>
            <div id="slides-wrapper-winter">
                <div id="slides-winter">
                    <picture>
                        <source srcset="img/slide4.avif" type="image/avif">
                        <source srcset="img/slide4.webp" type="image/webp">
                        <img src="img/slide4.jpg" alt="Chalet Arnika im Winter mit Blick auf die verschneiten Berge in Adelboden">
                    </picture>
                    <picture>
                        <source srcset="img/slide5.avif" type="image/avif">
                        <source srcset="img/slide5.webp" type="image/webp">
                        <img src="img/slide5.jpg" alt="Winterpanorama vom Chalet Arnika mit Aussicht auf das Berner Oberland">
                    </picture>
                    <picture>
                        <source srcset="img/slide7.avif" type="image/avif">
                        <source srcset="img/slide7.webp" type="image/webp">
                        <img src="img/slide7.jpg" alt="Schneelandschaft rund um die Ferienwohnung in Adelboden">
                    </picture>
                </div>
            </div>

        </section>
    <section id="spacer">
            <p>Gemütliche 4,5&#8211;Zimmer&#8211;Ferienwohnung in Adelboden zu vermieten .</p>
        </section>
        <section id="boxcontent">
          <article class="large">
            <h3>Impressum</h3>
            <address>
                Frank Wettstein<br>
                Alpenstrasse 21A<br>
                2502 Biel<br>
                E-Mail: <span id="email-container"></span>
            </address>
	    <br/><br/>
            <h3>Haftungshinweis</h3>
            <p>Trotz sorgfältiger inhaltlicher Kontrolle übernehme ich keine Haftung
für die Inhalte externer Links. Für den Inhalt der verlinkten Seiten sind ausschliesslich
deren Betreiber verantwortlich.</p>
            <br/><br/>
            <h3>Datenschutzerklärung</h3>
            <p>Ihre mittels Kontaktformular übermittelten Angaben (Name, Vorname und E-MailAdresse) werden nicht für Marketing-Zwecke verwendet. Falls es zu keiner Vermietung
der Ferienwohnung kommt, werden Ihre Daten unverzüglich gelöscht.</p>
            <script>
                (function() {
                    var u = 'arnika';
                    var at = String.fromCharCode(64);
                    var d = 'chalet-adelboden.ch';
                    var e = u + at + d;
                    var c = document.getElementById('email-container');
                    if (c) {
                        var a = document.createElement('a');
                        a.href = 'mailto:' + e;
                        a.textContent = e;
                        c.appendChild(a);
                    }
                })();
            </script>
            </article>
            <br class="clear"/>
        </section>
        <footer>
            <section id="copyright">
                <div class="wrapper">

                &copy; Copyright 2025 by <a href="http://www.web5.ch" target="_blank">web5</a>. All Rights Reserved.<a href="impressum.php" title="Datenschutz &amp; Impressum" target="_blank"> Datenschutz & Impressum</a> </div>
            </section>
            <section class="wrapper">
                <article class="column">
                    <h4><a id="formular"></a>Kontakt & Reservationsanfragen</h4>
                    <p>Sind Sie an weiteren Informationen interessiert? Möchten Sie, dass ich Kontakt mit Ihnen aufnehme? Oder wollen Sie direkt eine Reservationsanfrage machen?
                    </p>
                    <p>Ich freue mich auf Ihre Mailanfrage!</p>
                </article>






 <!-- FORMULAR -->


                    <?php

	// sprachliche und regionale Einstellungen auf Deutsch
	setlocale(LC_TIME, "de_DE.utf8"); // Deutsch (DE)
	setlocale(LC_TIME, "de_AT.utf8"); // Deutsch (AT)
	setlocale(LC_TIME, "de_CH.utf8"); // Deutsch (CH)

	/* C: Fehlerdefinitionen
	---------------------------
	Entscheide, welche Felder zwingend sind. Pro zwingendem Feld
	definierst du einerseitzs, unter welchen Bedingungen die engegebnen
	Daten flasch sind, andererseits eine entsprechende Fehlermeldung
	*/

	$validierung = array();
	$validierung['name']['istFalsch']		 = strlen($_POST['name']) < 2; // sind weniger als 2 Zeichen erfasst, dann gab ein TRUE, also ein falsch zurück
	$validierung['name']['fehlerMeldung']	 = '- Vorname/Nachname';
	$validierung['email']['istFalsch']			 = !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // !filter_var überprüft, ob die eingegebene email gültig sein kann
	$validierung['email']['fehlerMeldung']		 = '- E-Mail-Adresse';
	$validierung['wochentag']['istFalsch']	  	 = strtolower(strftime('%A'))  != strtolower($_POST['wochentag']);
	$validierung['wochentag']['fehlerMeldung']	 = '- Heutiger Wochentag';

	/*
	D: Gab's Fehler?
	-------------------------
	Enthält mindestens eines der als zwingend markierten Felder einen falschden Wert?
	Beispielsweise $validierung['<feldname>]'['istFalsch'] den Wert TRUE?
	Wir gehen davon aus, dass das Formular nicht mehr gezeigt werden muss, da alle Angaben korrekt.
	Falls aber ein Feld falsch ist, muss es wieder gezeigt werden.
	*/
	$formularZeigen = FALSE; // Annahme: Das Formular muss nicht gezeigt werden
							 // Boolscher Wert (ja oder Nein, TURE oder FLASE, wahr oder falsch, 1 oder 0)
	$fehlermeldungen = '';   // Variable, in der die Fehlertextge gesammelt werden
	// Prüfen, ob mindestens eines der Felder falsch ist
	foreach($validierung as $feldName => $eigenschaften) {
		// wurde dieses Feld falsch ausgefüllt?
		if($eigenschaften['istFalsch']) {
			// Ja, also muss das Formular doch gezeigt werden
			$formularZeigen = TRUE;
			$fehlerMeldungen.= $eigenschaften['fehlerMeldung'];
			$fehlerMeldungen.= '<br>';
		}
	}
	// Falls das Formular gezeigt werden soll
	if($formularZeigen) {

	/*
	E: Fehlermeldungen anzeigen
	---------------------------------
	Aber nur, wenn das Formular wirklich verschickt wurde
	*/
	if($_POST) {
		echo '<h4 class="fehlerMeldungen">Bitte folgende Felder erg&auml;nzen:<br>'.$fehlerMeldungen.'</h4>';

	}


?>

<form action="index.php#formular" method="post">
   <article class="column midlist">
                    <h4>Füllen Sie bitte alle Felder aus</h4>


	<ul>
       <li>
        <input  type="text" name="name" id="name"  class="inputfield"  placeholder="Vorname / Nachname"
        value="<?php echo htmlspecialchars(stripslashes($_POST['name'])); ?>">
    </li>


   	<li>
     	<input  type="text" name="email" id="email"  class="inputfield" placeholder="E-Mail-Adresse"
        value="<?php echo htmlspecialchars(stripslashes($_POST['email'])); ?>">
    </li>


     <li>
       	<input  type="text" name="wochentag" id="wochentag" class="inputfield" placeholder="Heutiger Wochentag">
    </li>
    </ul>
  </article>
  		<article class="column rightlist">
           <h4>und teilen Sie mir Ihr Anliegen mit.</h4>
              <ul>
     		    <li>
     			  <textarea name="mitteilung" id="mitteilung"  class="textarea" placeholder="Mitteilung"><?php echo htmlspecialchars(stripslashes($_POST['mitteilung']));?></textarea>
    			</li>
   				 <li>
  			    <input type="submit" name="submit" value="senden" class="button" />
    			 </li></ul>

 </form>
<?php
	} // Ende if($formularZeigen)


	/*
	G: Alternative zu D
	--------------------
	Das Formular ist korrekt ausgefüllt. Die Daten können verarbeitet werden.
	Rückmeldung an den Benutzer.
	*/
	else {

		// H: Datenverarbeitung, Versand als HTML-Mail an den Betreiber der Website
		$html = file_get_contents('gui/mailvorlage.html');
		// Alle Platzhalter durch die Benutzereingaben ersetzen
		$html = str_replace('***NAME***', $_POST['name'], $html);
		$html = str_replace('***EMAIL***', $_POST['email'], $html);
		// In der Mitteilung sollen Zeilenumbrüche übernommen werden (nl2br)
		$html = str_replace('***MITTEILUNG***', nl2br($_POST['mitteilung']), $html);


		// PHPMailer-Klasse inbetten
		include('php/class.phpmailer.php');

		// Neue Instanz von PHPMailer erzeugen mittels $m (Analog Floash: symbol von Bibliothek auf die Bühne ziehen")
		$m = new PHPMailer();
		// Eigenschaften des Mail-objekts einstellen
		$m-> From = 'arnika@chalet-adelboden.ch'; // falls Absenderadresse rein soll: = $POST['email'];
		$m-> FromName = $_POST['email'];		// Absendername
		$m-> Subject = 'Kontaktformular Arnika';			// Betreffzeile
		$m-> AddAddress('arnika@chalet-adelboden.ch', 'Chalet Arnika');	// Empfänger
		$m-> Body = $html;												// Inhlat dser Mailnachricht
		$m-> isHTML(TRUE);												// Es handelt sich um ein HTML-Mail
		$m-> CharSet = 'utf-8';
		$m-> Send();

		// Speicher freigeben
		$m = null;












		// I: Rückmeldung an den Benutzer, Vielen Dank und so....
		echo '<h4>Vielen Dank für ihr Interesse. Ich melde mich schnellstmöglich bei ihnen.</h4>';


	}
	?>

                    <br class="clear"/>
                </article>
            </section>
    </footer>
        <a href="#0" class="cd-top">Top</a>
        <script src="js/main.js"></script> <!-- Gem jQuery -->
	</body>
</html>

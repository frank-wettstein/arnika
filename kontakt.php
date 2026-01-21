

<?php
	
	/* C: Fehlerdefinitionen
	---------------------------
	Entscheide, welche Felder zwingend sind. Pro zwingendem Feld
	definierst du einerseitzs, unter welchen Bedingungen die engegebnen
	Daten flasch sind, andererseits eine entsprechende Fehlermeldung
	*/
	
	$validierung = array();
	$validierung['name']['istFalsch']		 = strlen($_POST['name']) < 2; // sind weniger als 2 Zeichen erfasst, dann gab ein TRUE, also ein falsch zurück
	$validierung['name']['fehlerMeldung']	 = 'Name fehlt.';
	$validierung['email']['istFalsch']			 = !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // !filter_var überprüft, ob die eingegebene email gültig sein kann
	$validierung['email']['fehlerMeldung']		 = 'Mail-Adresse fehlt.';
	$validierung['wochentag']['istFalsch']	  	 = strtolower(strftime('%A'))  != strtolower($_POST['wochentag']);
	$validierung['wochentag']['fehlerMeldung']	 = 'Aktueller Wochentag fehlt.';
	
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
		echo '<p class="fehlerMeldungen">'.$fehlerMeldungen.'</p>';	
	}
	
	
?>



<!-- F: Formular -->
<form action="kontakt.php" method="post">
	
         
   
    
    <p>
    	<label for="name">Name:</label>
        <input  type="text" name="name" id="name"  class="inputfield" placeholder="Name" 
        value="<?php echo htmlspecialchars(stripslashes($_POST['name'])); ?>">
    </p>
   
      
            
   	<p>
     	<label for="email">E-Mail-Adresse:</label>
       <input  type="text" name="email" id="email"  class="inputfield" placeholder="E-Mail-Adresse" 
        value="<?php echo htmlspecialchars(stripslashes($_POST['email'])); ?>"> 
    </p>
  
    <p> <label for="mitteilung">Mitteilung:</label>
       <textarea name="mitteilung" id="mitteilung"  class="inputarea" placeholder="Mitteilung"><?php echo htmlspecialchars(stripslashes($_POST['mitteilung']));?></textarea>
    </p>
  
  
       
           
           	<p>
     	<label for="wochentag">Heutiger Wochentag:</label>
       	<input  type="text" name="wochentag" id="wochentag" class="inputfield" placeholder="Heutiger Wochentag">
    </p>
    
    <p><label>&nbsp;</label>	
      <input type="submit" name="submit" value="senden" class="button" />
     

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
		$m-> From = 'chalet@adelboden.ch'; // falls Absenderadresse rein soll: = $POST['email'];
		$m-> FromName = $_POST['vorname'].' '.$_POST['nachname'];		// Absendername
		$m-> Subject = 'Das Kontaktformular wurde abgeschickt';			// Betreffzeile
		$m-> AddAddress('ferrari@web5.ch', '$Chalet Arnika');			// Empfänger
		$m-> Body = $html;												// Inhlat dser Mailnachricht
		$m-> isHTML(TRUE);												// Es handelt sich um ein HTML-Mail
		$m-> CharSet = 'utf-8';
		$m-> Send();
		
		// Speicher freigeben
		$m = null;
		
			
		
		
		
		// I: Rückmeldung an den Benutzer, Vielen Dank und so....
		echo '<p>Vielen Dank für Ihr Interesse. Ich melde mich schnellstm&ouml;glich bei Ihnen.</p>';
		
		
	}
	?>
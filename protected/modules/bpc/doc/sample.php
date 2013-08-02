<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>BPC client</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>

		<?php
		error_reporting(E_ALL);

		echo('<h1>Simple BPC sample client</h1>');

		include('config.php');
		include('bpc_core.php');

		if (!isset($_GET['do']))
			$_GET['do'] = null;
		$indata = array();

		/**
		 *
		 * function bpcRequest
		 *
		 * Gjør det som trengs av forhånds- og etterbehandling av data for bpcDoRequest()
		 *
		 * $postdata - array bestående av datafelt => verdi for data som skal sendes til BPC
		 * $ignerror - feilkoder som blir håndtert lokalt i koden og dermed skal ignoreres i denne funksjonen. De aktuelle feedback-kodene (4xx) sendes gjerne her
		 *
		 * returnerer $data, et flerdimensjonalt array som inneholder data fra BPC
		 *
		 */
		function bpcRequest($postdata, $ignerror = array()) {
			global $indata;
			$data = $indata = bpcDoRequest($postdata);

			if (isset($data['error'])) {
				// Vi har feilmeldinger. Hvis feilkoden ligger i $ignerror blir den ignorert, ellers skriver vi ut feilmeldinger.
				foreach ($data['error'] as $error) {
					foreach ($error as $errorcode => $errormsg) {
						$data['error'][$errorcode] = $errormsg;
						if (!in_array($errorcode, $ignerror) && bpcConfig::$debug)
							echo "Errorcode: $errorcode.<br />
						  Error message: $errormsg.<br />";
					}
				}
			}
			return $data;
		}

// This is the big switch that determines what this page does
		switch ($_GET['do']) {
			// Add a person to an event. This data must be sanitized, this is just a simple example!
			case 'adduser':
				// $postdata contains all data needed by BPC
				$postdata = array(
					'request' => 'add_attending',
					'fullname' => $_POST['name_field'],
					'username' => $_POST['username_field'],
					'card_no' => sha1((float) $_POST['card_field']), // Important! Cast to float before hashing
					'event' => $_REQUEST['event'],
					'year' => $_POST['year_field']
				);
				$data = bpcRequest($postdata);
				// $data now contains the response to the action. Do what you want with it from here.
				echo "<a href='sample.php'>Back to event list</a><br />";
				echo "var_dump of retured data:<br /><pre>\n";
				var_dump($indata);
				echo "</pre>";
				break;


			// Remove a person from an event. This data must be sanitized, this is just a simple example!
			case 'deluser':
				// $postdata contains all data needed by BPC
				$postdata = array(
					'request' => 'rem_attending',
					'username' => $_POST['username_field'],
					'event' => $_GET['event']
				);
				$data = bpcRequest($postdata);
				// $data now contains the response to the action. Do what you want with it from here.
				echo "<a href='sample.php'>Back to event list</a><br />";
				echo "var_dump of retured data:<br /><pre>\n";
				var_dump($indata);
				echo "</pre>";
				break;


			// Retrive all users attending an event. Requires an eventid
			case 'userlist':
				$postdata = array(
					'request' => 'get_attending',
					'event' => $_GET['event']
				);

				$data = bpcRequest($postdata);
				// $data now contains all attending users for this event. Do what you want with it from here.
				echo "<a href='sample.php'>Back to event list</a><br />";
				echo "var_dump of retured data:<br /><pre>\n";
				var_dump($indata);
				echo "</pre>";
				break;

			// Retrive all users attending an event. Requires an eventid
			case 'waitinglist':
				$postdata = array(
					'request' => 'get_waiting',
					'event' => $_GET['event']
				);

				$data = bpcRequest($postdata);
				// $data now contains all attending users for this event. Do what you want with it from here.
				echo "<a href='sample.php'>Back to event list</a><br />";
				echo "var_dump of retured data:<br /><pre>\n";
				var_dump($indata);
				echo "</pre>";
				break;

			case 'stats':
				// Show stats for a user
				$postdata = array(
					'request' => 'get_user_stats',
					'username' => $_POST['username'],
					'detailed_stats' => (!empty($_POST['detailed_stats'])) ? true : false,
					'event_type' => 'all'
				);
				$data = bpcRequest($postdata);
				echo "<a href='sample.php'>Back to event list</a><br />";
				echo "var_dump of retured data:<br /><pre>\n";
				var_dump($indata);
				echo "</pre>";
				break;

			// List all events, or one event if eventid is set.
			default:
			case 'eventlist':
				// Legger til påkrevd data
				$postdata = array(
					'request' => 'get_events'
				);

				// Send additional parameters if available
				if (isset($_GET['eventid']) && ctype_digit($_GET['eventid']))
					$postdata['event'] = $_GET['eventid'];
				if (isset($_GET['username']) && ctype_alpha($_GET['username']))
					$postdata['username'] = $_GET['username'];
				if (isset($_GET['fromdate']))
					$postdata['fromdate'] = $_GET['fromdate'];
				if (isset($_GET['todate']))
					$postdata['todate'] = $_GET['todate'];
				if (isset($_GET['event_type'])) {
					switch ($_GET['event_type']) {
						case 'not_advertised':
							// Viser kun events uten blæstedeal
							$postdata['event_type'] = 'not_advertised';
							break;
						case 'all':
							// Viser alle åpne events, uavhengig av om vi har blæstedeal eller ikke
							$postdata['event_type'] = 'all';
							break;
						case 'advertised':
						default:
							// Viser kun events med blæstedeal
							$postdata['event_type'] = 'advertised';
					}
				} else {
					$postdata['event_type'] = 'advertised';
				}

				// Tell bpcRequest to ignore error code 403 (no events), since we are dealing with that ourselves
				$ignerror = array(403);
				$data = bpcRequest($postdata, $ignerror);
				// $data now contains all BPC events for this organization. Do what you want with it from here.

				if (isset($data['event']) && is_array($data['event'])) {
					if (!(isset($_GET['eventid']) && ctype_digit($_GET['eventid']))) {
						echo ($postdata['event_type'] == 'advertised') ? '' : "<a href='sample.php?do=eventlist&amp;event_type=advertised'>Vis alle med blæstedeal</a><br />";
						echo ($postdata['event_type'] == 'not_advertised') ? '' : "<a href='sample.php?do=eventlist&amp;event_type=not_advertised'>Vis alle uten blæstedeal</a><br />";
						echo ($postdata['event_type'] == 'all') ? '' : "<a href='sample.php?do=eventlist&amp;event_type=all'>Vis alle</a><br />";

						// We are dealing with a list of events, make a simple table linking to each individual event

						echo "<table border='1'>
					  <tr><th>Event</th><th>Date</th><th>Seats available/seats total</th><th>Registration starts</th></tr>\n";
						foreach ($data['event'] as $event) {
							echo "
						<tr>
							<td><a href='sample.php?do=eventlist&amp;eventid=" . $event['id'] . "'>" . $event['title'] . "</a></td>
							<td>" . $event['time'] . "</td>
							<td>" . $event['seats_available'] . "/" . $event['seats'] . "</td>
							<td>" . $event['registration_start'] . "</td>
						</tr>\n";
						}
						echo "</table>\n";
						?>
						<h3>Show user stats</h3>
						<form method="post" action="sample.php?do=stats">
							Username: <input type="text" size="10" name="username" /><br />
							<input type="checkbox" name="detailed_stats" /> Show detailed info<br />
							<input type="submit" value="OK" name="user_stats" />
						</form>
						<?php
					} else {
						// One single event, show detailed view
						$event = $data['event'][0];

						echo "<h1>" . $event['title'] . "</h1><br />\n";
						echo "<img src='" . $event['logo'] . "' alt='" . $event['title'] . " logo' /><br />";
						echo "Tid " . $event['time'] . "<br />\n";
						echo $event['registration_started'] ? "Påmelding startet " : "Påmelding starter ";
						echo $event['registration_start'] . "<br />\n";
						echo "Påmeldingsfrist: " . $event['deadline'] . "<br />\n";
						echo "Ledige plasser: " . $event['seats_available'] . "/" . $event['seats'] . "<br />\n";
						echo "Påmeldte fra denne linjeforeningen: " . $event['this_attending'] . "/" . $event['seats'] . "<br />\n";
						echo "Antall på venteliste fra denne linjeforeningen: " . $event['count_waiting'] . "<br />\n";
						echo ($event['waitlist_enabled']) ?
								"Venteliste er aktivert for dette arrangementet.<br />\n" :
								"Venteliste er ikke aktivert for dette arrangementet.<br />\n";
						echo "Åpen for: ";
						echo ($event['open_for'] == 1) ? "alle klassetrinn" : $event['open_for'] . ". klasse og høyere";
						echo "<br />\n";
						echo "Beskrivelse:<br />" . nl2br($event['description']) . "<br />\n";
						if ($event['registration_started']) {
							?>
							<h3>Meld på en bruker.</h3>
							<form action="sample.php?do=adduser&amp;event=<?= $event['id'] ?>" method="post" name="adduser">
								Navn: <input type="text" size="20" maxlength="50" name="name_field" /><br />
								Brukernavn: <input type="text" size="12" maxlength="8" name="username_field" /><br />
								Kortnummer: <input type="text" size="12" maxlength="10" name="card_field" /><br />
								Årstrinn: <input type="text" size="3" maxlength="1" name="year_field" /><br />
								<input type="submit" name="submit" value="Meld på">
							</form>
							<h3>Meld av en bruker.</h3>
							<form action="sample.php?do=deluser&amp;event=<?= $event['id'] ?>" method="post" name="remuser">

								Brukernavn: <input type="text" size="12" maxlength="8" name="username_field" /><br />
								<input type="submit" name="submit" value="Meld av">
							</form>
							<br />
							<a href='sample.php?do=userlist&amp;event=<?= $event['id'] ?>'>Vis påmeldte brukere</a><br />
							<a href='sample.php?do=waitinglist&amp;event=<?= $event['id'] ?>'>Vis brukere på venteliste</a><br />
							<?php
						} else {
							echo "Påmelding har ikke startet ennå.";
						}
					}
				}

				echo "<br />var_dump of returned data:<br /><pre>";
				var_dump($indata);
				echo "</pre>
			  <br /><br />This is a very simple example client for the BPC remote interface, utilizing cURL for https-communication with the BPC-server.<br />";
				break;
		}
		?>

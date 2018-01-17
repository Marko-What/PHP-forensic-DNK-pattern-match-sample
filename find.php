<?php 
	echo "<div class='container'>";
	
	echo "<h2 style='text-align:center;'> forensic DNK pattern finder </h2>";
	

	/*$dnkSample = "HHHKLJ140L98IHYYYN";*/
	$dnkSample = $_POST['dnk_sample'];
	

	/* legend ... */
	
 	/* race */
	$RaceColors = array("Asian" => "1HYYYN", "Hispanic" => "IHYYYN", "White" => "IHYYNN"); 
	 /* hair */
	$HairColors = array("Brown" => "HHHKLJ", "Black" => "HHHKLI", "Blonde" => "HHLH1L", "White" => "HHLH2L");
	/* eyes */
	$eyesColors = array("Black" => "140L98", "Green" => "140A98", "Brown" => "140A88", "Blue" => "140L97");

	

	$suspect_name['name'] =filter_var(trim($_POST['suspect_name']), FILTER_SANITIZE_STRING);
	$suspect_HairColors = filter_var(trim($_POST['suspect_hair']), FILTER_SANITIZE_STRING);
	$suspect_eyesColors = filter_var(trim($_POST['suspect_eyes']), FILTER_SANITIZE_STRING);
	$suspect_RaceColors = filter_var(trim($_POST['dnk_race']), FILTER_SANITIZE_STRING);

	$suspect_name['Hair'] = $HairColors[$suspect_HairColors]; 
	$suspect_name['Eyes'] = $eyesColors[$suspect_eyesColors]; 
	$suspect_name['Race'] = $RaceColors[$suspect_RaceColors];
	


	echo "<div class='col-sm-8 col-sm-offset-2'>";
	echo "<br />";
	
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST['delete'])){
			echo "<span class='delS'>Deleted</span>";
		}
	}



	echo "<span style='font-size:18px;'>{$suspect_name['name']}</span>";
	echo "<br />";

	function RaceMatch($RaceDnkSample, $suspectRaceDnk){
		if($RaceDnkSample == $suspectRaceDnk){ 
		echo "<span class='match'> DNK: Race Match,  </span>";
		echo "<br />";								
		}else { 
			if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete'])){
				echo "<span  class='noMatch'>DNK: Race does not match</span>";
				echo "<br />";
			}			
					
		}	
	}
	

	
	function eyesMatch($EyesDnkSample, $suspectEyesDnk){
		if($EyesDnkSample == $suspectEyesDnk){ 
		echo "<span class='match'> DNK: Eyes Color Match,  </span>";
		echo "<br />";								
		} else { 
			if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete'])){
			
				echo "<span class='noMatch'>DNK: Eyes color does not match</span>";
				echo "<br />";
			}				
					
		}
	}
	

	
	function hairMatch($HairDnkSample, $suspectHairDnk){
		if($HairDnkSample == $suspectHairDnk){ 
		echo "<span class='match'> DNK: hair Color Match, </span>";
		echo "<br />";								
		} else { 
			if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete'])){
			echo "<span class='noMatch'> DNK: hair color does not match </span>";
			echo "<br />";	
			}
			
		}	
	}
	


	function suspectFind($suspectName, $dnkSample){
		
		$dnkSlice['hair'] = substr($dnkSample,0,6);
		$dnkSlice['eyes'] = substr($dnkSample,6,6);
		$dnkSlice['race'] = substr($dnkSample,12,6);
		
			
		$suspectMatch['race']= RaceMatch($dnkSlice['race'], $suspectName['Race']);
		$suspectMatch['eyes']= eyesMatch($dnkSlice['eyes'], $suspectName['Eyes']);
		$suspectMatch['hair']= hairMatch($dnkSlice['hair'], $suspectName['Hair']);
		
	}
	
	suspectFind($suspect_name, $dnkSample);
	echo "<br />";	
	echo "<div id='line' class='line'></div>";
	echo "<br />";	

	echo "</div>";


echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>";


echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'>";


echo "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>";

echo "<script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g='
crossorigin='anonymous'></script>";


echo "<link rel='stylesheet' type='text/css' href='style.css' />";


	echo "<div class='col-sm-8 col-sm-offset-2'>";

	echo "<form method='POST' action='{$_SERVER['PHP_SELF']}'>";

	echo "<div class='form-group'>";
	echo "<label for='SuspectName'>Suspect name:</label>";
	echo "<input type='text' class='form-control' id='SuspectName' name='suspect_name'>";
	
	echo "</div>";

	echo "<div class='form-group'>";
	echo "<label for='Suspect_Hair'>Suspect Hair:</label>";
	echo "<input type='text' class='form-control' id='Suspect_Hair' name='suspect_hair'>";

	echo "</div>";

	echo "<div class='form-group'>";

	echo "<label for='Suspect_Eyes'>Suspect Eyes:</label>";
	echo "<input type='text' class='form-control' id='Suspect_Eyes' name='suspect_eyes'>";

	echo "</div>";

	echo "<div class='form-group'>";	

	echo "<label for='Suspect_Race'>Suspect Race:</label>";
	echo "<input type='text' class='form-control' id='Suspect_Race' name='dnk_race'><br>";
	
	echo "</div>";

	echo "<div class='form-group'>";

	echo "<label for='Suspect_Sample'>Dnk Sample:</label>";
	echo "<input type='text' name='dnk_sample' class='form-control' id='Suspect_Sample' value='{$dnkSample}'><br>";

	echo "</div>";

	echo "<input type='submit'  class='btn btn-primary' value='Find' id='findButton'>";
	echo "<button type='submit'  class='btn btn-danger'  name='delete' value='delete' style='margin-left:5px;'>Delete</button>";
	echo "</form>";
	

	echo "</div>";

	echo "</div>";

echo "<script src='line.js'></script>";
?>

<?php
/**
 *
 * this app is contingent upon the  installation and proper 
 * configuration of the nmMini package (config-mini.php) or equivalent  
 * 
 * @package nmListView
 * @author Jenny Crimp <jenny.crimp@gmail.com>
 * @Modified 2015/03/04
 */
 
require 'include/config.php'; #provides configuration, pathing, error handling, db credentials
 
# check variable of item passed in - if invalid data, forcibly redirect back to demo_list.php page
if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
	 $myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
}else{#send the user to a safe location!
	header("Location:beer_list.php");
}

//sql statement to select individual item
$sql = "select Beer,Category,Style,Brewer,Appearance,Description,AlcoholContent,Calories from Beers where BeerID = " . $myID;
//---end config area --------------------------------------------------

$foundRecord = FALSE; # Will change to true, if record found!
   
# connection comes first in mysqli (improved) function
$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));
$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));

if(mysqli_num_rows($result) > 0)
{#records exist - process
	   $foundRecord = TRUE;	
	   while ($row = mysqli_fetch_assoc($result))
	   {
			$Beer = dbOut($row['Beer']);
			$Category = dbOut($row['Category']);
			$Style = dbOut($row['Style']);
			$Brewer = dbOut($row['Brewer']);
			$Appearance = dbOut($row['Appearance']);
			$Description = dbOut($row['Description']);
			$AlcoholContent = (float)$row['AlcoholContent'];
			$Calories = (int)$row['Calories'];
	   }
}

@mysqli_free_result($result); # We're done with the data!

if($foundRecord)
{#only load data if record found
	$title = $Beer; #overwrite title with Beer info!
}
# END CONFIG AREA ---------------------------------------------------------- 

include 'include/header.php'; #header must appear before any HTML is printed by PHP
?>
<h3 align="center">Beer View</h3>


<?php
if($foundRecord)
{#records exist - show beer!
?>
	<h3 align="center" style="text-shadow:none;"><?=$Beer;?></h3>
	
	<table align="center">
		<tr>
			<td rowspan="6"><img src="upload/b<?=$myID;?>.jpg" /></td>
			<td><?=$Beer;?></td>
		</tr>
		<tr>
			<td>Style: <?=$Style;?></td>
		</tr>
		<tr>
			<td>Brewer: <?=$Brewer;?></td>
		</tr>
		<tr>
			<td>
				Description: <br />
				<blockquote><?=$Description;?></blockquote>
			</td>
		</tr>
		<tr>
			<td>Alcohol Content: <?=$AlcoholContent;?></td>
		</tr>
		<tr>
			<td>Calories: <?=$Calories;?></td>
		</tr>
	</table>
	<div align="center"><a href="beer_list.php">Back to the list of beers</a></div>
<?php
}else{//no such beer!
    echo '<div align="center">What! No such beer? There must be a mistake!!</div>';
    echo '<div align="center"><a href="demo_list.php">Another Beer?</a></div>';
}

include 'include/footer.php'; #header must appear before any HTML is printed by PHP
?>

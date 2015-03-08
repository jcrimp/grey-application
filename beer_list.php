<?php
/**
 * demo_list.php along with demo_view.php provides a sample web application
 *
 * this app is contingent upon the  installation and proper 
 * configuration of the nmMini package (config-mini.php) or equivalent
 * 
 * @package nmListView
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 3.0 2012/11/14
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see demo_view.php
 * @todo none
 */

require 'include/config.php'; #provides configuration, pathing, error handling, db credentials 
 
# SQL statement
$sql = "select Beer, BeerID, Style, Brewer from Beers";

#Fills <title> tag  
$title = 'So many beers!';

# END CONFIG AREA ---------------------------------------------------------- 

include 'include/header.php'; #header must appear before any HTML is printed by PHP
?>
<h3 align="center">Beer List</h3>
<table>
 
<?php

# connection comes first in mysqli (improved) function

$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));
$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));
if(mysqli_num_rows($result) > 0)
{#records exist - process
	while($row = mysqli_fetch_assoc($result))
	{# process each row
         echo '<tr>';
         echo '<td rowspan="3" style="text-align:center; background-color:white;"><a href="beer_view.php?id=' . (int)$row['BeerID'] . '">' . '<img src="upload/b' . (int)$row['BeerID'] . '.jpg" /></a></td>';
         echo '<td><a href="beer_view.php?id=' . (int)$row['BeerID'] . '"><h4 style="text-shadow:none;">' . (int)$row['BeerID'] . '. ' . dbOut($row['Beer']) . '</h4></a></td>';
         echo '</tr>';
         echo '<tr>';
         echo '<td>Style: ' . dbOut($row['Style'])  . '</td>';
         echo '</tr>';
         echo '<tr>';
         echo '<td>Brewer: ' . dbOUt($row['Brewer']) . '</td></tr>';
 
	} 
}else{#no records
    echo "<div align=center>What! No beers?  There must be a mistake!!</div>";	
}
?>
</table>
<?php
@mysqli_free_result($result);

include 'include/footer.php';
?>

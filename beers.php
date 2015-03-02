<?php include 'include/config.php';?>
<?php include 'include/header.php';?>
<h1>Beers</h1> 
<p>Cool beers goes here.</p>
<?php
$sql = "select * from Beers";

$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_error()));

$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));

if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
	while ($row = mysqli_fetch_assoc($result))
    {
	   echo "<p>";
	   echo "Beer: <b>" . $row['Beer'] . "</b><br />";
	   echo "Category: <b>" . $row['Category'] . "</b><br />";
	   echo "Style: <b>" . $row['Style'] . "</b><br />";
	   echo "Brewer: <b>" . $row['Brewer'] . "</b><br />";
  	   echo "Apprearance: <b>" . $row['Appearance'] . "</b><br />";
	   echo "Description: <b>" . $row['Description'] . "</b><br />";
	   echo "</p>";
    }
}
else
{//no records
	echo '<div align="center">What! No Beers?  There must be a mistake!!</div>';
}

@mysqli_free_result($result); #releases web server memory
@mysqli_close($iConn); #close connection to database

?>	  
<?php include 'include/footer.php';?>
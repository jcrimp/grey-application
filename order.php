<?php include 'include/config.php';?>
<?php include 'include/header.php';?>
<h1>Order a website here</h1> 
<p>We love to make websites!</p>	
<?php 

if(isset($_POST['Name']))
{
	//echo $_POST['Name'];
	/*
	echo '<pre>';
	var_dump($_POST);
	echo '</pre>';
	*/
	$to      = 'jenny.crimp@gmail.com';
	$replyto = $_POST['Email'];
	$today   = date("F j, Y, g:i a");
	$subject = 'Email from ' . $_POST['Name'] . ' ' . $today;
	$message = process_post(); // loop through all form elements
	$headers = 'From: noreply@madebyjennycrimp.com' . PHP_EOL .
    		   'Reply-To: ' . $replyto . PHP_EOL .
    		   'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message, $headers);
	echo "<p>Thank you for your message!<p>";
	echo '<p><a href="order.php" id="redirect">Order Another Website?</a></p>';
}
else
{
	echo 
	'
	<form action="' . THIS_PAGE . '" method="post">
		<p>
			<label for="Name">Name:</label>
			<input type="text" id="Name" name="Name" required="required" title="We need your name" placeholder="Enter your name"/>
		</p>
		
		<p>
			<label for="Email">Email:</label>
			<input type="email" id="Email" name="Email" required="required" title="We need your email" placeholder="Enter your email"/>
		</p>
		
		<p>
			<label for="Type_of_website">Type of website:</label>
			<br />
			<input type="radio" 
				   id="Type" 
				   name="Type_of_website"
				   value="Custom"  
				   required="required" 
				   title="We need to know what type of site." 
				   placeholder="Choose the type of site"
			/> Custom<br />
			
			<input type="radio" 
				   name="Type_of_website"
				   value="Framework"  
				   required="required" 
				   title="We need to know what type of site." 
				   placeholder="Choose the type of site"
			/> Framework<br />
			
			<input type="radio" 
				   name="Type_of_website"
				   value="CMS"  
				   required="required" 
				   title="We need to know what type of site." 
				   placeholder="Choose the type of site"
			/> CMS<br />
		</p>
		
		<p>
			<label for="Type_of_website">Features</label>
			<br />
			
			<input type="checkbox" 
				   id="Features" 
				   name="Website_features[]"
				   value="SEO"  
			/> Search engine visibility<br />
			
			<input type="checkbox" 
				   name="Website_features[]"
				   value="SMO"  
			/> Social media integration<br />
			
			<input type="checkbox" 
				   name="Website_features[]"
				   value="Shopping cart"  
			/> Shopping cart<br />
			
			<input type="checkbox" 
				   name="Website_features[]"
				   value="Website search"  
			/> Website Search<br />
		</p>
		
		<p>
			<label for="Comments">Comments:</label>
			<br />
			<textarea id="Comments" 
					  name="Comments" 
					  required="required" 
					  rows="5" cols="40"
					  title="We need your comments." 
					  placeholder="Type your message here"></textarea>
		</p>
			<input type="submit" value="Click to submit!"/>
	</form>
	';
}

?> 
 
<?php include 'include/footer.php'; ?>
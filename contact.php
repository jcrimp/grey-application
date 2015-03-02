<?php include 'include/config.php';?>
<?php include 'include/header.php';?>
<h1>Contact Us</h1> 
<p>Your information is so important to us!</p>	
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
	$message = process_post();
	$headers = 'From: noreply@madebyjennycrimp.com' . PHP_EOL .
    		   'Reply-To: ' . $replyto . PHP_EOL .
    		   'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message, $headers);
	echo '<p>Thank you for your comments!<p>';
	echo '<p><a href="contact.php" id="redirect">Submit another message?</a></p>';
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
			<label for="Comments">Comments:</label>
			<br />
			<textarea id="Comments" 
					  name="Comments" 
					  required="required" 
					  rows="5" cols="40"
					  title="We need your comments." 
					  placeholder="Type your message here"></textarea>
		</p>
		<div class="g-recaptcha" data-sitekey="6Lde7QETAAAAAM-g-qRzvGNAwucjC_s5kh1YsmGk"></div>
			<input type="submit" value="Click to submit!"/>
	</form>
	';
}

?> 
 
<?php include 'include/footer.php'; ?>
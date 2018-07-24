<?php 
	include ("../lib/Session.php");
	Session::checklogin();
?>
<?php
	include ("../config/config.php");
	include ("../lib/Database.php");
	include ("../helpers/Format.php");
?>
<?php
	$db = new Database();
	$fm = new Format();
?>	
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">


		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$email = $fm ->validation($_POST['email']);
				$email = mysqli_real_escape_string($db->link, $email);

				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					
					 echo "<span style='color:red'>invalid email address!!!</span>";
					}else{

						 $mailquery ="SELECT * FROM tbl_user WHERE email ='$email' limit 1";
                         $mail = $db ->select($mailquery);

						if($mail != false){
							while ($value = $mail ->fetch_assoc()) {
								$userid = $value['id'];
								$username = $value['username'];
							}

							$text = substr($email, 0,3);
							$rand = rand(10000,99999);
							$newpass = "$text$rand";
							$password = md5($newpass);
							$updatequery ="UPDATE tbl_user SET email = '$email' WHERE id = '$userid' ";
                       		 $updatedpass = $db ->update($updatequery);

                       		 $to = "$email";
                       		 $from = "roky@gmail.com";
                       		 $headers = "From: $from\n";
                       		// $headers[] .= 'MIME-Version: 1.0';
							// $headers[] .= 'Content-type: text/html; charset=iso-8859-1';
							 $subject = "Your recovery password";
							 $message = "your username is ".$username." and your password is ".$newpass."please visit website to login";

							 $sendmail = mail($to, $subject, $message, $headers);
							 if ($sendmail) {
					              echo "<span class='success'>Please check your email for new password </span>";
					          }else {
					             echo "<span class='error'>Email not sent !</span>";
					              }							
						}else{
								echo "<span style='color:red;font-size:18px'>Email not exits!!!</span>";
							}
					}
				}
		?>

		
		<form action="" method="post">
			<h1>Password recovery</h1>
			<div>
				<input type="text" placeholder="enter valid email" required="" name="email"/>
			</div>
			
			<div>
				<input type="submit" value="Send" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div>
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
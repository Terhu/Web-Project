<?php
	session_start();

	// the user name is registered as $name
	$name = $_SESSION["name"];

	/* Test to check if the message enterded is empty or not */ 
	if(isset($_POST['submitmsg']))
	{  
	    // test to check if the message enterded is empty or not
	    if($_POST['message'] != "")
	    {  
	        $_SESSION['message'] = stripslashes(htmlentities($_POST['message']));
	        $message = $_SESSION['message'];

	        $message = htmlentities($message, ENT_QUOTES); //ENT_QUOTES	Will convert both double and single quotes.

	        // replace [] with tags <> 
	        $message = str_replace("[b]", "<strong>", $message);
	        $message = str_replace("[/b]", "</strong>", $message);

	        $message = str_replace("[i]", "<i>", $message);
	        $message = str_replace("[/i]", "</i>", $message);

	        $message = str_replace("[u]", "<u>", $message);
	        $message = str_replace("[/u]", "</u>", $message);

	        //copy the last message, behind the username, on top of the chat file
	        $content= "<p><span>" . $name ." : " . $message. "</span></p> \n";
	        $file = 'chat.txt';
	        $current=file_get_contents($file);
	        $content .= $current;
	        file_put_contents($file, $content);
	    }  
	}  


	//if the user press the button "francais", we change page for "chat_french.php"
	if(isset($_POST['francais']))
	{
	    setcookie('lang', "french", time()+3600);
	    header("location: chat_french.php");
	}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <title> Chat Room </title>  
    <link type="text/css" rel="stylesheet" href="mystyle.css" /> 
</head> 

<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
//   -->
</script>

<body onload="JavaScript:timedRefresh(5000);">

<!-- ChatRoom -->


		<!-- Displays the users online  -->
		<div  id="colonne2" class="panel panel-info" id="userlist">
			  <div class="panel-heading"> Users Online </div>
			  <div class="panel-body">
				<?php
		                echo file_get_contents("pseudo.txt"); 
		            ?>
			  </div>
		</div>

		<!-- Displays the languages choices  -->
		<div id="colonne1" class="panel panel-info" id="lg_choice"> 
			<div class="panel-heading">Language Choice</div>
			  <div class="panel-body">
					<form class="form-signin" role="form" action="chat_english.php" method="post">
			            <h2 class="form-signin-heading">  </h2>
			            <button class="btn btn-lg btn-primary btn-block" type="submit" name="francais" id="francais">Fran&ccedil;ais</button>
			            <button class="btn btn-lg btn-primary btn-block" type="submit" name="english" id="english">English</button>
			        </form>
			  </div>
			</div> 
  		</div> 


  		<!-- Displays the sending form  -->
	<div id="centre">
		<div id="wrapper">  
	        <div id="menu"> 
	        	<!-- Welcoming message withe the username --> 
	            <p class="welcome">Welcome, <b><?php echo $name; ?></b></p> 


	            <!-- link to disconnect from the chat -->
	            <p class="logout"><a id="exit" href="logOut_english.php">Exit Chat</a></p>  
	            <div style="clear:both"></div>  
	        </div>      


	         <!-- Previous discussions -->
	         <div id="chatbox">
			        	<?php
			                echo file_get_contents("chat.txt"); 
			            ?>
			</div> 


	        <!-- Form to wright a new message in the ChatRoom -->
			<div id="MessageForm" class="container"> 
				<form class="form-signin" role="form" method="post" action="chat_english.php">
					<label for="message">Message:</label>  
					<input class="form-control" placeholder="Message" required="" autofocus="" name="message" type="text" id="message"/>
							<center>
								<!-- Icons used to pimp up your message -->
								<img src="icons/italic.jpg" alt="italic" title="button italic" class="icone" id="italic" width='40'/>
								<img src="icons/underline.jpg" alt="underline" title="button underline" class="icone" id="underline" width='40'/>
								<img src="icons/bold.jpg" alt="bold" title="button bold" class="icone" id="bold" width='40'/>
							</center>  

					<button class="btn btn-sm btn-primary btn-block" name="submitmsg" type="submit"  id="submitmsg" value="Enter" > Send </button>  
				</form>
			</div> 
		 </div> 
	</div>


	<!-- Including javascript for the chat -->
	<script src="jquery.js"></script>
	<script src="chat.js"></script>
</body>

</html>

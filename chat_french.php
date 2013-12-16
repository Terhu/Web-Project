<?php
	session_start();

	// le pseudo est enregistre sous la variable $name
	$name = $_SESSION["name"];

	// test pour verifier si le message rentre est vide ou pas 
	if(isset($_POST['submitmsg']))
	{  
	    //si l'utilisateur a rentré un message
	    if($_POST['message'] != "")
	    {  
	        $_SESSION['message'] = stripslashes(htmlentities($_POST['message']));
	        $message = $_SESSION['message'];

	        $message = htmlentities($message, ENT_QUOTES); //ENT_QUOTES	converti a la fois les ' '  et les " "

	        // remplace les balises [] par des balises <> 
	        $message = str_replace("[b]", "<strong>", $message);
	        $message = str_replace("[/b]", "</strong>", $message);

	        $message = str_replace("[i]", "<i>", $message);
	        $message = str_replace("[/i]", "</i>", $message);

	        $message = str_replace("[u]", "<u>", $message);
	        $message = str_replace("[/u]", "</u>", $message);


	        // copie le dernier message, derière le pseudo, en haut du fichier de conversation
	        $content= "<p><span>" . $name ."</span> : " . $message. "</p> \n";
	        $file = 'chat.txt';
	        $current=file_get_contents($file);
	        $content .= $current;
	        file_put_contents($file, $content);
	    }  
	}  

	// si l'utilisateur appui sur le bouton "angalis" il est redirige vers le chat anglais
	if(isset($_POST['english']))
	{
	    setcookie('lang', "english", time()+3600);
	    header("location: chat_english.php");
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <title> Salle de Discussion </title>  
    <link type="text/css" rel="stylesheet" href="mystyle.css" /> 
</head> 

<script type="text/JavaScript">
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
</script>


<body onload="JavaScript:timedRefresh(5000);">

<!-- Salle de Discussion -->

		<!-- Liste des utilisateurs connectés -->
		<div  id="colonne2" class="panel panel-info" id="userlist">
			  <div class="panel-heading"> Utilisateurs Connect&eacute;es </div>
			  <div class="panel-body">
				<?php
		                echo file_get_contents("pseudo.txt"); 
		            ?>
			  </div>
		</div>

		<!-- Liste des choix de langues -->
		<div id="colonne1" class="panel panel-info" id="lg_choice"> 
			<div class="panel-heading">Choix des langues</div>
			  <div class="panel-body">
					<form class="form-signin" role="form" action="chat_french.php" method="post">
			            <h2 class="form-signin-heading">  </h2>
			            <button class="btn btn-lg btn-primary btn-block" type="submit" name="francais" id="francais">Fran&ccedil;ais</button>
			            <button class="btn btn-lg btn-primary btn-block" type="submit" name="english" id="english">English</button>
			        </form>
			  </div>
			</div> 
  		</div> 


<!-- Formulaire d'envoi de message -->
<div id="centre">
	<div id="wrapper" >  
        <div id="menu" > 
        	<!-- Message d'accueil avec le pseudo de l'utilisateur --> 
            <p class="welcome">Bienvenue, <b><?php echo $name; ?></b></p> 


            <!-- Lien pour se deconnecter de la salle de discussion -->
            <p class="logout"><a id="exit" href="logOut_french.php"> Quitter la discussion </a></p>  
            <div style="clear:both"></div>  
        </div>      


         <!-- Discussions precedentes -->
         <div id="chatbox">
		        	<?php
		               echo file_get_contents("chat.txt"); 
		            ?>
		</div> 

        <!-- Formulaire pour ecrire un nouveau message dans la discussion -->
		<div id="MessageForm" class="container"> 
			<form class="form-signin" role="form" method="post" action="chat_french.php">
				<label for="message">Message:</label>  
				<input class="form-control" placeholder="Message" required="" autofocus="" name="message" type="text" id="message"/>
						<center>
							<!-- Images pour mettre en forme le message -->
							<img src="icons/italic.jpg" alt="italic" title="button italic" class="icone" id="italic" width='40'/>
							<img src="icons/underline.jpg" alt="underline" title="button underline" class="icone" id="underline" width='40'/>
							<img src="icons/bold.jpg" alt="bold" title="button bold" class="icone" id="bold" width='40'/>
						</center>  

				<button class="btn btn-sm btn-primary btn-block" name="submitmsg" type="submit"  id="submitmsg" value="Enter" >Envoyer </button>  
			</form>
		</div> 
	 </div> 
</div>

	<!-- On inclut les fichiers de javaScript -->
	<script src="jquery.js"></script>
	<script src="chat.js"></script>
	
</body>
</html>

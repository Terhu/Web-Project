<?php
    
    include("functions.php");
    //include("functions.php");
    session_start();

    // initialization of error for the "alert display function"
    $error=0;

    /* Test to check if the username enterded is right or not */ 
    if(isset($_POST['enter']))
    {  
        // if the user enters a username
        if($_POST['name'] != "")
        {  
            //we check if the caracters entered are allowed (figures and letters)
            if(ctype_alnum($_POST['name']))
            {
                //we check if this username is not already used
                    //if this username doesn't exist for the moment
                if(user_search($_POST['name'])==0)
                {
                    $error=0;
                    $name = stripslashes(htmlspecialchars($_POST['name']));
                    setcookie('LastName', $name, time()+3600);
                    $_SESSION['name'] = $name;
                    header("location: chat_english.php") ;
                }
                else  // the username already exists, so the user must find another one
                {
                    $error=1;
                }
            }
            else // the user used unauthorized caracters, so he must enter an other username with allowed caracters
            {
                $error=3;
                //le pseudo rentré comporte des charactère interdits :()
            }
        }  
        else
        {  
            $error=2;
        }  
    }  

    //if the user press the button "francais", we change page for "index.php"
    if(isset($_POST['francais']))
    {
        setcookie('lang', "french", time()+3600);
        header("location: index.php");
    }


?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
    <head>  
        <title> Chat Home Page </title>  
        <link type="text/css" rel="stylesheet" href="mystyle.css" />  
    </head> 


        <!-- Displays the languages choices -->
        <div id="colonne1" class="panel panel-info" id="lg_choice"> 
            <div class="panel-heading">Language Choice</div>
              <div class="panel-body">
                    <form class="form-signin" role="form" action="index_english.php" method="post">
                        <h2 class="form-signin-heading">  </h2>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="francais" id="francais">Fran&ccedil;ais</button>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="english" id="english">English</button>
                    </form>
              </div>
            </div> 
        </div> 



    <!-- Sign In Form -->
    <div id="centre">
        <div id="loginform" class="container"> 

            <form class="form-signin" role="form" action="index_english.php" method="post">
                <h2 class="form-signin-heading"> Welcome on the ZZchat! </h2>

                <input type="text" class="form-control" 
                        placeholder="Pseudo" required="" autofocus="" 
                            name="name" id="name" value="<?php if(isset($_COOKIE['LastName'])) 
                                                                { 
                                                                    echo $_COOKIE['LastName']; 
                                                                } ?>">
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="enter" id="enter">Sign in</button>
              </form>
        </div> 
    </div> 

    <br>
    <br>
    <br>

    <!-- Error messages alerts -->
    <div>
        <?php 
        if($error==1)
        { ?>
            <div id="infopseudo">
                <a href="#" >
                    <strong>The username already exists :</strong>  Please find a different one :)
                </a>
            </div>
        <?php
        }
        if($error==2)
        {  ?>
            <div id="infopseudo">
                <a href="#" >
                   <strong> Please give a username </strong>
                </a>
            </div>
        <?php
        }
        if($error==3)
        {  ?>
            <div id="infopseudo">
                <a href="#" >
                   <strong> Please only use letters and/or figures for your username </strong>
                </a>
            </div>
        <?php
        }
        ?>
    </div>

</html>


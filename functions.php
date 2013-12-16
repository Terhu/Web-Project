<?php
    //Function that reads the file of name and compare it to the user name
    //returns 0 if the name is not used and writes it int he pseudo file, 
    //1 if it is
    function user_search($identifiant)
    {
        // we add the "\n" caracter in order to compare the strings
        $identifiant="<p>".$identifiant."</p>\n";

        //opening of the file in both write and read mode 
        $fichier=fopen('pseudo.txt','r+');
        
        // if the opening is a sucess
        if($fichier)
        {
            //while we're not at the end of the file and we didn't find the same username
            $trouve=1;
            while(!feof($fichier) and $trouve!==0)
            {
                // we read the current file
                $buffer = fgets($fichier);
                //compare it to the username
                $trouve = strcmp($identifiant,$buffer);
            } 
            
            //if the username wasn't found in the file
                //lthen the username fits, and it can be used
            if($trouve!=0)
            {
                $retval=0;
                // the user is registered, and his/her username is written
                user_inscription($identifiant, $fichier);
            }
            else // else, the username doesn't fit (it's already used)
            {
                $retval=1;
            }
        
            // file closing
            fclose($fichier);   
        } 
        
        return $retval;
    }
    
    
    //Function that writes the name of new users
    function user_inscription($identifiant, $fichier)
    {
        //write the new username at the end of the file
        fwrite($fichier,$identifiant);
    }


	//Function that delete the username of a user to disconnect him/her
    function user_delete($identifiant)
    {
		 $name=$identifiant;
        //on rajoute l'antislash n pour la comparaison des chaînes
        $identifiant="<p>".$identifiant."</p>\n";

        $data=file('pseudo.txt');
        $out = array();

        foreach($data as $line) 
        {
            if($line != $identifiant) 
            {
                $out[] = $line;
            }
        }       

		$retval=1;

        $file = fopen("pseudo.txt", "w+");
        flock($file, LOCK_EX);
        foreach($out as $line) 
        {
            fwrite($file, $line);
        }
        flock($file, LOCK_UN);
        fclose($file);
        

        return $retval; 
    }

?>

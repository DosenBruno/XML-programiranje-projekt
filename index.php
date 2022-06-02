<?php
$pr = true;
$username= "";
$pass= "";

$notice_usern = "";
$notice_pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["username"]))  {
            $notice_usern = "Korisničko ime nije uneseno.";
            $pr = false;
            
            }
	    if (empty($_POST["pass"]))  {
        	$notice_pass = "Lozinka nije unesena.";
            $pr = false;
		
    		}

	if($pr) {
        $username= $_POST["username"];
		$pass= $_POST["pass"];       
        $xml = simplexml_load_file('users.xml');
	
		provjera($username, $pass, $xml);
	}

}

function provjera($username, $pass, $xml) {
    $x = 0;
    $i = 0;

    global $notice_pass;
    global $notice_usern;
	foreach ($xml->user as $usr) {
        
        $i++;
        $info = $usr->basic_info;
        $usrn = $info->username;
		$usrp = $info->pass;
		if(strcmp($usrn, $username) == 0){
            if(strcmp($usrp, $pass) == 0) {
                header('Location: book_collection.xml');
            }
            
            else {
                $notice_pass = 'Lozinka je pogrešna';
            }
            
			}
            else {
                $x++;
            }        
		}

        if($i === $x) {
            $notice_usern = 'Korisničko ime ne postoji';
        }

	return;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <title>Bookstop</title>
    </head>
    <body class="login">
        <div class="container">
            <div class="row form-group vh-100 align-items-center justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 my-auto">
                    <div class="box-container">
                        <h1 class="h2 text-center mb-4">Dobrodošli natrag!</h1>

                        <form action="" method="post">

                            <div class="form-group">
                            <label for="username" class="mt-2 mb-2">Korisničko ime</label>
                            <input type="text" class="form-control" id="username" name="username">
                            <span class="error" id="username_error"><?php echo $notice_usern?></span>
                            </div>

                            <div class="form-group">
                            <label for="pass" class="mb-2 mt-2">Lozinka</label>
                            <input type="password" class="form-control" id="pass" name="pass">
                            <span class="error" id="pass_error"><?php echo $notice_pass;?></span>
                            </div>

                            <div class="container-fluid">
                                <input type="submit" name="submit" id="submit" value="Prijava" class="btn btn-dark col-12 mt-4">
                            </div>
                        </form>

                        <a href="signup.php" class="signup"><p>Registriraj se</p></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

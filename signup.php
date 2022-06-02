<?php

$name = "";
$lastname= "";
$email= "";
$username= "";
$pass= "";
$pass2= "";
$year = 0;
$reg = true;

$notice_name= "";
$notice_lastname = "";
$notice_email = "";
$notice_usern = "";
$notice_pass = "";
$notice_pass2 = "";
$notice_year = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["name"]))  {
        	$notice_name = "Ime nije uneseno.";
            $reg = false;
		
    		}
        if (empty($_POST["lastname"]))  {
            $notice_lastname = "Prezime nije uneseno.";
            $reg = false;
            
            }
        if (empty($_POST["email"]))  {
            $notice_email = "E-mail adresa nije unesena.";
            $reg = false;
            
            }
        if (empty($_POST["username"]))  {
            $notice_usern = "Korisničko ime nije uneseno.";
            $reg = false;
            
            }
	    if (empty($_POST["pass"]))  {
        	$notice_pass = "Lozinka nije unesena.";
            $reg = false;
		
    		}
        if (empty($_POST["pass2"]))  {
            $notice_pass2 = "Ponovite lozinku.";
            $reg = false;

            }
        else if($_POST['pass2'] != $_POST['pass']) {
            $notice_pass2 = "Lozinke moraju biti iste.";
            $reg = false;
            
            }
            
        if ($_POST["year"] > 2006)  {
            $notice_year = "Morate biti stariji od 15 godina.";
            $reg = false;
            
            }
        else if(empty($_POST['year'])) {
            $notice_year = "Godina rođenja nije unesena";
            $reg = false;

        }

	if($reg) {
        $name = $_POST['name'];
        $lastname= $_POST['lastname'];
        $email= $_POST['email'];
        $username= $_POST["username"];
		$pass= $_POST["pass"];       
        $year = $_POST['year'];
        $xml = simplexml_load_file('users.xml');
	
		provjera($name, $lastname, $email, $username, $pass, $year, $xml);
	}

}

function provjera($name, $lastname, $email, $username, $pass, $year, $xml) {
    $provjera = true;
    global $notice_email;
    global $notice_usern;
	foreach ($xml->user as $usr) {
        $info = $usr->basic_info;
        $usrn = $info->username;
		$usem = $info->email;
		if(strcmp($usrn, $username) == 0){
			$notice_usern = "Korisničko ime je zauzeto.";
            $provjera = false;
            
			}
        if(strcmp($usem, $email) == 0) {
            $notice_email = "E-mail adresa je povezana s postojećim računom.";
            $provjera = false;
        }
        
		}

        if($provjera === true) {
            signup_user($name, $lastname, $email, $username, $pass, $year, $xml);
        }

	return;
}

function signup_user($name, $lastname, $email, $username, $pass, $year, $xml) {

    $user = $xml->addChild("user");
    $info_xml = $user->addChild("basic_info");
    $name_el = $info_xml->addChild('name', $name);
    $lastname_el = $info_xml->addChild('lastname', $lastname);
    $username_el = $info_xml->addChild('username', $username);
    $email_el = $info_xml->addChild('email', $email);
    $pass_el = $info_xml->addChild('pass', $pass);
    $year_el = $info_xml->addChild('year', $year);

    $xml->saveXML('users.xml');
  


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
            <div class="row form-group vh-100">
                <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 my-auto">
                    <div class="box-container">
                        <h1 class="h2 text-center mb-4">Pridruži nam se</h1>

                        <form action="" method="post">
                            <div class="form-group">
                            <label for="name" class="mt-2 mb-2">Ime</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <span class="error" id="name_error"><?php echo $notice_name;?></span>
                            </div>

                            <div class="form-group">
                            <label for="lastname" class="mt-2 mb-2">Prezime</label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                            <span class="error" id="lastnamename_error"><?php echo $notice_lastname;?></span>
                            </div>

                            <div class="form-group">
                            <label for="email" class="mt-2 mb-2">E-mail adresa</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <span class="error" id="email_error"><?php echo $notice_email;?></span>
                            </div>

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

                            <div class="form-group">
                            <label for="pass2" class="mb-2 mt-2">Ponovljena lozinka</label>
                            <input type="password" class="form-control" id="pass2" name="pass2">
                            <span class="error" id="pass2_error"><?php echo $notice_pass2;?></span>
                            </div>

                            <div class="form-group">
                            <label for="year" class="mb-2 mt-2">Godina rođenja</label>
                            <input type="number" class="form-control" id="year" name="year">
                            <span class="error" id="year_error"><?php echo $notice_year;?></span>
                            </div>

                            <div class="container-fluid">
                                <input type="submit" name="submit" id="submit" value="Registracija" class="btn btn-dark col-12 mt-4">
                            </div>
                        </form>

                        <a href="index.php" class="signup"><p>Natrag na prijavu</p></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

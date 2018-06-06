<?php
    //Message variables
    $msg = "";
    $msgClass = "";
    //check for submit
    if(filter_has_var(INPUT_POST, "submit")){
        //Test: echo "Submitted!";
        //get the data from the form
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $subject = htmlspecialchars($_POST["subject"]);
        $message = htmlspecialchars($_POST["message"]);

        //Check required fields
        //if the felds are not empty
        if(!empty($name) && !empty($email) && !empty($message)){
            //passed
            //Test: echo "Passed!";
            //check email
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE ){
                //failed 
                $msg = "<p>Please enter correct email.</p>";
                $msgClass = "alert-danger";
            } else {
                //passed
                // echo "Passed!";
                //set up recipient email
                $toEmail = "milan.webdeveloper@gmail.com";
                //email subject
                $eMailsubject = "Subject:" .$subject;
                //email body

                $body = "<h2>Contact Request</h2>
                        <h5>Name: <h5><p>".$name."</p>
                        <h5>Email: <h5><p>".$email."</p>
                        <h5>Subject: <h5><p>".$subject."</p>
                        <h5>Message: <h5><p>".$message."</p>";

                //email headers
                $headers = "MIME-Version 1.0" ."\r\n";
                $headers .=  "Content-Type:text/html; charset=UTF-8" . "\r\n";

                //additional header //from
                $headers .= "From: " .$name. "<" .$email. ">". "\r\n";
                //mail function
                if(mail($toEmail, $eMailsubject, $body, $headers)){
                    //email Sent
                    $msg = "<p>Your email has been sent.</p>";
                    $msgClass = "alert-success";
                } else {
                    //email failed
                    $msg = "<p>Your Email was not sent.</p>";
                    $msgClass = "alert-danger";
                }
            }
        } else {
            //failed
            $msg = "<p>Please fill in all fields.</p>";
            $msgClass = "alert-danger";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Google Fonts | Roboto -->
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <!-- Font Awesome -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="icons/fontawesome-free-5.0.9/web-fonts-with-css/css/fontawesome-all.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Milan | FrontEnd WebDev</title>
</head>
<body>
  <div class="nav-bar">
    <a href="index.html" class="logo" id="logo">M</a>
    <!-- NavBar -->
    <nav>
      <a href="index.html">Home</a>
      <a href="about.html">About</a>
      <a href="work.html">Work</a>
      <a href="contact.html">Contact</a>
    </nav>
    <!-- NavBar Social -->
    <ul>
      <li><a href="https://github.com/MistikOne" target="_blank">GitHub</a></li>
      <li><a href="https://www.linkedin.com/in/milan-stanojlovic-5a5379107/"
        target="_blank">LinkedIn</a></li>
      </ul>
    </div>
    <!-- Mobile navigation -->
    <div class="mobile-nav">
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="work.html">Work</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
    </div>
    <!-- Contact Page -->
    <div class="contactpage">
      <div class="container">
        <div class="container-l">
          <section class="text-about">
            <h2>CONTACT ME</h2>
            <br>
            <p>If you have any questions or projects you would like me to work on, please don't hesitate to contact me
              <br>
            <i class="fas fa-at fa-lg email-icon"></i> <a class="mail" href="mailto:milan.webdeveloper@gmail.com" target="_blank">milan.webdeveloper@gmail.com</a></p>
          </section>
          <!-- Contact Form -->
          <div class="form-container">  
              <!-- Test for Message -->
                <?php if($msg != ""): ?>
                    <div class="alert <?php echo $msgClass ?>">
                        <?php echo $msg ?>
                    </div>
                <?php endif; ?>

              <form id="contact" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <fieldset>
                  <input placeholder="Your name" type="text" name="name" tabindex="1"  autofocus value="<?php echo isset($_POST["name"]) ? $name : "" ?>">
                </fieldset>
                <fieldset>
                  <input placeholder="Your Email Address" type="email" name="email" tabindex="2" value="<?php  echo isset($_POST["email"]) ? $email : "" ?>">
                </fieldset>
                <fieldset>
                  <input placeholder="Subject" type="text" name="subject" tabindex="4" value="<?php  echo isset($_POST["subject"]) ? $subject : "" ?>" >
                </fieldset>
                <fieldset>
                  <textarea placeholder="Type your Message Here..." name="message" tabindex="5" ><?php echo isset($_POST["message"]) ? $message : "" ?></textarea>
                </fieldset>
                <fieldset>
                  <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Send</button>
                </fieldset>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

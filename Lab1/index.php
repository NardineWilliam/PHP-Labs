<?php
require_once("config.php");

$name = isset($_POST["name"])?$_POST["name"]:"";
$email = isset($_POST["email"])?$_POST["email"]:"";
$message = isset($_POST["message"])?$_POST["message"]:"";

if(isset($_POST["submit"]))
{
    //form is  triggered
    if (empty($name) || strlen($name) > max_name_length) {
        $error_message = 'Invalid name';
        echo $error_message;
        echo '<br>';
    }
   
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Invalid email';
        echo $error_message;
        echo '<br>';
    }

    if (empty($message) || strlen($message) > max_message_length) {
        $error_message = 'Invalid message';
        echo $error_message;
        echo '<br>';
    } 

    
if (!isset($error_message)) {
    echo '<p><b>' . success_message . '</b></p>';
    echo '<p><b>Name: </b>' . $name . '</p>';
    echo '<p><b>Email: </b>' . $email . '</p>';
    echo '<p><b>Message: </b>' . $message . '</p>';
    exit();
} 
}
?>


<html>
    <head>
        <title> contact form </title>
    </head>

    <body>
        <h3> Contact Form </h3>
        <div id="after_submit">
            
        </div>
        <form id="contact_form" action="#" method="POST" enctype="multipart/form-data">

            <div class="row">
                <label class="required" for="name">Your name:</label><br />
                <input id="name" class="input" name="name" type="text" value="<?php echo $name?>" size="30" /><br />

            </div>
            <div class="row">
                <label class="required" for="email">Your email:</label><br />
                <input id="email" class="input" name="email" type="text" value="<?php echo $email?>" size="30" /><br />

            </div>
            <div class="row">
                <label class="required" for="message">Your message:</label><br />
                <textarea id="message" class="input" name="message" rows="7" cols="30"><?php echo $message?></textarea><br />

            </div>

            <input id="submit" name="submit" type="submit" value="Send email" />
            <input id="clear" name="clear" type="reset" value="clear form" />

        </form>
    </body>

</html>


<?php
    session_start();
    clearstatcache();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //GET GLOBAL VARIABLES
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/vendor/autoload.php';

    

    //READ THE POST REQUESTS
    $reCaptchaToken = $_POST['recaptcha_token'];
    $name      = filter_var($_POST["modalName"], FILTER_SANITIZE_STRING);
    $email     = filter_var($_POST["modalEmail"], FILTER_SANITIZE_EMAIL);
    $country_code     = $_POST["modalCountryCode"];
    $phone     = $_POST["modalPhone"];
    $message   = filter_var($_POST["modalMsg"], FILTER_SANITIZE_STRING);
    $field_ip = $_SERVER['REMOTE_ADDR'];


    
    //VALIDATE THE POST REQUESTS
    if(empty($name)) {$empty[] = "Name";}
    if(empty($email)) {$empty[] = "Email";}
    if(empty($country_code)) {$empty[] = "Country Code";}
    if(empty($phone)) {$empty[] = "Phone Number";}
    if(empty($message)) {$empty[] = "Message";}

    //RECTIFY THE INPUTS FOR SQL/PYTHON INJECTION
    $forbiddenWords = '/\b(select|update|eval|delete|insert|drop|alter|truncate)\b/i'; // Regular expression for keywords (case-insensitive)
    if (preg_match($forbiddenWords, $name)) {$empty[] = urlencode("Invalid request");}
    if (preg_match($forbiddenWords, $message)) {$empty[] = urlencode("Invalid request");}
    if (preg_match($forbiddenWords, $phone)) {$empty[] = urlencode("Invalid request");}
    if (preg_match($forbiddenWords, $country_code)) {$empty[] = urlencode("Invalid request");}

    //RECTIFY THE INPUTS BASED ON LENGHT
    if(strlen($name) > 35){$empty[] = urlencode("Invalid name length");}
    if(strlen($phone) > 15){$empty[] = urlencode("Invalid name length");}
    if(strlen($message) > 150){$empty[] = urlencode("Invalid message length");}
    if(strlen($email) > 40){$empty[] = urlencode("Invalid email length");}


    //RETURN ANY INVALIDATION
    if(!empty($empty)) {
        $referer = $_SERVER['HTTP_REFERER'];
        $output = json_encode(implode(", ", $empty));
        // header("Location: $referer.?ack_message=".urlencode($output));      
        header("Location: contact/index.php?ack_message=".urlencode($output));      
        exit;

    } else {

        //PRE-CONFIGURE RECAPTCHA VALIDATION
        $postArray = array(
            'secret' => Config::GOOGLE_RECAPTCHA_SECRET_KEY,
            'response' => $reCaptchaToken
        );
        $postJSON = http_build_query($postArray);

        //VERIFY THE RECAPTCHA
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postJSON);
        $response = curl_exec($curl);
        curl_close($curl);

        //GET RESPONSE AND VALIDATE THE RESPONSE
        $curlResponseArray = json_decode($response, true);

        if ($curlResponseArray["success"] == true && $curlResponseArray["score"] >= 0.5) {
            
            //MYSQL PRE-CONFIGURATION
            // $link = mysqli_connect("localhost", "root", "", "egycon_leads");
            $link = mysqli_connect("localhost", "edgerealty_2023", "QSUee-JW~8e=", "edgerealty_egycon_leads");
            
            //CHECK CONNECTION
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }
            
            //PREPARE SQL QUERY
            $sql = "INSERT INTO `leads` (`name` , `phone`, `country_code`, `email`,  `inquiry`, `ip`) VALUES (  '$name','$phone', '$country_code', '$email' , '$message' , '$field_ip')";

            //PROCESS THE SQL QUERY AND PERFORM BOOLEAN
            if(mysqli_query($link, $sql)){

                //OPEN THE MAILER FUNCTION
                $mail = new PHPMailer(true);

                try {
                    $mail->SMTPDebug = false;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'egycontracting.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'lead@egycontracting.com';                     //SMTP username
                    $mail->Password   = 'lead@egycon@1315';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;   

                    //Recipients
                    $mail->From = "info@egycontracting.com";
                    $mail->FromName = "EGYCON";
                    
                    $mail->addAddress("info@egycontracting.com", "EGYCON");                   


                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'EGYCON | Website Contact Page Inquiry';
                    $mail->Body    = ' <b>EGYCON | Website Contact Page Inquiry </b> 
                    <br><br> Name: '.$name.' 
                    <br><br> Country Code: '.$country_code.' 
                    <br><br> Phone: '.$phone.' 
                    <br><br> Email: '.$email.'
                    <br><br> Inquiry: '.$message.'
                    <br><br> IP Address: '.$field_ip;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $response = $mail->send();


                    //RETURN TO PAGE WITH SESSION STATUS
                    mysqli_close($link);
                    $_SESSION["ack_message"] = "success";
                    header("Location: thankyou.html");      
                    exit;          
                    
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

                $output = "success";
            
            } else{
                var_dump('error');
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }

            // mysqli_query($link, $sql);
            
            // Close connection
            mysqli_close($link);

            
            
        } else {
            $output = "Invalid request";
        }
        
        //RETURN TO PAGE WITH SESSION STATUS
        // $_SESSION["ack_message"] = $output;
        // header("Location: contact/");
    }
?>
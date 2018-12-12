<?php
if(isset($_POST['first_name']) && isset($_POST['address'])
&& isset($_POST['email']) && isset($_POST['quantity'])){
$first_name=$_POST['first_name'];
$address=$_POST['address'];
$email=$_POST['email'];
$quantity=$_POST['quantity'];
$bookname=$_POST['bookname'];
$bookid=$_POST['bookid'];


$to='lotuselizza@gmail.com';
$subject="New Order";
$body="<html>
            <body>
                <p>First Name:.$first_name.<br></p>
                <p>Address:.$address.<br></p>
                <p>Quantity:.$quantity.<br></p>
                <p>Book ID:.$bookid.<br></p>
                <p>Book Name:.$bookname.<br></p>
</body>
</html>";

    $headers  ="From:".$first_name."<".$email.">\r\n";
    $headers .="reply-To:".$email."\r\n";
    $headers .="NINE-Version: 1.0\r\n";
    $headers .="Content-type: text/html; charset=utf-8";


//confirmation mail
    $user=$email;
    $usersubject = "Book Catalogue";
    $userheaders = "From: lotuselizza@gmail.com\n";
    $usermessage = "Thank you for your order! We will connect you ASAP!!!";


//sending process
    $send=mail($to, $subject, $body, $headers);
    $confirm=mail($user, $usersubject, $userheaders,$usermessage );

    if($send && $confirm){
        include("thank_you_page.inc.php");
        echo "Sucses";
    }
    else{
        echo "Failed";
    }
}



<?php

if(isset($_POST['emailbtn'])) {

$email_to = "hmwiseneza@gmail.com";

$email_subject = "Summarized propose of the email";
$first_name = $_POST['first_name']; // required

$last_name = $_POST['last_name']; // required

$email_from = $_POST['email']; // required

$telephone = $_POST['telephone']; // not required

$comments = $_POST['comments']; // required

$error_message = "";
$email_message = "Form details below.\n\n";
$email_message .= "First Name: ".$first_name."\n";

$email_message .= "Last Name: ".$last_name."\n";

$email_message .= "Email: ".$email_from."\n";

$email_message .= "Telephone: ".$telephone."\n";

$email_message .= "Comments: ".$comments."\n";

// create email headers

$headers = 'From: '.$email_from."\r\n".

'Reply-To: '.$email_from."\r\n" .

'X-Mailer: PHP/' . phpversion();

@mail($email_to, $email_subject, $email_message, $headers);
}

?>

<html>
<form  method="post" action="#">

<table width="450px">

<tr>

<td valign="top">

 <label for="first_name">First Name *</label>

</td>

<td valign="top">

 <input  type="text" name="first_name" maxlength="50" size="30">

</td>

</tr>

<tr>

<td valign="top">

 <label for="last_name">Last Name *</label>

</td>

<td valign="top">

 <input  type="text" name="last_name" maxlength="50" size="30">

</td>

</tr>

<tr>

<td valign="top">

 <label for="email">Email Address *</label>

</td>

<td valign="top">

 <input  type="text" name="email" maxlength="80" size="30">

</td>

</tr>

<tr>

<td valign="top">

 <label for="telephone">Telephone Number</label>

</td>

<td valign="top">

 <input  type="text" name="telephone" maxlength="30" size="30">

</td>

</tr>

<tr>

<td valign="top">

 <label for="comments">Comments</label>

</td>

<td valign="top">

 <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>

</td>

</tr>

<tr>

<td colspan="2" style="text-align:center">

 <input type="submit" value="Submit" name="emailbtn"> 

</td>

</tr>

</table>

</form></html>
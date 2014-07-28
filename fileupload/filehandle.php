<?php
$uploadpath = "/home/frabe/fileupload/";
$path = "/var/www/kwarc/frabe/fileupload/";
$wwwpath = "http://kwarc.eecs.iu-bremen.de/frabe/fileupload/";
$email = "f.rabe@iu-bremen.de";
$subject = "Upload notification";

echo "<HTML>\n";
if ($_POST['delete'] == 1) {
	$command = "rm ".$uploadpath."*";
	echo "Executing: " . $command . "\n<br>Output follows.<br>\n";
	echo shell_exec($command);
}
else {
	$name = basename($_FILES['fileupload']['name']);
	if (move_uploaded_file($_FILES['fileupload']['tmp_name'],$uploadpath.$name)) {
		chmod($uploadpath.$name, 0644);
		echo "Upload successful<BR>\n";
		$text = $wwwpath . $name . "\n\nTo delete files go to " . $wwwpath . "filedelete.html";
		mail($email, $subject, $text, "From: Upload script <" . $email . ">");
	}
	else
		echo "Upload not successful\n";
}
echo "</HTML>\n";
?>
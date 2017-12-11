<?php
$to = "martinlightner@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: admin@camphum.org";

mail($to,$subject,$txt,$headers);
?>
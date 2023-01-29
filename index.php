<?php


include 'phpqrcode/qrlib.php';

function clean($string) {
    $string = str_replace(' ', '-', $string);
 
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
 }

if (isset($_POST['submit'])){

$text1 = $_POST['qr_info'];  
$text = clean($text1);
$path = 'images/';
$file = $path.$text.".png";

if (empty($text)) {
echo "Digite um valor válido!";
}else{
QRcode::png($text1, $file, 'L', 7);
}
}


if(isset($_GET['qrcode']))
{
//Read the filename
$filename = $_GET['qrcode'];
//Check the file exists or not
if(file_exists($filename)) {

//Define header information
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");
header('Content-Disposition: attachment; filename="'.basename($filename).'"');
header('Content-Length: ' . filesize($filename));
header('Pragma: public');

//Clear system output buffer
flush();

//Read the size of the file
readfile($filename);

//Terminate from the script
die();
}
else{
echo "File does not exist.";
}
}
?>


<!DOCTYPE html>
<html lang="en">
    <style>html {
	zoom: 125%;
}</style>
    
    <style media="print">
        @page {
         size: auto;
         margin: 0;
              }
       </style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.5">
    <title>QrCode</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<h1 class="Tittle">Qr Code Generator</h1>
    <form method="post" action="index.php" class="input_form">
            <input type="text" name="qr_info" class="enco_input">
            <button type="submit" name="submit" id="add_btn" class="add_btn">Gerar</button>
        </form>
<?php  

if (isset($_POST['submit'])){ 
    if (empty($text)) {
       
    }else{
        echo "<center><img src='".$file."'></center>
        <center><p><a style='color: black;text-decoration: none; padding: 5px; border: 1px solid black; ' href='index.php?qrcode=".$file."'>Download</a></p></center>";
    }

}?>

</body>
</html>

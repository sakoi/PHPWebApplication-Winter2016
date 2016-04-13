<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>save upload</title>
</head>
<body>

<?php
//file details
$name = $_FILES['any file']['name'];
echo "Name: $name<br />";

$size = $_FILES['any file']['size'];
echo "Size: $size";

$type = $_FILES['any file']['type'];
echo "Type: $type";

$tmp =$_FILES['any file']['tmp'];
    echo "Tmp: $tmp";

//unique name

$final_name = session_id(). '-'. $name;
echo $final_name;
//copy from temp
move_uploaded_file($tmp, "upload/$tmp");

//show if img
if($type == 'image/jpeg') {
    echo '<img src="upload/'. $final_name . '" />';
}

?>

</body>
</html>
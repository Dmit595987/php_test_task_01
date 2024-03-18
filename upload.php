<?php
$targetDir = 'files/';
if(isset($_FILES['file'])){
    $targetFile = $targetDir . basename($_FILES['file']['name']);
$uploadOk = true;

if($_FILES['file']['type'] !== 'text/plain'){
    echo "Sorry, your file is not format TXT<br>";
    $uploadOk = false;
}
if ($_FILES['file']['size'] > 500000) {
    echo "Sorry, your file is too large<br>";
    $uploadOk = false;
}


if ($uploadOk) {
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        echo "<div class='success'></div>";
    } else {
        echo "<div class='error'></div>";
    }
}
if($uploadOk){
    $fileContent = file_get_contents($targetFile);
    $lines = explode("\n", $fileContent);
    foreach ($lines as $line) {
        preg_match_all("/\d/", $line, $matches);
        echo  htmlspecialchars($line) . ' = ' . count($matches[0]) . "<br>";
}
}

}

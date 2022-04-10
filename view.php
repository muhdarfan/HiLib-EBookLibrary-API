<?php 
if(isset($_GET['file'])) {
    $FilePath = "docup/" . $_GET['file'];    
    if (file_exists($FilePath) && is_file($FilePath)) {
        header("Content-type: application/pdf"); 
        header('Content-Disposition: inline; filename="' . $_GET['file'] . '"'); 
        header("Content-Length: " . filesize($FilePath)); 
        readfile($FilePath);
    } else {
        die("File not found.");
    }
}
?>  
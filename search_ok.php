<?php

$category = $_POST['category'];
$search = $_POST['search'];
$word = $_POST['search_word'];
echo $category;
header("Location: search.php?category=$category&search=$search&word=$word"); 

?>
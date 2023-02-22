<?php

$category = $_POST['category'];
$search = $_POST['search'];
$word = htmlspecialchars($_POST['search_word'], ENT_QUOTES);

echo $category;
header("Location: search.php?category=$category&search=$search&word=$word"); 

?>
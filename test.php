

<?php
require_once('./Emoji.php');
//encode
$text = '😄';
echo Emoji::Encode($text);
//decode
$text='\ud83d\ude04,hi';
echo Emoji::Decode($text);
?>
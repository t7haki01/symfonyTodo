<?php $view->extend('layout.html.php'); ?>
    <h1>This is for test exercise</h1>
    <p>Is this working?</p>

<?php
for($i = 0; $i<count($data); $i++)
{
    echo "<p>".$data[$i].'</p>';
}
?>

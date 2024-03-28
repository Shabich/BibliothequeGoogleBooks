<?php

try
{
    $db = new PDO('mysql:host=localhost;dbname=tutoriel', 'USER', 'PASS');
}
catch (PDOException $e)
{
    print('Erreur : ' . $e->getMessage() . "<br/>");
}
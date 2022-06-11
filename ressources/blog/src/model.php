<?php
// src/model.php

// Nouvelle fonction qui nous permet d'éviter de répéter du code
function dbConnect()
{
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');

    return $database;
}

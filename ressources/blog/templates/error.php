<?php $title = "Le blog de l'AVBN"; ?>

<?php ob_start(); ?>
<h1>Ceci est ma page d'exception</h1>

<?= $errorMessage; ?>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
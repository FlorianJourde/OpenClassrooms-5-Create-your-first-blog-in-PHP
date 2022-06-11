<?php

class Comment2
{
  public string $author;
  public string $frenchCreationDate;
  public string $comment;
}

$comment = new Comment2();
$comment->author = 'Auteur';
$comment->frenchCreationDate = '10/03/2022 à 15h09';
$comment->comment = 'Commentaire';
$comment->author = 'Nouvel auteur';

//var_dump($comment->author);
//var_dump($comment);

function test(Comment2 $comment)
{
  var_dump($comment);
}
test($comment);

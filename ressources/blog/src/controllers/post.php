<?php
// controllers/post.php

//require_once('src/model.php');
require_once('src/model/comment.php');
//require_once('src/model/post.php');

function post(string $identifier)
{
  $postRepository = new PostRepository();
  $post = $postRepository->getPost($identifier);
//  $post = $postRepository->getPost($identifier);
  $comments = getComments($identifier);
//  $post = getPost($identifier);
//  $comments = getComments($identifier);

  require('templates/post.php');
}

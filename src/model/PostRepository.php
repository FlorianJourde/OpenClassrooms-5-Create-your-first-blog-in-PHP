<?php

namespace Application\Model;

require_once('src/lib/database.php');
require_once('src/controllers/post.php');

use Application\Lib\Database\DatabaseConnection;

class PostRepository
{
    public DatabaseConnection $connection;

    public function getPost(string $identifier): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $post = new Post();
        $post->title = $row['title'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->content = $row['content'];
        $post->identifier = $row['id'];

        return $post;
    }

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
        );
        $posts = [];
        while (($row = $statement->fetch())) {
            $post = new Post();
            $post->title = $row['title'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->content = $row['content'];
            $post->identifier = $row['id'];

            $posts[] = $post;
        }

        return $posts;
    }

    public function createPost(string $user_id, string $title, string $content, bool $status): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO posts(user_id, title, content, creation_date, update_date, status) VALUES (?, ?, ?, NOW(), NOW(), ?)"
        );

        $affectedLines = $statement->execute([$user_id,  $title, $content, $status]);

//        var_dump($statement);
//        die();

//        $row = $statement->fetch();
//        $post = new Post();
//        $post->title = $row['title'];
//        $post->frenchCreationDate = $row['french_creation_date'];
//        $post->content = $row['content'];
//        $post->identifier = $row['id'];

        return ($affectedLines > 0);
    }
}

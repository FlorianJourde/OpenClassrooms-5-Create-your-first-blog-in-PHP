<?php

namespace Application\Model;

use Application\Lib\DatabaseConnection;

class PostRepository
{
    public DatabaseConnection $connection;

    public function getPost(int $identifier): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, user_id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $post = new Post();
        $post->title = $row['title'];
        $post->author = $row['user_id'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->content = $row['content'];
        $post->identifier = $row['id'];

        return $post;
    }

    public function deletePost(int $identifier): bool
    {
        if (!is_int($identifier)) { return false; }

        $statement = $this->connection->getConnection()->prepare(
            "DELETE posts, comments FROM posts INNER JOIN comments ON posts.id = comments.post_id WHERE posts . id = ?"
        );

        $affectedLines = $statement->execute([$identifier]);

        return ($affectedLines > 0);
    }

    public function updatePost(int $identifier, string $content, string $title): bool
    {
        if (!is_int($identifier)) { return false; }

        $statement = $this->connection->getConnection()->prepare(
            'UPDATE posts SET content = ?, title = ? WHERE id = ?'
        );
        $affectedLines = $statement->execute([$content, $title, $identifier]);

        return ($affectedLines > 0);
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

        return ($affectedLines > 0);
    }
}

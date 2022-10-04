<?php

namespace Application\Model;

use Application\Lib\DatabaseConnection;

class PostRepository
{
    public DatabaseConnection $connection;

    private function fetchPost($row): ?Post
    {
        $post = new Post();
        $post->title = $row['title'];
        $post->userId = $row['user_id'];
        $post->creationDate = $row['creation_date'];
        $post->content = $row['content'];
        $post->identifier = $row['id'];
        
        return $post;
    }

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, content, user_id, DATE_FORMAT(creation_date, '%d/%m/%Y à %H:%i:%s') AS creation_date FROM posts ORDER BY id DESC"
        );

        $posts = [];

        while ($row = $statement->fetch()) {
            $post = $this->fetchPost($row);
            $posts[] = $post;
        }

        return $posts;
    }

    public function getPost(int $identifier): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, user_id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %H:%i:%s') AS creation_date FROM posts WHERE id = ?"
        );

        $statement->execute([$identifier]);
        $row = $statement->fetch();
        $post = $this->fetchPost($row);

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

    public function createPost(int $userId, string $title, string $content, bool $status): bool
    {
        if (!is_int($userId)) { return false; }

        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO posts(user_id, title, content, creation_date, update_date, status) VALUES (?, ?, ?, NOW(), NOW(), ?)"
        );

        $affectedLines = $statement->execute([$userId,  $title, $content, $status]);

        return ($affectedLines > 0);
    }
}

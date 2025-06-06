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
        $post->creationTime = $row['creation_time'];
        $post->content = $row['content'];
        $post->identifier = $row['id'];
        $post->image = $row['image'];
        
        return $post;
    }

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, content, user_id, DATE_FORMAT(creation_date, '%d/%m/%Y') AS creation_date, DATE_FORMAT(creation_date, '%H:%i') AS creation_time, image FROM posts ORDER BY id DESC"
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
            "SELECT id, user_id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y') AS creation_date, DATE_FORMAT(creation_date, '%H:%i') AS creation_time, image FROM posts WHERE id = ?"
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
            "DELETE FROM posts WHERE posts.id = ? ; DELETE FROM comments WHERE post_id = ?"
        );

        $affectedLines = $statement->execute([$identifier, $identifier]);

        return ($affectedLines > 0);
    }

    public function updatePost(int $identifier, string $content, string $title, ?string $imageName): bool
    {
        if (!is_int($identifier)) { return false; }

        $statement = $this->connection->getConnection()->prepare(
            'UPDATE posts SET content = ?, title = ?, image = ? WHERE id = ?'
        );

        $affectedLines = $statement->execute([$content, $title, $imageName, $identifier]);

        return ($affectedLines > 0);
    }

    public function createPost(int $userId, string $title, string $content, bool $status, ?string $imageName): bool
    {
        if (!is_int($userId)) { return false; }

        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO posts(user_id, title, content, creation_date, update_date, status, image) VALUES (?, ?, ?, NOW(), NOW(), ?, ?)"
        );

        $affectedLines = $statement->execute([$userId,  $title, $content, $status, $imageName]);

        return ($affectedLines > 0);
    }
}

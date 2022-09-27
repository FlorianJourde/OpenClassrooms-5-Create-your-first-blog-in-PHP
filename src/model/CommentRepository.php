<?php

namespace Application\Model;

require_once __ROOT__ . '/src/lib/database.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment;

class CommentRepository
{
    public DatabaseConnection $connection;

    private function fetchComment($row): ?Comment
    {
        $comment = new Comment();
        $comment->identifier = $row['id'];
        $comment->author = $row['author'];
        $comment->frenchCreationDate = $row['french_creation_date'];
        $comment->comment = $row['content'];
        $comment->post = $row['post_id'];

        return $comment;
    }

    public function getComments(string $post): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, content, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date, post_id FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
        );
        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())) {
            $comment = $this->fetchComment($row);

            $comments[] = $comment;
        }

        return $comments;
    }

    public function getComment(int $identifier): ?Comment
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, content, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date, post_id FROM comments WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }
//
        return $this->fetchComment($row);
    }

    public function createComment(string $post, string $author, string $comment, string $user_id, bool $status): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, author, content, user_id, status, comment_date) VALUES(?, ?, ?, ?, ?, NOW())'
        );

        $affectedLines = $statement->execute([$post, $author, $comment, $user_id, $status]);

        return ($affectedLines > 0);
    }

    public function updateComment(int $identifier, string $comment): bool
    {
//        if (!is_int($identifier)) { return false; }

        $statement = $this->connection->getConnection()->prepare(
            'UPDATE comments SET content = ? WHERE id = ?'
        );
        $affectedLines = $statement->execute([$comment, $identifier]);

        return ($affectedLines > 0);
    }

    public function deleteComment(int $identifier): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM comments WHERE id = ?'
        );
        $affectedLines = $statement->execute([$identifier]);

        return ($affectedLines > 0);
    }
}

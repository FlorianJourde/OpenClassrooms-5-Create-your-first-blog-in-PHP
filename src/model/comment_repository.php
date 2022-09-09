<?php

namespace Application\Model\CommentRepository;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\Comment;

/*class Comment
{
    public string $identifier;
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
    public string $post;
}*/

class CommentRepository
{
    public DatabaseConnection $connection;

    public function getComments(string $post): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, content, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date, post_id FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
        );
        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())) {
            $comment = new Comment();
            $comment->identifier = $row['id'];
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['content'];
            $comment->post = $row['post_id'];

            $comments[] = $comment;
        }

        return $comments;
    }

    public function getComment(string $identifier): ?Comment
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, content, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date, post_id FROM comments WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $comment = new Comment();
        $comment->identifier = $row['id'];
        $comment->author = $row['author'];
        $comment->frenchCreationDate = $row['french_creation_date'];
        $comment->comment = $row['content'];
        $comment->post = $row['post_id'];

        return $comment;
    }

    public function createComment(string $post, string $author, string $comment, string $user_id, bool $status): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, author, content, user_id, status, comment_date) VALUES(?, ?, ?, ?, ?, NOW())'
        );
//        var_dump($statement);
//        die();
        $affectedLines = $statement->execute([$post, $author, $comment, $user_id, $status]);

        return ($affectedLines > 0);
    }

    public function updateComment(string $identifier, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE comments SET content = ? WHERE id = ?'
        );
        $affectedLines = $statement->execute([$comment, $identifier]);

        return ($affectedLines > 0);
    }
}

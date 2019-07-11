<?php

namespace Ju\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, user_name, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute([$postId]);

        return $comments;
    }

    public function getComment($id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT post_id, id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $comment->execute([$id]);

        return $comment;
    }

    public function getUserComments($userId)
    {
        $db = $this->dbConnect();
        $userComments = $db->prepare('SELECT id, post_id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE user_id = ?');
        $userComments->execute([$userId]);

        return $userComments;
    }

    public function postComment($postId, $userId, $userName, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, user_id, user_name, comment, comment_date) VALUES(?, ?, ?, ?, NOW())');
        $affectedLines = $comments->execute([$postId, $userId, $userName, $comment]);

        return $affectedLines;
    }

    public function updateComment($id, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET comment = ? WHERE id = ?');
        $affectedLines = $comments->execute([$comment, $id]);

        return $affectedLines;
    }

}
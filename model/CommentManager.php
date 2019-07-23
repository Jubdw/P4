<?php

namespace Ju\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, user_id, user_name, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, blocked FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
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
        $comments = $db->prepare('INSERT INTO comments(post_id, user_id, user_name, comment, comment_date, reported, blocked) VALUES(?, ?, ?, ?, NOW(), "0", "0")');
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

    public function reportComment($id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('UPDATE comments SET reported = "1" WHERE id = ?');
        $affectedLines = $comment->execute([$id]);

        return $affectedLines;
    }

/* fonctions admin */

    public function countComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) as commentNb FROM comments');
        $data = $req->fetch();

        return $data;
    }

    public function getNoReportCommentsPaged($start, $perPage)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, user_id, user_name, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, blocked FROM comments WHERE reported = "0" ORDER BY id DESC LIMIT :start, :perPage');
        $req->bindValue('start', $start, \PDO::PARAM_INT);
        $req->bindValue('perPage', $perPage, \PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function getReportedComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, user_id, user_name, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, blocked FROM comments WHERE reported = "1"');

        return $req;
    }

    public function getBlockedComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, user_id, user_name, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, reported FROM comments WHERE blocked = "1"');

        return $req;
    }

    public function blockComment($id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('UPDATE comments SET blocked = "1" WHERE id = ?');
        $affectedLines = $comment->execute([$id]);

        return $affectedLines;
    }

    public function deBlockComment($id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('UPDATE comments SET blocked = "0" WHERE id = ?');
        $affectedLines = $comment->execute([$id]);

        return $affectedLines;
    }
}
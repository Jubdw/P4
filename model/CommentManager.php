<?php

namespace Ju\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getCommentsPaged($postId, $start, $perPage)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, user_id, user_name, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, blocked FROM comments WHERE post_id = :post_id ORDER BY comment_date DESC LIMIT :start, :perPage');
        $comments->bindValue('start', $start, \PDO::PARAM_INT);
        $comments->bindValue('perPage', $perPage, \PDO::PARAM_INT);
        $comments->bindValue('post_id', $postId, \PDO::PARAM_INT);
        $comments->execute();

        return $comments;
    }

    public function getComment($id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT post_id, id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $comment->execute([$id]);

        return $comment;
    }

    public function getUserCommentsPaged($userId, $start, $perPage)
    {
        $db = $this->dbConnect();
        $userComments = $db->prepare('SELECT c.id id, c.post_id post_id, c.comment comment, DATE_FORMAT(c.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, c.blocked blocked, p.title post_title FROM comments c INNER JOIN posts p ON c.post_id = p.id WHERE user_id = :user_id ORDER BY c.comment_date DESC LIMIT :start, :perPage');
        $userComments->bindValue('start', $start, \PDO::PARAM_INT);
        $userComments->bindValue('perPage', $perPage, \PDO::PARAM_INT);
        $userComments->bindValue('user_id', $userId, \PDO::PARAM_INT);
        $userComments->execute();

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

    public function countComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) as commentNb FROM comments');
        $data = $req->fetch();

        return $data;
    }

    public function countPostComments($postId)
    {
        $db = $this->dbConnect();
        $data = $db->prepare('SELECT COUNT(id) as commentNb FROM comments WHERE post_id = :post_id');
        $data->bindValue('post_id', $postId, \PDO::PARAM_INT);
        $data->execute();
        $count = $data->fetch();

        return $count;
    }

    public function countUserComments($userId)
    {
        $db = $this->dbConnect();
        $data = $db->prepare('SELECT COUNT(id) as commentNb FROM comments WHERE user_id = :user_id');
        $data->bindValue('user_id', $userId, \PDO::PARAM_INT);
        $data->execute();
        $count = $data->fetch();

        return $count;
    }

/* fonctions admin */

    public function getNoReportCommentsPaged($start, $perPage)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, user_id, user_name, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE blocked = "0" AND reported = "0" ORDER BY id DESC LIMIT :start, :perPage');
        $req->bindValue('start', $start, \PDO::PARAM_INT);
        $req->bindValue('perPage', $perPage, \PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function countReportedComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) as reportedCommentNb FROM comments WHERE reported = "1"');
        $data = $req->fetch();

        return $data;
    }

    public function getReportedCommentsPaged($start, $perPage)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, user_id, user_name, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, blocked FROM comments WHERE reported = "1" ORDER BY id DESC LIMIT :start, :perPage');
        $req->bindValue('start', $start, \PDO::PARAM_INT);
        $req->bindValue('perPage', $perPage, \PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function countBlockedComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) as blockedCommentNb FROM comments WHERE blocked = "1"');
        $data = $req->fetch();

        return $data;
    }

    public function getBlockedCommentsPaged($bStart, $bPerPage)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, user_id, user_name, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, reported FROM comments WHERE blocked = "1" ORDER BY id DESC LIMIT :start, :perPage');
        $req->bindValue('start', $bStart, \PDO::PARAM_INT);
        $req->bindValue('perPage', $bPerPage, \PDO::PARAM_INT);
        $req->execute();

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
        $comment = $db->prepare('UPDATE comments SET blocked = "1", reported = "0" WHERE id = ?');
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
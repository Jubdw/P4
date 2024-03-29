<?php

namespace Ju\Blog\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function countPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) as postsNb FROM posts');
        $data = $req->fetch();

        return $data;
    }

    public function getPostsPaged($start, $perPage)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, SUBSTRING(content, 1, 255) AS small_content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT :start, :perPage');
        $req->bindValue('start', $start, \PDO::PARAM_INT);
        $req->bindValue('perPage', $perPage, \PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function getSmallPostsPaged($start, $perPage)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT :start, :perPage');
        $req->bindValue('start', $start, \PDO::PARAM_INT);
        $req->bindValue('perPage', $perPage, \PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function getWelcomePosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, SUBSTRING(content, 1, 255) AS small_content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 2');

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute([$postId]);
        $post = $req->fetch();

        return $post;
    }

/* ------------------------------- ADMIN ---------------------------------- */
    public function addNewPost($title, $content)
    {
        $db = $this->dbConnect();
        $newPost = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())');
        $createNew = $newPost->execute([$title, $content]);
        
        return $createNew;
    }

    public function editPost($id, $title, $content)
    {
        $db = $this->dbConnect();
        $editedPost = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $affectedLines = $editedPost->execute([$title, $content, $id]);

        return $affectedLines;
    }

    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $deletedPost = $db->prepare('DELETE FROM posts WHERE id = ?');
        $affectedLines = $deletedPost->execute([$id]);

        return $affectedLines;
    }
}
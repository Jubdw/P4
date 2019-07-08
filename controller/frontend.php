<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new Ju\Blog\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new Ju\Blog\Model\PostManager();
    $commentManager = new Ju\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new Ju\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function update()
{
	$commentManager = new Ju\Blog\Model\CommentManager();

	$comment = $commentManager->getComment($_GET['id']);
	

	require('view/frontend/updateCommentView.php');
}

function changeComment($id, $author, $comment, $postId)
{
    $commentManager = new Ju\Blog\Model\CommentManager();

    $affectedLines = $commentManager->updateComment($id, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
    	$_SESSION['success'] = 'Le commentaire à bien été modifié';
        header('Location: index.php?action=post&id=' . $postId);
    }
}
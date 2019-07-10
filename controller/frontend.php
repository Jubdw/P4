<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

// fonction PostManager --------------------------------------------------------

function listPosts()
{
    $postManager = new Ju\Blog\Model\PostManager();
    $posts = $postManager->getPosts();

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

function welcomePosts()
{
    $postManager = new Ju\Blog\Model\PostManager();
    $posts = $postManager->getWelcomePosts();

    require('view/frontend/homeView.php');
}

// fonction CommentManager ---------------------------------------------------

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

// fonctions UserManager

function addUser($name, $password, $email)
{
    $userManager = new Ju\Blog\Model\UserManager();

    $checkUsers = $userManager->getUsers();
    while ($data = $checkUsers->fetch())
    {
        if ($_POST['name'] === $data['name'])
        {
            throw new Exception('Ce pseudo est déjà pris !');
        }
        elseif ($_POST['email'] === $data['email'])
        {
            throw new Exception('Cette adresse email est déjà associée à un compte !');
        }
    }

    $createNew = $userManager->createUser($name, $password, $email);

    if ($createNew === false) {
        throw new Exception('Impossible de créer l\'utilisateur !');
    }
    else {
        header('Location: index.php');
    }
}

// autres fonctions -------------------------------------------------------------
function register()
{
    require('view/frontend/registerView.php');
}

function about()
{
    require('view/frontend/aboutView.php');
}

function contact()
{
    require('view/frontend/contactView.php');
}
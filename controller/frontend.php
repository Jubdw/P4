<?php
use Ju\Blog\Model\PostManager;
use Ju\Blog\Model\CommentManager;
use Ju\Blog\Model\UserManager;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

// fonction PostManager --------------------------------------------------------

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function welcomePosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getWelcomePosts();

    require('view/frontend/homeView.php');
}

// fonction CommentManager ---------------------------------------------------

function addComment($postId, $userId, $userName, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $userId, $userName, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId . '#comment-section');
    }
}

function update()
{
	$commentManager = new CommentManager();

	$comment = $commentManager->getComment($_GET['id']);
	

	require('view/frontend/updateCommentView.php');
}

function updateComment($id, $comment, $postId)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->updateComment($id, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId . '#comment-section');
    }
}

// fonctions UserManager

function connect($name)
{
    $userManager = new UserManager();

    $checkPass = $userManager->connectUser($name);

    $isPassCorrect = password_verify($_POST['password'], $checkPass['password']);

    if (!$checkPass)
    {
        throw new Exception('Mauvais identifiant ou mot de passe');
    }
    else
    {
        if ($isPassCorrect) {
            $_SESSION['id'] = $checkPass['id'];
            $_SESSION['name'] = $name;
            header('Location: index.php');
        }
        else {
            throw new Exception('Mauvais identifiant ou mot de passe');
        }
    }
}

function disconnect()
{
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
}

function addUser($name, $password, $email)
{
    $userManager = new UserManager();

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

function profile()
{
    $userManager = new UserManager();
    $profile = $userManager->getUser($_GET['name']);

    $commentManager = new CommentManager();
    $userComments = $commentManager->getUserComments($profile['id']);

    if ($profile === false) {
        throw new Exception('Aucun membre enregistré avec ce nom !');
    }
    else {
        require('view/frontend/profileView.php');
    }
}

function editProfile()
{
    require('view/frontend/updateProfileView.php');
}

function updateName($id, $name)
{
    $userManager = new UserManager();

    $checkUsers = $userManager->getUsers();
    while ($data = $checkUsers->fetch())
    {
        if ($_POST['name'] === $data['name'])
        {
            throw new Exception('Ce pseudo est déjà pris !');
        }
    }


    $updateName = $userManager->editName($id, $name);

    if ($updateName === false) {
        throw new Exception('Impossible d\'effectuer la modification.');
    }
    else {
        $_SESSION['name'] = $name;
        header('Location: index.php?action=showProfile&name=' . $name);
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
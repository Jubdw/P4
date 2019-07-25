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

function post($page)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);

    $countC = $commentManager->countComments();
    $commentNb = $countC['commentNb'];
    $perPage = 6;
    $maxPages = ceil($commentNb/$perPage);
    if ($page <= $maxPages) {
        $currentPage = $page;
    }
    else {
        $currentPage = 1;
    }
    $start = (($currentPage - 1) * $perPage);

    $comments = $commentManager->getCommentsPaged($_GET['id'], $start, $perPage);

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
        header('Location: index.php?action=post&id=' . $postId . '&page=1#comment-section');
    }
}

function reportComment($id)
{
    $commentManager = new CommentManager();
    $reportedComment = $commentManager->reportComment($id);

    $req = $commentManager->getComment($id);
    $commentedPost = $req->fetch();

    if ($reportedComment === false) {
        throw new Exception('Impossible d\'effectuer la modification.');
    }
    else {
        header('Location: index.php?action=post&id=' . $commentedPost['post_id'] . '&page=1#comment-section');
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
            $_SESSION['status'] = $checkPass['status'];
            if ($checkPass['status'] == "admin") {
                header('Location: index.php?action=adminAccess');
            }
            elseif ($checkPass['status'] == "blocked") {
                $_SESSION = array();
                session_destroy();
                throw new Exception('Votre compte à été bloqué. Comportez-vous mieux !');
            }
            else {
                header('Location: index.php?action=showProfile&id=' . $_SESSION['id']);
            }
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
        $connectNewUser = $userManager->connectUser($name);
        $_SESSION['id'] = $connectNewUser['id'];
        $_SESSION['name'] = $name;
        $_SESSION['status'] = $connectNewUser['status'];
        header('Location: index.php?action=showProfile&id=' . $_SESSION['id']);
    }
}

function profile($page)
{
    $userManager = new UserManager();
    $profile = $userManager->getUser($_GET['id']);

    $commentManager = new CommentManager();
    $countC = $commentManager->countComments();
    $commentNb = $countC['commentNb'];
    $perPage = 8;
    $maxPages = ceil($commentNb/$perPage);
    if ($page <= $maxPages) {
        $currentPage = $page;
    }
    else {
        $currentPage = 1;
    }
    $start = (($currentPage - 1) * $perPage);

    $userComments = $commentManager->getUserCommentsPaged($_GET['id'], $start, $perPage);

    if ($profile === false) {
        throw new Exception('Ce membre n\'existe pas !');
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
        header('Location: index.php?action=showProfile&id=' . $id);
    }
}

function updateEmail($id, $email)
{
    $userManager = new UserManager();

    $checkUsers = $userManager->getUsers();
    while ($data = $checkUsers->fetch())
    {
        if ($_POST['email'] === $data['email'])
        {
            throw new Exception('Cet e-mail est déjà associé à un compte !');
        }
    }

    $updateEmail = $userManager->editEmail($id, $email);

    if ($updateEmail === fasle) {
        throw new Exception('Impossible d\'effectuer la modification.');
    }
    else {
        header('Location: index.php?action=showProfile&id=' . $id);
    }
}

function updatePassword($id, $password)
{
    $userManager = new UserManager();
    $updatePassword = $userManager->editPassword($id, $password);

    if ($updatePassword === fasle) {
        throw new Exception('Impossible d\'effectuer la modification.');
    }
    else {
        header('Location: index.php?action=showProfile&id=' . $id);
    }
}

// fonctions ADMIN --------------------------------------------------------------
function administer()
{
    require('view/backend/adminView.php');
}

/* -------------------------------------------------------------------------- USER ----- */
function blockedUser($id)
{
    $userManager = new UserManager();
    $blockedUser = $userManager->blockUser($id);

    if ($blockedUser === false) {
        throw new Exception('Impossible d\'effectuer la modification.');
    }
    else {
        header('Location: index.php?action=userManagement&page=1');
    }
}

function unblockUser($id)
{
    $userManager = new UserManager();
    $unblockedUser = $userManager->unblockUser($id);

    if ($unblockedUser === false) {
        throw new Exception('Impossible d\'effectuer la modification.');
    }
    else {
        header('Location: index.php?action=userManagement&page=1');
    }
}

function manageUser($page)
{
    $userManager = new UserManager();

    $countU = $userManager->countUsers();
    $userNb = $countU['userNb'];
    $perPage = 5;
    $maxPages = ceil($userNb/$perPage);
    if ($page <= $maxPages) {
        $currentPage = $page;
    }
    else {
        $currentPage = 1;
    }
    $start = (($currentPage - 1) * $perPage);

    $userManagement = $userManager->getUsersPaged($start, $perPage);

    require('view/backend/userManagementView.php');
}

/* -------------------------------------------------------------------------- POST ----- */
function smallPosts()
{
    $postManager = new PostManager();
    $posts_small = $postManager->getSmallPosts();

    require('view/backend/postManagementView.php');
}
function newPost()
{
    require('view/backend/createNewPostView.php');
}
function addPost($title, $content)
{
    $postManager = new PostManager();
    $newPost = $postManager->addNewPost($title, $content);

    if ($newPost === false) {
        throw new Exception('Impossible de créer le chapitre !');
    }
    else {
        header('Location: index.php?action=postManagement');
    }
}
function showPostToEdit($id)
{
    $postManager = new PostManager();
    $postToEdit = $postManager->getPost($id);

    require('view/backend/editPostView.php');
}
function editPost($id, $title, $content)
{
    $postManager = new PostManager();
    $postEdit = $postManager->editPost($id, $title, $content);

    if ($postEdit === false) {
        throw new Exception('Impossible de modifier le chapitre !');
    }
    else {
        header('Location: index.php?action=postManagement');
    }
}
function deletePost($id)
{
    $postManager = new PostManager();
    $deletePost = $postManager->deletePost($id);

    if ($deletePost === false) {
        throw new Exception('Impossible d\'effacer le chapitre !');
    }
    else {
        header('Location: index.php?action=postManagement');
    }
}
/* -------------------------------------------------------------------------- COMMENT ----- */
function listAdminComments($page)
{
    $commentManager = new CommentManager();
    
    $countC = $commentManager->countComments();
    $commentNb = $countC['commentNb'];
    $perPage = 10;
    $maxPages = ceil($commentNb/$perPage);
    if ($page <= $maxPages) {
        $currentPage = $page;
    }
    else {
        $currentPage = 1;
    }
    $start = (($currentPage - 1) * $perPage);

    $noReportComments = $commentManager->getNoReportCommentsPaged($start, $perPage);

    require('view/backend/commentManagementView.php');
}

function listAdminReportedComments($page, $bPage)
{
    $commentManager = new CommentManager();

    $countC = $commentManager->countReportedComments();
    $commentNb = $countC['reportedCommentNb'];
    $perPage = 8;
    $maxPages = ceil($commentNb/$perPage);
    if ($page <= $maxPages) {
        $currentPage = $page;
    }
    else {
        $currentPage = 1;
    }
    $start = (($currentPage - 1) * $perPage);

    $reportedComments = $commentManager->getReportedCommentsPaged($start, $perPage);



    $bCountC = $commentManager->countBlockedComments();
    $bCommentNb = $bCountC['blockedCommentNb'];
    $bPerPage = 8;
    $bMaxPages = ceil($bCommentNb/$bPerPage);
    if ($bPage <= $bMaxPages) {
        $bCurrentPage = $bPage;
    }
    else {
        $bCurrentPage = 1;
    }
    $bStart = (($bCurrentPage - 1) * $bPerPage);

    $blockedComments = $commentManager->getBlockedCommentsPaged($bStart, $bPerPage);

    require('view/backend/reportedCommentManagementView.php');
}

function blockComment($id)
{
    $commentManager = new CommentManager();
    $blockedComment = $commentManager->blockComment($id);

    if ($blockedComment === false) {
        throw new Exception('Impossible d\'effectuer la modification.');
    }
    elseif (isset($_GET['page']) && isset($_GET['bpage'])) {
        header('Location: index.php?action=reportedCommentManagement&page=' . $_GET['page'] . '&bpage=' . $_GET['bpage']);
    }
    else {
        header('Location: index.php?action=commentManagement&page=' . $_GET['page']);
    }
}

function deBlockComment($id)
{
    $commentManager = new CommentManager();
    $deBlockedComment = $commentManager->deBlockComment($id);

    if ($deBlockedComment === false) {
        throw new Exception('Impossible d\'effectuer la modification.');
    }
    elseif (isset($_GET['page']) && isset($_GET['bpage'])) {
        header('Location: index.php?action=reportedCommentManagement&page=' . $_GET['page'] . '&bpage=' . $_GET['bpage']);
    }
    else {
        header('Location: index.php?action=commentManagement&page=' . $_GET['page']);
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
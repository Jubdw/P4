<?php
session_start();

require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            if (isset($_GET['page']) && $_GET['page'] > 0) {
                listPosts($_GET['page']);
            }
            else {
                throw new Exception('Ne modifiez pas l\'url SVP');
            }
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['page']) && $_GET['page'] > 0) {
                post($_GET['page']);
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'update') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                update();
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['comment'])) {
                    addComment($_GET['id'], $_SESSION['id'], $_SESSION['name'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'updateComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['comment'])) {
                    updateComment($_GET['id'], $_POST['comment'], $_POST['post_id']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['action'] == 'reportComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                reportComment($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['action'] == 'login') {
            if (!empty($_POST['name']) && !empty($_POST['password'])) {
                connect($_POST['name']);
            }
            else {
                throw new Exception('Nom et/ou mot de passe non-transmis...');
            }
        }
        elseif ($_GET['action'] == 'logout') {
            disconnect();
        }
        elseif ($_GET['action'] == 'registerUser') {
            if (!empty($_POST['password']) && !empty($_POST['password_check']) && $_POST['password'] == $_POST['password_check']) {
                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                    $hashed_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    addUser($_POST['name'], $hashed_pass, $_POST['email']);
                }
                else {
                    throw new Exception('L\'adresse email n\'est pas valide !');
                }
            }
            else {
                throw new Exception('Le mot de passe est différent d\'un champ à l\'autre');
            }
        }
        elseif ($_GET['action'] == 'register') {
            register();
        }
        elseif ($_GET['action'] == 'showProfile') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['page']) && $_GET['page'] > 0) {
                profile($_GET['page']);
            }
            else {
                throw new Exception('Aucun membre sélectionné !');
            }
        }
        elseif ($_GET['action'] == 'editProfile') {
            editProfile();
        }
        elseif ($_GET['action'] == 'updateName') {
            if (isset($_SESSION['id'])) {
                if (!empty($_POST['name'])) {
                    updateName($_SESSION['id'], $_POST['name']);
                }
                else {
                    throw new Exception('Aucun nouveau nom envoyé !');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'updateEmail') {
            if (!empty($_POST['email'])) {
                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                    updateEmail($_SESSION['id'], $_POST['email']);
                }
                else {
                    throw new Exception('L\'adresse email n\'est pas valide !');
                }
            }
            else {
                throw new Exception('Aucun nouvel e-mail envoyé !');
            }
        }
        elseif ($_GET['action'] == 'updatePassword') {
            if (!empty($_POST['password']) && !empty($_POST['password_check']) && $_POST['password'] == $_POST['password_check']) {
                $hashed_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                updatePassword($_SESSION['id'], $hashed_pass);
            }
            else {
                throw new Exception('Les mots de passes entrés ne sont pas identiques !');
            }
        }
        /* ------------------------------------------------------------------------- START ADMIN ------ */
        elseif ($_GET['action'] == 'adminAccess') {
            if ($_SESSION['status'] == "admin") {
                administer();
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'userManagement') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['page']) && $_GET['page'] > 0) {
                manageUser($_GET['page']);
                }
                else {
                    throw new Exception('Ne modifiez pas l\'url de la page si c\'est pour y écrire n\'importe quoi !...');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'blockUser') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                blockedUser($_GET['id']);
                }
                else {
                    throw new Exception('Aucun utilisateur identifié !');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'unblockUser') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    unblockUser($_GET['id']);
                }
                else {
                    throw new Exception('Aucun utilisateur identifié !');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'postManagement') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['page']) && $_GET['page'] > 0) {
                    smallPosts($_GET['page']);
                }
                else {
                     throw new Exception('Ne modifiez pas l\'url !');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'newPost') {
            if ($_SESSION['status'] == "admin") {
                newPost();
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'addPost') {
            if ($_SESSION['status'] == "admin") {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    addPost($_POST['title'], $_POST['content']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'postToEdit') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    showPostToEdit($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'editPost') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    editPost($_GET['id'], $_POST['title'], $_POST['content']);
                }
                else {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
         }
         elseif ($_GET['action'] == 'deletePost') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    deletePost($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
         }
        elseif ($_GET['action'] == 'commentManagement') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['page']) && $_GET['page'] > 0) {
                    listAdminComments($_GET['page']);
                }
                else {
                    throw new Exception('Ne modifiez pas l\'url de la page si c\'est pour y écrire n\'importe quoi !...');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'reportedCommentManagement') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['page']) && $_GET['page'] > 0 && isset($_GET['bpage']) && $_GET['bpage'] > 0) {
                    listAdminReportedComments($_GET['page'], $_GET['bpage']);
                }
                else {
                    throw new Exception('Ne modifiez pas l\'url de la page si c\'est pour y écrire n\'importe quoi !...');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'blockComment') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    blockComment($_GET['id']);
                }
                else {
                    throw new Exception('Aucun commentaire identifié !');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'deBlockComment') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    deBlockComment($_GET['id']);
                }
                else {
                    throw new Exception('Aucun commentaire identifié !');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'deleteComment') {
            if ($_SESSION['status'] == "admin") {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    deleteComment($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de commentaire envoyé !');
                }
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
         }
        /* ------------------------------------------------------------------------- END ADMIN ------ */
        elseif ($_GET['action'] == 'about') {
            about();
        }
        elseif ($_GET['action'] == 'contact') {
            contact();
        }
        elseif ($_GET['action'] == 'legal') {
            legal();
        }
        elseif ($_GET['action'] == 'mail') {
            if (!empty($_POST['message'])) {
                sendEmail();
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }
    }
    else {
        welcomePosts();
    }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}
<?php
session_start();

require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
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
            if (isset($_GET['id'])) {
                profile();
            }
            else {
                throw new Exception('Aucun membre sélectionné !');
            }
        }
        elseif ($_GET['action'] == 'editProfile') {
            editProfile();
        }
        elseif ($_GET['action'] == 'updateName') {
            if (!empty($_POST['name'])) {
                updateName($_SESSION['id'], $_POST['name']);
            }
            else {
                throw new Exception('Aucun nouveau nom envoyé !');
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
        elseif ($_GET['action'] == 'adminAccess') {
            if ($_SESSION['status'] == "admin") {
                administer();
            }
            else {
                throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        }
        elseif ($_GET['action'] == 'userManagement') {
            if (isset($_GET['page']) && $_GET['page'] > 0) {
                manageUser($_GET['page']);
            }
            else {
                throw new Exception('Ne modifiez pas l\'url de la page si c\'est pour y écrire n\'importe quoi !...');
            }
        }
        elseif ($_GET['action'] == 'blockUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                blockedUser($_GET['id']);
            }
            else {
                throw new Exception('Aucun utilisateur identifié !');
            }
        }
        elseif ($_GET['action'] == 'unblockUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                unblockUser($_GET['id']);
            }
            else {
                throw new Exception('Aucun utilisateur identifié !');
            }
        }
        elseif ($_GET['action'] == 'postManagement') {
            smallPosts();
        }
        elseif ($_GET['action'] == 'commentManagement') {
            if (isset($_GET['page']) && $_GET['page'] > 0) {
                listAdminComments($_GET['page']);
            }
            else {
                throw new Exception('Ne modifiez pas l\'url de la page si c\'est pour y écrire n\'importe quoi !...');
            }
        }
        elseif ($_GET['action'] == 'reportedCommentManagement') {
            if (isset($_GET['page']) && $_GET['page'] > 0 && isset($_GET['bpage']) && $_GET['bpage'] > 0) {
                listAdminReportedComments($_GET['page'], $_GET['bpage']);
            }
            else {
                throw new Exception('Ne modifiez pas l\'url de la page si c\'est pour y écrire n\'importe quoi !...');
            }
        }
        elseif ($_GET['action'] == 'blockComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                blockComment($_GET['id']);
            }
            else {
                throw new Exception('Aucun commentaire identifié !');
            }
        }
        elseif ($_GET['action'] == 'deBlockComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deBlockComment($_GET['id']);
            }
            else {
                throw new Exception('Aucun commentaire identifié !');
            }
        }
        elseif ($_GET['action'] == 'about') {
            about();
        }
        elseif ($_GET['action'] == 'contact') {
            contact();
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
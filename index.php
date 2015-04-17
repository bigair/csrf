<?php
session_start();
include __DIR__.'/classes/csrf.php';

$csrf = new csrf();

$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

$form_names = $csrf->form_names(array('user', 'password'), false);


if (isset($_POST[$form_names['user']], $_POST[$form_names['password']])) {
    if ($csrf->check_valid('post')) {
        $user = $_POST[$form_names['user']];
        $password = $_POST[$form_names['password']];
    }
    $form_names = $csrf->form_names(array('user', 'password'), true);
}

?>

<form action="index.php" method="post">
<input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />
<input type="text" name="<?= $form_names['user']; ?>" /><br/>
<input type="text" name="<?= $form_names['password']; ?>" />
<input type="submit" value="Login"/>
</form>

<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $message = isset($_POST['message']) ? trim($_POST['message']) : "";

    if ($name !== '' || $email !== '' || $message !== ''){
        $_SESSION['message'] = "Merci $name !";
        header("Location: form.php");
        exit();
    } else {
        $_SESSION['message'] = "Veuillez indiquer votre nom !";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
if (isset($_SESSION['message'])) {
    echo "<ul>" . htmlspecialchars($_SESSION['message']) . "</ul>";
    unset($_SESSION['message']);
    $_SESSION['confirmation_message'] = "Votre formulaire a été envoyé avec succès !";
    echo "<li>" . $_SESSION['confirmation_message'] . "</li>";
    unset($_SESSION['confirmation_message']);
    exit;
}
?>

<form action="form.php" method="post">
    <label for="name">Nom :</label>
    <input type="text" id="name" name="name" required>
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>
    <label for="message">Message :</label>
    <textarea id="message" name="message" required>message</textarea>
    <button type="submit">Envoyer</button>>
</form>

<?php
if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])) {
    echo "<ul>";
    foreach ($_SESSION['messages'] as $message) {
        echo "<li>" . htmlspecialchars($message) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Aucun message enregistré.</p>";
}
?>

</body>
</html>
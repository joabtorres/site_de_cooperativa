<?php

// incluir a funcionalidade do recaptcha
require_once "recaptchalib.php";

// definir a chave secreta
$secret = "6LfpXUgUAAAAAGfwQ3TwMRxKxBJr4_4aZ0XBNDir";

// verificar a chave secreta
$response = null;
$reCaptcha = new ReCaptcha($secret);

if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
}

// deu tudo certo?
if ($response != null && $response->success) {
// processar o formulario
}
?>
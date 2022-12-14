<meta charset="utf-8"/>
<?php

///envio de e-mail
if (isset($_POST['nEnviar'])) {
    $captcha_data = $_POST['g-recaptcha-response'];

    if ($captcha_data != '') {
        $secreto = '6LfpXUgUAAAAAGfwQ3TwMRxKxBJr4_4aZ0XBNDir';
        $var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secreto . "&response=" . $captcha_data . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        $resposta = json_decode($var, true);
    }

    if ($resposta['success']) {
        $cliente = array(
            'nome' => addslashes($_POST['nNome']),
            'email' => addslashes($_POST['nEmail']),
            'assunto' => addslashes($_POST['nAssunto']),
            'mensagem' => addslashes($_POST['nMensagem'])
        );
        $destinatario = "cootax.itb@gmail.com";
		$email_remetente = "contato@cootax.com.br";
		$assunto = "WEBSITE - CONTATO VIA EMAIL";
        $mensagem = '<!DOCTYPE html>
                <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <title>' . $assunto . '</title>
                </head>
                <body>
                    <div style="width: 98%;display: block;margin: 10px auto;padding: 0;font-family: Arial, sans-serif; border : 2px solid #EAE8E8;">
                    <h3 style="background: #0091e1;color: white;padding: 10px;margin: 0;"> <small>' . $assunto . '</small> <br/> Cooperativa dos Taxistas de Itaituba - COOTAX</h3>
                        <div style="padding: 10px;">
                            <p>
                                Um novo e-mail foi envido do website www.cootax.com.br, confira abaixo:
                            </p>
                            <p style="margin: 0;">
                                <b>Nome: </b>' . $cliente['nome'] . '
                            </p>
                            <p style="margin: 0;">
                                <b>Meios de Contato: </b>' . $cliente['email'] . '
                            </p>
                            <p style="margin: 0;">
                                <b>Assunto: </b>' . $cliente['assunto'] . '
                            </p>
                            <p style="margin: 0;">
                                <b>Mensagem: </b><br/>' . $cliente['mensagem'] . '
                            </p>
                        </div>
                    </div>
                </body>
                </html>';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: ' . $assunto . ' <'.$email_remetente.'>' . "\r\n";
		$headers .= 'Cc: '. $email_remetente. "\r\n";
		$headers .= 'Bcc: '. $email_remetente . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
        if (mail($destinatario, $assunto, $mensagem, $headers, "-f$email_remetente")) {
            echo "<script> alert('Mensagem Envidada!')</script>";
        } else {
            echo "<script> alert('Email não enviado!')</script>";
        }
    } else {
        echo "<script> alert('E-mail não enviado, marque o reCAPTCHA provando que não é um robô!')</script>";
    }
    echo'<script> window.location.href="/" </script>';
}
?>
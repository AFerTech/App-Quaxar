<?php


namespace Classes;

 use PHPMailer\PHPMailer\PHPMailer;

class Email{

    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    public function enviarCorreoConfirmacion(){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'f1bef2fef7082b';
        $mail->Password = '67311a439d1764';


        $mail->setFrom('alexis96fer@gmail.com');
        $mail->addAddress('cuentas@quaxar.com', 'QUAXAR');
        $mail->Subject =  'Confirmar cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has Creado tu cuenta, da click en el enlace para confirmar</p>";
        $contenido .= "<p>CLICK AQUI: <a href='http://localhost:3000/confirmar?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
        $contenido .= '</html>';

        $mail->Body= $contenido;

        $mail->send();

    }
    public function enviarCorreoRecuperar(){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'f1bef2fef7082b';
        $mail->Password = '67311a439d1764';


        $mail->setFrom('alexis96fer@gmail.com');
        $mail->addAddress('cuentas@quaxar.com', 'QUAXAR');
        $mail->Subject =  'Recuperar cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Para recuperar tu cuenta da click en el enlace </p>";
        $contenido .= "<p>CLICK AQUI: <a href='http://localhost:3000/reestablecer?token=" . $this->token . "'>Reestablecer password</a></p>";
        $contenido .= "<p>Si no solicitaste recupear tu cuenta, puedes ignorar este mensaje</p>";
        $contenido .= '</html>';

        $mail->Body= $contenido;

        $mail->send();

    }
}
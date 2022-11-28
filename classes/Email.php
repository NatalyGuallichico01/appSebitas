<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email=$email;
        $this->nombre=$nombre;
        $this->token=$token;
        
    }

    public function sendConfirmation(){
        //CREAR EL OBJETO DE EMAIL
        $mail=new PHPMailer();
        $mail->isSMTP();        
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;

        //YAHOO.ES
        //$mail->Username = 'fddbb27e52d034';
        //$mail->Password = '4f97c6a5f05413';

        //APP SEBITAS MAILTRAP
        $mail->Username = 'e4326512175132';
        $mail->Password = '71e65b35859c78';

        //$mail->SMTPSecure='tls';

        $mail->setFrom('cuentas@appsebitas.com');
        $mail->addAddress('cuentas@appsebitas.com', 'AppSebitas.com');
        $mail->Subject = 'Confirmar Cuenta';

        //SET HTML
        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';

        $contenido= '<html>';
        $contenido.="<p><strong>Hola " . $this->email . "</strong> Has creado tu cuenta en Peluquería Sebitas, para confirmar presiona el siguiente enlace</p>";
        $contenido .="<p>Presiona aquí: <a href='http://localhost:3000/confirmarCuenta?token=".$this->token."'>Confirmar Cuenta</a>";
        $contenido .="<p>Si no solicito esta cuenta ignore el mensaje</p>";
        $contenido .='</html>';

        $mail->Body=$contenido;

        //ENVIAR EMAIL
        $mail->send();

    }

    public function sendInstructions(){

        //CREAR EL OBJETO DE EMAIL
        $mail=new PHPMailer();
        $mail->isSMTP();        
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;

        //YAHOO.ES
        //$mail->Username = 'fddbb27e52d034';
        //$mail->Password = '4f97c6a5f05413';

        //APP SEBITAS MAILTRAP
        $mail->Username = 'e4326512175132';
        $mail->Password = '71e65b35859c78';

        //$mail->SMTPSecure='tls';

        $mail->setFrom('cuentas@appsebitas.com');
        $mail->addAddress('cuentas@appsebitas.com', 'AppSebitas.com');
        $mail->Subject = 'Reestablece  tu contraseña';

        //SET HTML
        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';

        $contenido= '<html>';
        $contenido.="<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu contraseña, presiona el siguiente enlace</p>";
        $contenido .="<p>Presiona aquí: <a href='http://localhost:3000/recuperarPassword?token=".$this->token."'>Reestablecer Contraseña</a>";
        $contenido .="<p>Si no solicito esta cuenta ignore el mensaje</p>";
        $contenido .='</html>';

        $mail->Body=$contenido;

        //ENVIAR EMAIL
        $mail->send();

    }

}
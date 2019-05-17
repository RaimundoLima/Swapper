<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__) .$ds.'..');
    include_once($base_dir.'/lib/phpmailer/src/PHPMailer.php');
    include_once($base_dir.'/lib/phpmailer/src/SMTP.php');
    include_once($base_dir.'/model/messagebuilder.php');

    class EmailSender {

        private $nomeDestinatario;
        private $emailDestinatario;
        private $emailSubject;
        private $messageBuilder;

        function __construct($usuario, $email) {
            $this->nomeDestinatario = $usuario['nome'];
            $this->emailDestinatario = $usuario['email'];
            $this->emailSubject = $email['subject'];
            $this->messageBuilder = new MessageBuilder($email, $usuario['chavesecreta']);
        }

        function enviarEmail() {
            $email = $this->montarEmail();
            $this->enviar($email);
        }

        private function montarEmail() {
            $mensagemHTML = $this->messageBuilder->montarCorpoMensagemHTML();
            $mensagemAlt = $this->messageBuilder->montarCorpoMensagemAlt();

            $mail = $this->montaEmailDetails();
            $mail->addAddress($this->emailDestinatario, $this->nomeDestinatario);
            $mail->Subject = $this->emailSubject;
            $mail->Body = $mensagemHTML;
            $mail->AltBody = $mensagemAlt;

            return $mail;
        }

        private function montaEmailDetails() {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->CharSet = 'UTF-8';
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'digaomartins8@gmail.com';
            $mail->Password = 'a87874659bbbb9df5af23f666';
            $mail->FromName = 'Swapper';
            $mail->Port = 587;
            $mail->setFrom('admin@swapper.com', 'Swapper');
            $mail->addReplyTo('no-reply@gmail.com');
            $mail->isHTML(true);

            return $mail;
        }

        private function enviar($email) {
            if(!$email->send()) {
                echo 'Não foi possível enviar a mensagem.<br>';
                echo 'Erro: ' . $email->ErrorInfo;
            } else {
                echo 'Mensagem enviada';
            }
        }
    }

?>
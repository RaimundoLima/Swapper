<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__).$ds.'..'.$ds.'..');
    include_once($base_dir.'/lib/phpmailer/src/PHPMailer.php');
    include_once($base_dir.'/lib/phpmailer/src/SMTP.php');
    include_once($base_dir.'/public_html/model/messagebuilder.php');

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
        	$mail->IsSMTP();
        	$mail->SMTPDebug = 0;
        	$mail->SMTPAuth = true;
        	$mail->SMTPSecure = 'tls';	
            $mail->SMTPAuth = true;
        	$mail->Host = 'tls://smtp.gmail.com';
        	$mail->Port = 587;  		
            $mail->CharSet = 'UTF-8';
            $mail->Username = 'swapperjr@gmail.com';
            $mail->Password = 'swapper123';
            $mail->FromName = 'Swapper';
            $mail->setFrom('swapperjr@gmail.com', 'Swapper');
            $mail->addReplyTo('no-reply@gmail.com');
            $mail->isHTML(true);

            return $mail;
        }

        private function enviar($email) {
            try {
                $email->Send();
            } catch (phpmailerException $e) {
                echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch (Exception $e) {
                echo $e->getMessage(); //Boring error messages from anything else!
            }
        }
    }

?>
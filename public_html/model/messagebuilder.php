<?php

    class MessageBuilder {

        private $cabecalho;
        private $corpo;
        private $buttonText;
        private $chaveSecretaDestinatario;
        private $urlVerificacao;

        function __construct($email, $chaveSecretaDestinatario) {
            $this->cabecalho = $email['cabecalho'];
            $this->corpo = $email['corpo'];
            $this->buttonText = $email['buttonText'];
            $this->chaveSecretaDestinatario = $chaveSecretaDestinatario;
            $this->urlVerificacao = $this->montarUrl($email['objetivo']);
        }

        private function montarUrl($objetivo) {
            return 'http://'.$_SERVER['HTTP_HOST'].'/'.$objetivo.'?'.$this->chaveSecretaDestinatario;
        }

        function montarCorpoMensagemHTML() {
            return '<table style="background-color:#f1f1f1;min-width:500px" width="100%" bgcolor="#f1f1f1">
                        <tbody>
                            <tr>
                                <td style="min-width:500px" width="100%" valign="top" align="center">
                                    <center>
                                    <table style="min-width:500px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f1f1f1">
                                        <tbody>
                                            <tr style="height: 150px;"></tr>
                                            <tr>
                                                <td align="center">
                                                    <table style="min-width:500px" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center">
                                                                    <table style="min-width:500px" width="500" cellspacing="0" cellpadding="0" border="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <div style="font-family:arial,helvetica,sans-serif;font-size:24px;color:#313131;text-align:center">
                                                                                        '.$this->cabecalho.'
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td style="font-family:arial,helvetica,sans-serif;font-size:16px;color:#313131;line-height:24px" align="center">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table style="min-width:500px" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center">
                                                                    <table style="min-width:500px" width="500" cellspacing="0" cellpadding="0" border="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <div style="font-family:arial,helvetica,sans-serif;font-size:24px;color:#313131;text-align:center">
                                                                                        <div style="font-family:arial,helvetica,sans-serif;font-size:24px;color:#313131;text-align:center">
                                                                                            '.$this->corpo.'
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr style="height: 50px;"></tr>
                                                                            <tr>
                                                                                <td style="border-radius:30px; color:#ffffff; font-family:Arial,sans-serif; font-size:18px; line-height:18px; text-align:center; letter-spacing:2px; text-transform:uppercase; font-weight: bold;" bgcolor="#e66465">
                                                                                    <a href="'.$this->urlVerificacao.'" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="color:#ffffff; text-decoration:none">
                                                                                        <span style="color:#ffffff; text-decoration:none;  padding:15px 30px; display:block; width:90%;">
                                                                                            '.$this->buttonText.'
                                                                                        </span>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr style="height: 50px;"></tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div style="color: rgb(76, 76, 76); font-family:Arial,sans-serif; font-size: 14px; line-height: 20px; text-align: center;">
                                                                                        Ou cole este link no seu navegador:
                                                                                        <a href="'.$this->urlVerificacao.'" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable">
                                                                                            <span class="x_link-white" style="color:#e66465"; text-decoration:none">'.$this->urlVerificacao.'</span>
                                                                                        </a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr style="height: 150px;"></tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>';
        }

        function montarCorpoMensagemAlt() {
            return $this->cabecalho.'. Para concluir, acesse o link: '.$this->urlVerificacao;
        }
    }

?>
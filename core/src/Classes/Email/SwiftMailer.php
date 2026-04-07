<?php
namespace Classes\Email;

use Utils\LogManager;

class SwiftMailer extends EmailSender
{

    public function __construct($settings)
    {
        parent::__construct($settings);
    }

    protected function sendMail(
        $subject,
        $body,
        $toEmail,
        $fromEmail,
        $replyToEmail = null,
        $ccList = array(),
        $bccList = array(),
        $fromName = null
    ) {

        try {
            if (empty($replyToEmail)) {
                $replyToEmail = $fromEmail;
            }

            LogManager::getInstance()->info("Sending email to: " . $toEmail . "/ from: " . $fromEmail);

            $host = $this->settings->getSetting("Email: SMTP Host");
            $username = $this->settings->getSetting("Email: SMTP User");
            $password = $this->settings->getSetting("Email: SMTP Password");
            $port = $this->settings->getSetting("Email: SMTP Port");

            if (empty($port)) {
                $port = '25';
            }

            // Enable TLS for port 587 (STARTTLS), SSL for port 465
            if ($port == '587') {
                $transport = new \Swift_SmtpTransport($host, $port, 'tls');
            } elseif ($port == '465') {
                $transport = new \Swift_SmtpTransport($host, $port, 'ssl');
            } else {
                $transport = new \Swift_SmtpTransport($host, $port);
            }

            $mail = new \Swift_Message();

            if ($this->settings->getSetting("Email: SMTP Authentication Required") === "1") {
                $transport->setUsername($username);
                $transport->setPassword($password);
            }

            $mail->addFrom($fromEmail, $fromName);
            $mail->addReplyTo($replyToEmail);
            $mail->addTo($toEmail);
            $mail->setSubject($subject);
            $mail->setCc($ccList);
            $mail->setBcc($bccList);
            $mail->setBody($body, 'text/html');

            $mailer = new \Swift_Mailer($transport);
            return $mailer->send($mail);
        } catch (\Exception $e) {
            LogManager::getInstance()->error("Error sending email:" . $e->getMessage());
            LogManager::getInstance()->notifyException($e);
            return false;
        }
    }
}

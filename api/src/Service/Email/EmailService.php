<?php

namespace App\Service\Email;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class EmailService
{
    public function __construct(private MailerInterface $mailer, private $noReplyEmail)
    {
    }

    public function sendForgetPasswordForm(User $user, string $verificationCode)
    {
        $mail = (new TemplatedEmail())
        ->from(new Address($this->noReplyEmail, 'No Reply'))
        ->to($user->getEmail())
        ->subject('Forget password')
        ->htmlTemplate('forgetPassword.html.twig')
        ->context(['verificationCode' => $verificationCode]);

        $this->mailer->send($mail);
    }
}

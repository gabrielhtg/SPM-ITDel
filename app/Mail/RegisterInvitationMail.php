<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $pesan;
    public $role;
    public $token;

    public function __construct($reqPesan, $reqRole, $reqToken)
    {

        if ($reqRole == 1) {
            $this->role = "Rektor";
        }
        else if ($reqRole == 2) {
            $this->role = "Wakil Rektor";
        }
        else if ($reqRole == 3) {
            $this->role = "Ketua SPPM";
        }
        else if ($reqRole == 4) {
            $this->role = "Anggota SPPM";
        }
        else {
            $this->role = "Unknown";
        }

        $this->pesan = $reqPesan;
        $this->token = $reqToken;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('amiadmitdel@gmail.com', 'AMI IT Del Administrator'),
            subject: 'Register Invitation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Mail.register-invitation-mail',
            with: [
                'pesan' => $this->pesan,
                'role' => $this->role,
                'token' => $this->token
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

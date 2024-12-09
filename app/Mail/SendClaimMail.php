<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendClaimMail extends Mailable
{
    use Queueable, SerializesModels;

    public $complaintData;

    public function __construct($complaintData)
    {
        $this->complaintData = $complaintData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(Auth::user()->email_usuario, Auth::user()->nombre_usuario),
            subject: 'Nuevo reclamo solicitado',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.claim',
        );
    }
    
    public function attachments(): array
    {
        return [];
    }
}



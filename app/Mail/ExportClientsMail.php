<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExportClientsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $filename;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $filename) {
        $this->title = $title;
        $this->filename = $filename;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('Admin@activite-sport.com', 'David Devine'),
            subject: 'Export Clients Mail',
        );;
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'clients.exportClients',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromStorageDisk('public', $this->filename),
        ];
    }
}

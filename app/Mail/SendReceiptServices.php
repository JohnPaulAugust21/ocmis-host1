<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendReceiptServices extends Mailable
{
    use Queueable, SerializesModels;
    public $content = [];
    public $service_list;
    /**
     * Create a new message instance.
     */
    public function __construct($content, $service_list)
    {
        //
        $this->content = $content;
        $this->service_list = $service_list;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Receipt Services',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.SendReceiptServices',
            with: [
                'name' => $this->content['name'],
                'service_list' => $this->service_list,
            ]
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

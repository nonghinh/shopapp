<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $name;
    protected $email;
    protected $content;
    public function __construct($name, $email, $content)
    {
        $this->name = $name;
        $this->email = $email;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.feedback')
                ->with(['name' => $this->name, 'email' => $this->email, 'content'=> $this->content])
                ->from($this->email, $this->name)
                ->cc($this->email, $this->name)
                ->bcc($this->email, $this->name)
                ->replyTo($this->email, $this->name)
                ->subject('Thư phản hồi');
    }
}

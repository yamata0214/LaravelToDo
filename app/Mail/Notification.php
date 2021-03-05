<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $title;
    protected $text;
    protected $newPass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $text, $newPass){
        $this->title = sprintf('%sさん。パスワード更新のお知らせ。', $name);
        $this->text = $text;
        $this->newPass = $newPass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.send')
                    ->text('emails.send_plain')
                    ->subject($this->title)
                    ->with([
                        'text' => $this->text,
                        'newPass' => $this->newPass,
                    ]);
    }
}

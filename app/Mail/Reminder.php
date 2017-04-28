<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;
    public $data; //定义一个公共的变量
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;//接收传入的变量
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //邮件模板视图 path: views/email/welcome.blade.php
        return $this->view('emails.reminder')->subject($this->data->title);
    }
}

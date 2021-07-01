<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderDelivered extends Mailable
{
    use Queueable, SerializesModels;
     public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   public function __construct($order)
    {
        $this->order = $order;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->from('shopping@gmail.com')
       ->subject('Your Order Status')
       ->markdown('emails.order_delivered');
    }
}

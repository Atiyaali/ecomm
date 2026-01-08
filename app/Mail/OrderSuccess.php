<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderSuccess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $cartItems;
    public $name;
    public $order_number;
    public $payment_method;
//    public $totalPaidInDollars;
    public function __construct($name , $order_number ,$cartItems, $payment_method)
    {
        $this->cartItems = $cartItems;
        $this->name = $name;
        $this->order_number = $order_number;
        $this->payment_method = $payment_method;

        // $this->totalPaidInDollars = $totalPaidInDollars;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Success',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.ordersuccess',
            with: [
                'cartItems' => $this->cartItems,
                'name' => $this->name,
                'order_number' => $this->order_number,
                'payment_method' => $this->payment_method,
                // 'totalPaidInDollars' => $this->totalPaidInDollars,
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

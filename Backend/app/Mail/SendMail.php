<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->details['opcion']==1){
            return $this->subject('Recuperación de contraseña')
                        ->view('emails.sendmail');
        }
        if($this->details['opcion']==2){
            return $this->subject('Solicitud de ayudante')
                    ->view('emails.sendMailSolicitud');
        }
        if($this->details['opcion']==3){
            return $this->subject($this->details['motivo'])
                        ->view('emails.sendmailContactar');
        }
    }
}
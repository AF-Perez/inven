<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordSetupNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $nombres;
    public $apellidos;
    public $cedula;
    public $enlace;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $nombres, $apellidos, $cedula, $enlace)
    {
        $this->email = $email;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->cedula = $cedula;
        $this->enlace = $enlace;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nombre_completo = $this->apellidos . ' ' . $this->nombres;
        return $this
            ->from('admin@yavirac.edu.ec', 'Alausi')
            ->subject('Establecimiento de Contraseña')
            ->markdown('mails.password-setup')
            ->with([
                'name' => $nombre_completo,
                'link' => $this->enlace,
            ]);
    }
}

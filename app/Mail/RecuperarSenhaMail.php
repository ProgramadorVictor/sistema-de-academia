<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecuperarSenhaMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $nome_completo;
    protected $token;

    public function __construct(string $nome_completo, string $token)
    {
        $this->nome_completo = $nome_completo;
        $this->token = $token;
    }
    public function build()
    {
        $token = $this->token; $nome_completo = $this->nome_completo;
        $url = 'http://localhost:8000/recuperar-senha?token='.$token;
        return $this->markdown('mail.recuperar-senha')
                    ->with(['url' => $url, 'nome' => $nome_completo])
                    ->subject("Recuperação de senha");
    }
}

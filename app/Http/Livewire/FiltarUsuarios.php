<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FiltarUsuarios extends Component
{
    public $usuario;

    public function filtrarUsuarios(){
            $this->emit('terminoBusqueda', $this->usuario);
    }
    public function render()
    {
        return view('livewire.filtar-usuarios');
    }
}

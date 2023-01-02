<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class DatosPerfil extends Component

{
 //otra forma de comunicar con un accion de button
 protected $listeners = ['mostrarFollower', 'mostrarFollowings'];

    public $user;
    public function mount($user){

        $this->user = $user;
    
     }

     public function mostrarFollower(User $user){
       
      }

      public function mostrarFollowings(User $user){
       
      }
     

    public function render()
    {
        return view('livewire.datos-perfil');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\Provider as ModelsProvider;
use Livewire\Component;

class Provider extends Component
{
    public $count=0;
    public function render()
    {
        
        return view('livewire.admin.provider',['providers'=>ModelsProvider::all()]);
    }
 

    public function modal(){
        $this->dispatchBrowserEvent('show-form');

      }

      public function details(){
        $this->dispatchBrowserEvent('show-detail');
  
      }
}

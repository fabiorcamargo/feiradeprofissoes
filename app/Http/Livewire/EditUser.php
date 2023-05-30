<?php

namespace App\Http\Livewire;

use App\Models\BlogPost;
use LivewireUI\Modal\ModalComponent;

class EditUser extends ModalComponent
{
    public BlogPost $post;
    public $url;

    public function mount()
    {
        
        $this->url = $this->post->url;

    }
    public function render()
    {
        return view('livewire.edit-user');
    }
}

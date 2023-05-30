<?php

namespace App\Http\Livewire;

use App\Models\BlogPost;
use Livewire\Component;

class Counter extends Component
{
    public $count;
    public BlogPost $post;
    
 
    public function mount($post)
    {

        $this->count = $this->post->like;
    }

    public function increment()
    { 
        $this->count++;
        $this->post->like = $this->count;
        $this->post->save();

    }
 
    public function render()
    {
        return view('livewire.counter');
    }
}
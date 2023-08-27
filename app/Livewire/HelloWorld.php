<?php

namespace App\Livewire;

use App\Livewire\Component;

class HelloWorld extends Component {
    public $name = 'John Doe';

    public function mount()
    {
        // Your initialization logic here
    }

    public function render()
    {
        return '<h1>Hello, ' . $this->name . '!</h1>';
    }
}

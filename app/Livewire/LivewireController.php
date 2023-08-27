<?php

namespace App\Livewire;

use App\Livewire\HelloWorld;

class LivewireController
{

    public function helloWorld()
    {
        $component = new HelloWorld();
        $component->mount();

        return $component->render();
    }
}

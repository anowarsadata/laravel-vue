<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $value;
    public $placeholder;
    public $rows;

    public function __construct($name, $value = null, $placeholder = null, $rows = 4)
    {
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
    }

    public function render()
    {
        return view('components.textarea');
    }
}


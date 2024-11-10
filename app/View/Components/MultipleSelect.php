<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MultipleSelect extends Component
{
    public $name            = '';
    public $options         = [];
    public $select_id       = null;
    public $values          = [];
    /**
     * Create a new component instance.
     */
    public function __construct($name, $options, $values)
    {
        //
        $this->name         = $name;
        $this->options      = $options;
        $this->values       = $values;
        $this->select_id    = $this->name.uniqid();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.multiple-select');
    }
}
<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageUpload extends Component
{
    public $name        = '';
    public $src         = '';
    public $image_id    = null;
    public $file_id     = null;
    /**
     * Create a new component instance.
     */
    public function __construct($name,$src)
    {
        //
        $this->name     = $name;
        $this->src      = $src;
        $this->image_id = $name.'_image_'.uniqid();
        $this->file_id  = $name.'_file_'.uniqid();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image-upload');
    }
}

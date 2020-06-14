<?php

namespace App\View\Components;

use Illuminate\View\Component;

class commentReply extends Component
{
    public $replies;
    public $identify;
    // *
    //  * Create a new component instance.
    //  *
    //  * @return void
     
    public function __construct($replies, $identify)
    {
        $this->replies = $replies;
        $this->identify = $identify;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.comment-reply');
    }
}

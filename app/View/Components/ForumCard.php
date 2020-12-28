<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ForumCard extends Component
{
    public $forum;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($forum)
    {
        $this->forum = $forum;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forum-card');
    }
}

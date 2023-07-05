<?php

namespace App\View\Components;

use Illuminate\View\Component;


use App\Models\Todo;


class TodoCard extends Component
{
  public Todo $todo;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.todo-card');
    }
}

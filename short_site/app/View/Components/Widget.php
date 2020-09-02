<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Contracts\RpcClient;

class Widget extends Component
{
    public $page_uid;
    public $rows;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(RpcClient $client, $pageUid)
    {
        $this->page_uid = $pageUid;
        $this->rows = $client->call("show", ["page_uid" => $pageUid]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.widget');
    }
}
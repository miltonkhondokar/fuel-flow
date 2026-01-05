<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WarningNotice extends Component
{
    public string $title;
    public string $message;
    public string $linkText;
    public string $linkUrl;

    public function __construct($title, $message, $linkText, $linkUrl)
    {
        $this->title = $title;
        $this->message = $message;
        $this->linkText = $linkText;
        $this->linkUrl = $linkUrl;
    }

    public function render()
    {
        return view('components.warning-notice');
    }
}

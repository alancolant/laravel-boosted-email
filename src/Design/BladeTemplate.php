<?php

namespace Alancolant\LaravelBoostedEmail\Design;

use Alancolant\LaravelBoostedEmail\Design\Contracts\TemplateContract;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\View;

class BladeTemplate implements TemplateContract
{
    public function __construct(public string $view, public array $with = [])
    {
    }

    public function toView(): \Illuminate\Contracts\View\View
    {
        return View::make($this->view, $this->with);
    }

    public function toContent(array $with = []): Content
    {
        $htmlString = View::make($this->toView()->name(), [...$this->toView()->getData(), ...$with])->render();

        return new Content(htmlString: $htmlString);
    }
}

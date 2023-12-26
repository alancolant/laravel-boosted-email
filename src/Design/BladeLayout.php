<?php

namespace Alancolant\LaravelBoostedEmail\Design;

use Alancolant\LaravelBoostedEmail\Design\Contracts\LayoutContract;
use Alancolant\LaravelBoostedEmail\Design\Contracts\TemplateContract;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class BladeLayout implements LayoutContract
{
    public function __construct(public string $view, public array $with = [])
    {
    }

    private function getView(): \Illuminate\Contracts\View\View
    {
        return View::make($this->view, $this->with);
    }

    public function toContent(?TemplateContract $template = null, array $with = []): Content
    {
        $rawBlade = "@extends('{$this->getView()->name()}',[...\$__LAYOUT_DATA])";
        $data = ['__LAYOUT_DATA' => $this->getView()->getData(), ...$with];

        if ($template) {
            $rawBlade .= "@section('template') @include('{$template->toView()->name()}',[...\$__TEMPLATE_DATA]) @endsection";
            $data['__TEMPLATE_DATA'] = $template->toView()->getData();
        }

        $htmlString = Blade::render($rawBlade, $data);

        return new Content(htmlString: $htmlString);
    }
}

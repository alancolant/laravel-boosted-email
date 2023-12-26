<?php

namespace Alancolant\LaravelBoostedEmail\Design\Layout;

use Alancolant\LaravelBoostedEmail\Design\Contracts\TemplateContract;
use Illuminate\Mail\Mailables\Content;
use Spatie\Mjml\Mjml as SpatieMjml;

class MjmlLayout extends BladeLayout
{
    public function toContent(?TemplateContract $template = null, array $with = []): Content
    {
        $content = parent::toContent($template, $with);

        $mjmlString = SpatieMjml::new()->toHtml($content->htmlString, config('boosted-email.mjml', []));

        return new Content(htmlString: $mjmlString);
    }
}

<?php

namespace Alancolant\LaravelBoostedEmail\Design;

use Alancolant\LaravelBoostedEmail\Design\Contracts\TemplateContract;
use Illuminate\Mail\Mailables\Content;
use Spatie\Mjml\Mjml;

class MjmlLayout extends BladeLayout
{
    public function toContent(?TemplateContract $template = null, array $with = []): Content
    {
        $content = parent::toContent($template, $with);

        $mjmlString = Mjml::new()->toHtml($content->htmlString, config('boosted-email.mjml', []));

        return new Content(htmlString: $mjmlString);
    }
}

<?php

namespace Alancolant\LaravelBoostedEmail\Design\Template;

use Illuminate\Mail\Mailables\Content;
use Spatie\Mjml\Mjml;

class MjmlTemplate extends BladeTemplate
{
    public function toContent(array $with = []): Content
    {
        $content = parent::toContent($with);

        $htmlString = str($content->htmlString);

        if (! $htmlString->contains('</mj-body>')) {
            $htmlString = str("<mj-body>{$htmlString}</mj-body>");
        }
        if (! $htmlString->contains('</mjml>')) {
            $htmlString = str("<mjml>{$htmlString}</mjml>");
        }
        $mjmlString = Mjml::new()->toHtml($htmlString->toString(), config('boosted-email.mjml', []));

        return new Content(htmlString: $mjmlString);
    }
}

<?php

namespace Alancolant\LaravelBoostedEmail\Design\Contracts;

use Illuminate\Mail\Mailables\Content;

interface LayoutContract
{
    public function toContent(?TemplateContract $template = null, array $with = []): Content;
}

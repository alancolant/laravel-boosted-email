<?php

namespace Alancolant\LaravelBoostedEmail\Design\Contracts;

use Illuminate\Contracts\View\View;
use Illuminate\Mail\Mailables\Content;

interface TemplateContract
{
    public function toContent(array $with = []): Content;

    public function toView(): View;
}

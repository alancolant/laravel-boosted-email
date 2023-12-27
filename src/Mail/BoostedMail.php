<?php

namespace Alancolant\LaravelBoostedEmail\Mail;

use Alancolant\LaravelBoostedEmail\Design\Contracts\LayoutContract;
use Alancolant\LaravelBoostedEmail\Design\Contracts\TemplateContract;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class BoostedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected ?LayoutContract $layout = null;

    protected ?TemplateContract $template = null;

    protected function data(): array
    {
        return [];
    }

    protected function prepare(): void
    {
    }

    public function setLayout(?LayoutContract $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    public function setTemplate(?TemplateContract $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function content(): Content
    {
        $this->prepare();

        if ($this->layout) {
            return $this->layout->toContent($this->template, $this->_getAllData());
        }
        if ($this->template) {
            return $this->template->toContent($this->_getAllData());
        }
        throw new \Error('Please specify layout or template');
    }

    private function _getAllData(): array
    {
        $reflectedProps = collect((new \ReflectionClass($this))->getProperties(\ReflectionProperty::IS_PUBLIC))
            ->filter(fn(\ReflectionProperty $prop) => !in_array($prop->getDeclaringClass()->getName(), [self::class, parent::class]));

        /** Important do not use toArray on collection because transform model to array*/
        $publicProps = [];
        foreach ($reflectedProps as $reflectedProp) {
            $publicProps[$reflectedProp->getName()] = $reflectedProp->getValue($this);
        }
        return array_merge($publicProps, $this->data());
    }
}

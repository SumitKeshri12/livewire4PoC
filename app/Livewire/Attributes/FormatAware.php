<?php

namespace App\Livewire\Attributes;

use Livewire\Features\SupportAttributes\Attribute;
use Illuminate\Http\Response;

abstract class FormatAware extends Attribute
{
    protected $methods = ['GET'];
    protected $accepts = ['*/*'];

    public function render($component, $view)
    {
        if (! in_array(request()->method(), $this->methods)) {
            return;
        }

        // Check if the Accept header contains our content type
        $acceptHeader = request()->header('Accept', '');
        $matches = false;
        
        foreach ($this->accepts as $contentType) {
            if (str_contains($acceptHeader, $contentType)) {
                $matches = true;
                break;
            }
        }
        
        if (! $matches) {
            return;
        }

        return $this->response($component, $view);
    }

    abstract protected function response($component, $view);
}

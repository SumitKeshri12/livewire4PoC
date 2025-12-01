<?php

namespace App\Livewire\Attributes;

use Livewire\Features\SupportAttributes\Attribute;

abstract class FormatAware extends Attribute
{
    protected $methods = ['GET'];
    protected $accepts = ['*/*'];

    public function __construct()
    {
        // Constructor to handle Livewire attribute instantiation
    }

    // boot method removed

    public function render($view)
    {
        // Check if we should intercept this request
        if (!$this->shouldIntercept()) {
            return null;
        }

        $response = $this->response($this->component, $view);
        
        if ($response) {
            $response->send();
            exit;
        }
    }

    protected function shouldIntercept(): bool
    {
        // Check HTTP method
        if (!in_array(request()->method(), $this->methods)) {
            return false;
        }

        // Check Accept header
        $acceptHeader = request()->header('Accept', '');
        
        foreach ($this->accepts as $contentType) {
            if ($contentType === '*/*' || str_contains($acceptHeader, $contentType)) {
                return true;
            }
        }
        
        return false;
    }

    abstract protected function response($component, $view);
}


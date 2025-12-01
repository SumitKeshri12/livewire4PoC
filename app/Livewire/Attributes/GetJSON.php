<?php

namespace App\Livewire\Attributes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class GetJSON extends FormatAware
{
    protected $accepts = ['application/json'];

    protected function response($component, $view)
    {
        // Get all public properties from the component
        $data = collect((new \ReflectionClass($component))->getProperties(\ReflectionProperty::IS_PUBLIC))
            ->filter(fn($prop) => !$prop->isStatic())
            ->mapWithKeys(function($prop) use ($component) {
                $prop->setAccessible(true);
                $value = $prop->getValue($component);
                return [$prop->getName() => $value instanceof Model ? $value->toArray() : $value];
            })
            ->all();

        return response()->json($data);
    }
}

<?php

namespace App\Livewire\Attributes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
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
            // Only get properties defined in the component class, not parent classes
            ->filter(fn($prop) => $prop->getDeclaringClass()->getName() === get_class($component))
            ->mapWithKeys(function($prop) use ($component) {
                $prop->setAccessible(true);
                
                if (!$prop->isInitialized($component)) {
                    return [$prop->getName() => null];
                }
                
                $value = $prop->getValue($component);
                
                // Handle different types of values
                if ($value instanceof Model) {
                    return [$prop->getName() => $value->toArray()];
                } elseif ($value instanceof Collection) {
                    return [$prop->getName() => $value->toArray()];
                } elseif (is_array($value)) {
                    return [$prop->getName() => $value];
                }
                
                return [$prop->getName() => $value];
            })
            ->all();

        // Add computed properties
        $computedProperties = collect((new \ReflectionClass($component))->getMethods(\ReflectionMethod::IS_PUBLIC))
            ->filter(fn($method) => !empty($method->getAttributes(\Livewire\Attributes\Computed::class)))
            ->mapWithKeys(function($method) use ($component) {
                $name = $method->getName();
                try {
                    $value = $component->$name();
                    
                    if ($value instanceof Model) {
                        return [$name => $value->toArray()];
                    } elseif ($value instanceof Collection) {
                        return [$name => $value->toArray()];
                    } elseif (is_array($value)) {
                        return [$name => $value];
                    }
                    
                    return [$name => $value];
                } catch (\Throwable $e) {
                    return [$name => null];
                }
            })
            ->all();
            
        $data = array_merge($data, $computedProperties);

        return response()->json($data);
    }
}

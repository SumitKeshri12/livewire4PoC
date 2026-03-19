# Detailed Technical Comparison: Livewire 3 vs. Livewire 4

This report provides a deep dive into the architectural shifts and new features introduced in Livewire 4, illustrated with concrete implementation patterns found in this PoC.

## 1. The Rendering Engine: Blaze 🔥
Livewire 4 introduces **Blaze**, a compile-time optimization that fundamentally changes how Blade components are handled.

| Logic | Livewire 3 (Standard Blade) | Livewire 4 (Blaze) |
| :--- | :--- | :--- |
| **Process** | Runtime execution of component logic for every iteration. | Component structure is "folded" into the parent at compile-time. |
| **Overhead** | High (n component instances = n execution cycles). | Zero (Component logic is bypassed after compilation). |

### 🛠️ PoC Implementation (`⚡blaze.blade.php`)
The PoC uses the `@blaze` directive to optimize simple components like `<x-blaze-button>`. 
```php
{{-- Component Definition --}}
@blaze
<div class="px-3 py-1.5 bg-indigo-600 text-white rounded">
    {{ $slot }}
</div>

{{-- Usage --}}
@for($i = 1; $i <= 100; $i++)
    <x-blaze-button>{{ $i }}</x-blaze-button>
@endfor
```
**In Livewire 3**, this loop would trigger 100 separate component lifecycle events. **In Livewire 4**, it compiles to a single static string with hole-filling, resulting in **0 component renders**.

---

## 2. Islands of Interactivity 🏝️
While Livewire 3 re-renders the entire component tree, Livewire 4 allows for surgical "Islands" that can update independently.

| Feature | Livewire 3 | Livewire 4 |
| :--- | :--- | :--- |
| **Scope** | Component-wide renders. | Per-island renders (Targeted). |
| **Logic** | Re-calculate all properties. | Support for `append`, `prepend`, and `stream`. |
| **Lazy Loading** | Requires manual `lazy` attribute on components. | Native `@island(lazy: true)` supported anywhere in views. |

### 🛠️ PoC Implementation (`⚡islands-advanced.blade.php`)
The PoC demonstrates **Imperative Portals**, where the backend tells a specific island to update without touching the rest of the page.
```php
public function addItem() {
    $this->renderIsland('items', mode: 'append', with: [
        'items' => ['New Item']
    ]);
}
```
**The Difference**: In Livewire 3, adding an item to a list would require re-rendering the *entire* `foreach` loop. In Livewire 4, we only render the **one new item** and "append" it to the existing DOM via the island.

---

## 3. Global Request Interceptors 🛡️
Livewire 4 provides native hooks into the HTTP request lifecycle, effectively bringing "Middleware" to the frontend.

| Event | Livewire 3 | Livewire 4 |
| :--- | :--- | :--- |
| **Hooking** | Global events like `livewire:init`. | Specific hooks: `onSend`, `onResponse`, `onError`. |
| **Control** | Read-only observation. | Can `preventDefault` and handle errors (419, 404) globally. |

### 🛠️ PoC Implementation ([app.blade.php](file:///c:/Kombee/livewire4PoC/resources/views/layouts/app.blade.php) & `⚡interceptors.blade.php`)
The PoC handles session expiration (419) and server errors globally using `Livewire.interceptRequest`.
```javascript
Livewire.interceptRequest(({ onError }) => {
    onError(({ status }) => {
        if (status === 419) {
            alert('Your session expired. Please refresh.');
        }
    });
});
```
**In Livewire 3**, a 419 error usually results in a generic alert box or a silent failure. **In Livewire 4**, developers have full control over the error UX centrally.

---

## 4. Smart Loading Indicators ⏳
Livewire 4 moves away from manual `wire:loading` targets towards an intelligent, attribute-based system.

| Feature | Livewire 3 | Livewire 4 |
| :--- | :--- | :--- |
| **Targeting** | Manual `wire:target="actionName"`. | Automatic logic-based detection. |
| **Awareness** | Component-isolated. | Cross-component awareness (Parent knows when child is loading). |

### 🛠️ PoC Implementation (`⚡loading.blade.php`)
The PoC uses the `data-loading` attribute. When a request is in flight, Livewire 4 automatically applies this attribute to the triggering element.
```css
[data-loading] {
    opacity: 0.6;
    pointer-events: none;
}
```
**The Difference**: No more boilerplate `wire:loading` tags on every button. The state is handled by CSS and automatic attribute toggling.

---

## 5. Multi-Format Responses (Experimental) 📄
Hidden in the PoC's `app/Livewire/Attributes` folder is a pattern where Livewire components act as full-blown APIs.

| Livewire 3 | Livewire 4 (PoC Pattern) |
| :--- | :--- |
| Always returns HTML. | Can return HTML, JSON, or PDF. |
| Requires separate API Controllers. | The logic lives inside the Volt component. |

### 🛠️ PoC Implementation (`MultiResponseDemo.php`)
Using PHP Attributes (`#[GetJSON]`, `#[GetPDF]`), the PoC intercepts standard Livewire requests and switches the response format based on the `Accept` header.
```php
#[GetJSON]
#[GetPDF]
class MultiResponseDemo extends Component {
    // This component will render HTML to users, 
    // but return JSON to API clients automatically.
}
```

---

## Final Verdict
Livewire 4 is **less magic and more logic**. It gives developers deeper control over the request cycle (Interceptors), rendering performance (Blaze), and UI granularity (Islands). However, as seen in this PoC, it requires a shift toward **Volt** (Single File Components) to truly leverage its power.

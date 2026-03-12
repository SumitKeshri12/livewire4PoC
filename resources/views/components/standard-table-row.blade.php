@props(['id', 'name', 'status', 'sku', 'price'])

<tr class="border-b border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-900/50 transition-colors">
    <td class="px-4 py-3 text-sm font-medium text-zinc-900 dark:text-white">
        {{ $id }}
    </td>
    <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-400">
        {{ $name }}
    </td>
    <td class="px-4 py-3 text-sm">
        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
            {{ ucfirst($status) }}
        </span>
    </td>
    <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-400 font-mono">
        {{ $sku }}
    </td>
    <td class="px-4 py-3 text-sm text-right font-bold text-zinc-900 dark:text-white">
        ${{ number_format($price, 2) }}
    </td>
</tr>

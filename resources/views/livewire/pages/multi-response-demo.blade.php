<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Multi-Response Demo</h1>
    
    <div class="mb-6">
        <p class="mb-2">This component demonstrates returning different formats based on headers.</p>
        <div class="bg-gray-100 p-4 rounded">
            <h3 class="font-semibold">Try it out:</h3>
            <code class="block mt-2">curl -H "Accept: application/json" {{ url()->current() }}</code>
        </div>
    </div>

    <div class="border rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($invoices as $invoice)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $invoice['id'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ $invoice['amount'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $invoice['status'] === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $invoice['status'] }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

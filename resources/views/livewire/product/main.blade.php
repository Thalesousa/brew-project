<div class="min-w-full">
    {{-- Search --}}
    <div class="relative">
        <input
            wire:model.live="search"
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Buscar produtos..."
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        >
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full divide-y bg-white shadow-md divide-gray-200">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th
                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase cursor-pointer border-b-blue-900 border-b-2"
                        wire:click="$toggle('order_by_asc')"
                    >
                        Nome
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estoque</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imagem</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Criado por</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ativo</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                    @forelse ($this->products as $product)
                        <tr wire:key="{{ $product->id }}">
                            <td class="px-4 py-3">{{ $product->id }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $product->name }}</td>
                            <td class="px-4 py-3">{{ $product->sku }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $product->stock }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($product->image === null)
                                    <div class="bg-gray-100 w-16 h-8 flex items-center justify-center rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                    </div>
                                @else
                                    <a href="{{ $product->image}}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ $product->image}}" alt="Prévia da Imagem" class="w-16 h-8 object-cover rounded-lg shadow">
                                    </a>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $product->user->name }}</td>
                            <td class="px-4 py-3">
                                @if($product->is_active)
                                <span class="text-green-600 font-semibold">Sim</span>
                                @else
                                <span class="text-red-600 font-semibold">Não</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 flex space-x-2">
                                <button
                                    type="button"
                                    class="text-blue-600 hover:underline text-sm"
                                    wire:click="toggleModal('{{$product->id}}')"
                                >
                                    Editar
                                </button>

                                <button
                                    type="button"
                                    class="text-red-600 hover:underline text-sm"
                                    wire:click="delete('{{$product->id}}')"
                                    wire:confirm="Deseja realmente excluir o produto? Esta ação não pode ser desfeita."
                                >
                                    Excluir
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-4 py-3 text-center text-gray-500">Nenhum produto encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="min-w-full mt-4">
        {{ $this->products->links() }}
    </div>

    @session('message')
        <x-form.alert-message :message="session('message')" wire:click="clearMessage" />
    @endsession

    {{-- ModalForm --}}
    @if($modalStatus)
        <div class="flex items-center justify-center min-h-screen bg-[#00000080] p-4 absolute inset-0">
            <form wire:submit="submit" class="w-full max-w-xl bg-white p-6 rounded-2xl shadow-md">
                @csrf

                <div class="w-full flex items-center justify-between gap-2 mb-6">
                    <h2 class="text-2xl font-semibold text-center">
                        {{ $this->product ? 'Editar Produto' : 'Novo Produto' }}
                    </h2>
                    <svg wire:click="toggleModal" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>

                {{-- Nome --}}
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-1">Nome</label>
                    <input
                        wire:model="name"
                        type="text"
                        id="name"
                        name="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- SKU --}}
                <div class="mb-4">
                    <label for="sku" class="block text-gray-700 font-medium mb-1">SKU</label>
                    <input
                        wire:model="sku"
                        type="text"
                        id="sku"
                        name="sku"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @error('sku')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Preço --}}
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-medium mb-1">Preço</label>
                    <input
                        wire:model="price"
                        type="number"
                        step="0.01"
                        min="0"
                        id="price"
                        name="price"

                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Estoque --}}
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-medium mb-1">Estoque</label>
                    <input
                        wire:model="stock"
                        type="number"
                        min="0"
                        id="stock"
                        name="stock"

                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @error('stock')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Image--}}
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-medium mb-1">URL da Imagem</label>
                    <input
                        wire:model.live="image"
                        type="text"
                        id="image"
                        name="image"
                        placeholder="https://exemplo.com/imagem.jpg"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-2"
                    >

                    @if ($image)
                        <div class="mb-4">
                            <img src="{{ $image }}" alt="Prévia da Imagem" class="w-16 h-16 object-cover rounded-lg shadow">
                        </div>
                    @else
                        <div class="mb-4 w-16 h-16 bg-gray-100 rounded-lg shadow flex items-center justify-center" >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                    @endif

                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Ativo --}}
                <div class="mb-6 flex items-center">
                    <input
                        wire:model="is_active"
                        type="checkbox"
                        id="is_active"
                        name="is_active"
                        class="h-5 w-5 text-blue-600 border-gray-300 rounded"
                        checked
                    >
                    <label for="is_active" class="ml-2 text-gray-700 font-medium">Produto ativo?</label>
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-transparent hover:border-blue-600 hover:text-blue-600 border border-blue-600 cursor-pointer"
                >
                    {{ $this->product ? 'Atualizar' : 'Criar' }}
                </button>
            </form>
        </div>
    @endif
</div>

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
                            <td class="px-4 py-3">
                                <x-form.image-preview
                                    :image="$product->image"
                                    alt="Imagem do produto {{ $product->name }}"
                                    width="60"
                                    height="34"
                                    iconErrorSize="6"
                                />
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $product->user->name }}</td>
                            <td class="px-4 py-3">
                                @if($product->is_active)
                                <span class="text-green-600 font-semibold">Sim</span>
                                @else
                                <span class="text-red-600 font-semibold">Não</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 space-x-2 flex flex-nowrap items-center gap-2">
                                <button
                                    type="button"
                                    class="text-blue-600 hover:underline text-sm h-full cursor-pointer"
                                    wire:click="toggleModal('{{$product->id}}')"
                                    title="Editar"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>

                                </button>

                                <button
                                    type="button"
                                    class="text-red-600 hover:underline text-sm h-full cursor-pointer"
                                    wire:click="delete('{{$product->id}}')"
                                    wire:confirm="Deseja realmente excluir o produto? Esta ação não pode ser desfeita."
                                    title="Excluir"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
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
        <x-form.alert-message :message="session('message')" click="clearMessage"/>
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
                    <svg wire:click="toggleModal" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>

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
                        <x-form.callback-message :message="$message" />
                    @enderror
                </div>

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
                        <x-form.callback-message :message="$message" />
                    @enderror
                </div>

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
                        <x-form.callback-message :message="$message" />
                    @enderror
                </div>

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
                        <x-form.callback-message :message="$message" />
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-medium mb-1">URL da Imagem</label>
                    <div class="w-full flex items-center justify-between gap-2 mb-2">
                        <input
                            wire:model.live="image"
                            type="text"
                            id="image"
                            name="image"
                            placeholder="https://exemplo.com/imagem.jpg"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <x-form.image-preview
                            :image="$image"
                            width="80"
                            height="44"
                            iconErrorSize="6"
                        />
                    </div>
                    @error('image')
                        <x-form.callback-message :message="$message" />
                    @enderror
                </div>

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

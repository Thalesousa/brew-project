<div class="overflow-x-auto rounded-lg">
    @session('message')
    <div class="p-4 bg-green-100 text-green-800 rounded-lg mt-4">
        {{ session('message') }}
    </div>
    @endsession

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

    <table class="min-w-full divide-y bg-white shadow-md divide-gray-200">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase" wire:click="$toggle('order_by_asc')">Nome</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estoque</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Criado por</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ativo</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
              @forelse ($this->products as $product)
                <tr wire:key="{{ $product->id }}">
                  <td class="px-4 py-3">{{ $product->id }}</td>
                  <td class="px-4 py-3">{{ $product->name }}</td>
                  <td class="px-4 py-3">{{ $product->sku }}</td>
                  <td class="px-4 py-3">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                  <td class="px-4 py-3">{{ $product->stock }}</td>
                  <td class="px-4 py-3">{{ $product->user->name }}</td>
                  <td class="px-4 py-3">
                    @if($product->is_active)
                      <span class="text-green-600 font-semibold">Sim</span>
                    @else
                      <span class="text-red-600 font-semibold">Não</span>
                    @endif
                  </td>
                  <td class="px-4 py-3 flex space-x-2">
                    <button type="button" wire:click="toggleModal('{{$product->id}}')" class="text-blue-600 hover:underline text-sm">Editar</button>

                    <button type="button" class="text-red-600 hover:underline text-sm"
                    wire:click="delete('{{$product->id}}')"
                    wire:confirm="Are you sure you want to delete this product?"
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

    @if($modalStatus)
        <div class="flex items-center justify-center min-h-screen bg-[#00000080] p-4 absolute inset-0">
            <form wire:submit="submit"  class="w-full max-w-xl bg-white p-6 rounded-2xl shadow-md">
                @csrf

                <h2 class="text-2xl font-semibold text-center mb-6 flex items-center justify-between gap-2">
                    {{ $this->product ? 'Editar Produto' : 'Novo Produto' }}
                    {{-- Botão para fechar o modal --}}
                    <svg wire:click="toggleModal" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </h2>
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

                {{-- Imagem --}}
                {{--                <div class="mb-4">--}}
                {{--                    <label for="image" class="block text-gray-700 font-medium mb-1">Imagem (opcional)</label>--}}
                {{--                    <input--}}
                {{--                        wire:model="image"--}}
                {{--                        type="file"--}}
                {{--                        id="image"--}}
                {{--                        name="image"--}}
                {{--                        accept="image/*"--}}
                {{--                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"--}}
                {{--                    >--}}
                {{--                </div>--}}

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
                    class="w-full bg-blue-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300"
                >
                    {{ $this->product ? 'Atualizar Produto' : 'Criar Produto' }}
                </button>
            </form>
        </div>

    @endif

</div>



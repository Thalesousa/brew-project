<x-layout title="Produtos">
  <div class="flex flex-col justify-center max-w-7xl mx-auto">
    <div class="flex items-center justify-between w-full py-4">
      <span class="inline-block">Olá, {{ auth()->user()->name }} </span>
      <a href="{{ route('logout') }}" class="inline-block ml-auto px-4 py-2 bg-blue-600 rounded-md text-white">Sair</a>
    </div>
    <div class="flex items-center justify-between w-full mt-6 mb-10">
        <h2 class="text-2xl font-bold">Lista de Produtos</h2>
        <livewire:product.button-create />
    </div>

    <livewire:product.table />

  </div>
</x-layout>

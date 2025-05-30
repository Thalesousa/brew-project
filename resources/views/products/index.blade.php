<x-layout title="Produtos">
  <div class="flex flex-col items-center justify-center min-h-screen">
    <div class="flex items-center justify-between w-full p-4">
      <span class="inline-block">Olá, {{ auth()->user()->name }} </span>
      <a href="{{ route('logout') }}" class="inline-block ml-auto px-4 py-2 bg-blue-600 rounded-md text-white">Sair</a>
    </div>
    <div class="p-2 min-h-screen">
      <div class="max-w-7xl mx-auto">
          <div class="flex items-center justify-between w-full mt-6 mb-10">
              <h2 class="text-2xl font-bold">Lista de Produtos</h2>
              <livewire:product.button-create />
          </div>
          <livewire:product.table />
      </div>
    </div>
  </div>
</x-layout>

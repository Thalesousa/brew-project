<x-layout
  title="Criar Conta"
>
  <div class="flex items-center justify-center py-10 md:py-24">
    <form action="{{ route('register.create') }}" method="POST" class="w-full max-w-md bg-white p-6 rounded-2xl shadow-md">
      @csrf
      <x-form.title text="Criar Conta" />

      <div class="mb-4">
        <x-form.label for="name" text="Nome" />
        <x-form.input
          id="name"
          name="name"
          required
          placeholder="Digite seu nome"
        />

        @error('name')
        <div class="my-4 pl-2">
          <span class="text-red-400 text-sm">{{ $message }}</span>
        </div>
        @enderror
      </div>

      <div class="mb-4">
        <x-form.label for="email" text="Email" />
        <x-form.input
          type="email"
          id="email"
          name="email"
          required
          placeholder="Digite seu email"
        />
        @error('email')
        <div class="my-4 pl-2">
          <span class="text-red-400 text-sm">{{ $message }}</span>
        </div>
        @enderror
      </div>

      <div class="mb-6">
        <x-form.label for="password" text="Senha" />
        <x-form.input
          type="password"
          id="password"
          name="password"
          required
          placeholder="Digite sua senha"
        />

        @error('password')
        <div class="my-4 pl-2">
          <span class="text-red-400 text-sm">{{ $message }}</span>
        </div>
        @enderror
      </div>

      <x-form.button type="submit" text="Cadastrar" />
      <x-form.link link="{{ route('login') }}" text="Já tenho uma conta" />
    </form>
  </div>
</x-layout>

<x-layout
    title="Login"
>
  <div class="flex items-center justify-center py-10 md:py-24">
    <form action="{{ route('login.post') }}" method="POST" class="w-full max-w-md bg-white p-6 rounded-2xl shadow-md">
      @csrf
      <x-form.title text="Login" />

      <div class="mb-4">
        <x-form.label for="email" text="Email" />
        <x-form.input
          type="email"
          id="email"
          name="email"
          required
          placeholder="Digite seu email"
        />
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
      </div>

      @error('email')
      <div class="mb-4 pl-2">
        <span class="text-sm text-red-400">{{ $message }}</span>
      </div>
      @enderror
      <x-form.button type="submit" text="Entrar" />
      <x-form.link link="{{ route('register.index') }}" text="Criar uma conta" />
    </form>
  </div>
</x-layout>

<x-layout>
  <form action="{{ route('register.create') }}" method="POST">
    @csrf
    <div>
      <label for="name">name</label>
      <input type="text" id="name" name="name" required>
    </div>

    <div>
      <label for="email">email</label>
      <input type="email" id="email" name="email" required>
    </div>

    <div>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
    </div>

    <button type="submit">register</button>
  </form>
</x-layout>

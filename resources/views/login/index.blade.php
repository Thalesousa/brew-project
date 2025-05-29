<x-layout>
  <form action="{{ route('login.post') }}" method="POST">
    @csrf
    <div>
      <label for="email">email</label>
      <input type="text" id="email" name="email" required>
    </div>

    <div>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
    </div>

    <button type="submit">Login</button>
  </form>
</x-layout>

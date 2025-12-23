<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --primary: #1d3468;
      --accent: #fdb810;
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-[var(--primary)]">

  <div class="w-full max-w-sm p-6 bg-white rounded-2xl shadow-xl">
    <h2 class="text-2xl font-semibold text-[var(--primary)] mb-6 text-center">Login</h2>
    <form action="<?= base_url('/login/submit') ?>" method="post" class="space-y-4">
      <div>
        <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
        <input type="text" name="nip" id="nip" value="<?= old('nip') ?>" required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <div class="relative">
          <input type="password" name="password" id="password" value="<?= old('password') ?>" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent)] pr-10">
          <button type="button" onclick="togglePassword()" class="absolute top-2 right-2 text-sm text-gray-500 focus:outline-none">
            👁️
          </button>
        </div>
      </div>

      <button type="submit"
        class="w-full bg-[var(--primary)] text-white font-semibold py-2 rounded-lg hover:bg-opacity-90 transition duration-200 border-2 border-[var(--accent)]">
        Login
      </button>
      <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> <?= session()->getFlashdata('errors') ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
      Belum punya akun?
      <a href="/register" class="text-[var(--accent)] font-medium hover:underline">Daftar di sini</a>
    </p>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    }
  </script>

</body>

</html>
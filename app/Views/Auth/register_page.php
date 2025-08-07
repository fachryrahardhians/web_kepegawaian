<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --primary: #1d3468;
      --accent: #fdb810;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-[var(--primary)]">

  <div class="w-full max-w-md p-6 bg-white rounded-2xl shadow-xl">
    <h2 class="text-2xl font-semibold text-[var(--primary)] mb-6 text-center">Registrasi</h2>

    <!-- <form action="/register" method="post" class="space-y-4"> -->
    <form action="<?= base_url('/register/submit') ?>" method="post" class="space-y-4">  
      <div>
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" name="nama" id="nama"  value="<?= old('nama')?>" required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
          <?php if (session()->has('errors')): ?>
        <small class="text-danger">
        <?= esc(session('errors.nama'))?>
        </small>
<?php endif; ?>  
      </div>

      <div>
        <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
        <input type="text" name="nip" id="nip" value="<?= old('nip')?>" required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
          <?php if (isset($validation)) : ?>
        <small class="text-danger">
        <?= esc(session('errors.nip'))?>
        </small>
<?php endif; ?>  
      </div>

      <div>
        <label for="telepon" class="block text-sm font-medium text-gray-700">No. Telepon (WhatsApp)</label>
        <input type="text" name="no_wa" id="no_wa" value="<?= old('no_wa')?>" required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
          <?php if (isset($validation)) : ?>
        <small class="text-danger">
        <?= esc(session('errors.no_wa'))?>
        </small>
<?php endif; ?>      
        </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" value="<?= old('email')?>" required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
          <?php if (isset($validation)) : ?>
        <small class="text-danger">
        <?= esc(session('errors.email'))?>
        </small>
<?php endif; ?>    
        </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <div class="relative">
          <input type="password" name="password" id="password" value="<?= old('password')?>" required
            class="mt-1 block w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
            <button type="button" onclick="togglePassword('password')" class="absolute top-2 right-2 text-sm text-gray-500 focus:outline-none">👁️</button>
            <?php if (isset($validation)) : ?>
              <small class="text-danger">
              <?= esc(session('errors.password'))?>
              </small>
            <?php endif; ?>  
          </div>
      </div>

      <div>
        <label for="repeat_password" class="block text-sm font-medium text-gray-700">Ulangi Password</label>
        <div class="relative">
          <input type="password" name="repeat_password" id="repeat_password" value="<?= old('repeat_password')?>" required
            class="mt-1 block w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
          <button type="button" onclick="togglePassword('repeat_password')" class="absolute top-2 right-2 text-sm text-gray-500 focus:outline-none">👁️</button>
          <?php if (isset($validation)) : ?>
              <small class="text-danger">
              <?= esc(session('errors.repeat_password'))?>
              </small>
            <?php endif; ?>    
        </div>
      </div>
      <div style="height: 30px;">
      </div>
      <button type="submit"
        class="w-full bg-[var(--primary)] text-white font-semibold py-2 rounded-lg hover:bg-opacity-90 transition duration-200 border-2 border-[var(--accent)]">
        Daftar
      </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
      Sudah punya akun?
      <a href="/login" class="text-[var(--accent)] font-medium hover:underline">Masuk di sini</a>
    </p>
  </div>

  <script>
    function togglePassword(id) {
      const input = document.getElementById(id);
      input.type = input.type === "password" ? "text" : "password";
    }
  </script>

</body>
</html>

<header class="bg-white shadow">
  <div class="max-w-6xl mx-auto flex justify-between items-center p-4">
    <!-- Logo -->
    <h1 class="text-2xl font-bold">TaskManager</h1>

    <!-- Desktop Nav -->
    <nav class="hidden md:flex space-x-6">
      <a href="#" class="hover:text-blue-600">Features</a>
      <a href="#" class="hover:text-blue-600">Roles</a>

      <?php if (!session()->get('isLoggedIn')): ?>
          <a href="<?= base_url('login') ?>" class="hover:text-blue-600">Login</a>
      <?php else: ?>
          <a href="<?= base_url('logout') ?>" class="text-red-600 hover:text-red-800">Logout</a>
      <?php endif; ?>
    </nav>

    <!-- Mobile menu button -->
    <button id="burger" class="md:hidden text-gray-700 focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
           viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" 
              d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>
  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="hidden md:hidden bg-white shadow-md">
    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Features</a>
    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Roles</a>

    <?php if (!session()->get('isLoggedIn')): ?>
        <a href="<?= base_url('login') ?>" class="block px-4 py-2 hover:bg-gray-100">Login</a>
    <?php else: ?>
        <a href="<?= base_url('logout') ?>" class="block px-4 py-2 hover:bg-gray-100 text-red-600">Logout</a>
    <?php endif; ?>
  </div>
  <script src="<?php echo base_url('assets/js/message-helper.js'); ?>"></script>
</header>

<!-- Tailwind Hamburger Toggle Script -->
<script>
  const burger = document.getElementById('burger');
  const menu = document.getElementById('mobileMenu');

  burger.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
</script>

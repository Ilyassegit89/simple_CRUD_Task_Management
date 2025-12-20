<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<div class="flex flex-col md:flex-row min-h-screen " >

    <!-- Sidebar -->
    <aside class="bg-white shadow w-full md:w-64 p-6" style="opacity: 0.5; pointer-events: none;">
        <h2 class="text-xl font-bold mb-6">SuperAdmin Menu</h2>
        <nav class="flex flex-col space-y-2">
            <a href="<?= base_url('superadmin/dashboard') ?>" 
            class="px-4 py-2 rounded hover:bg-blue-100 font-semibold cursor-not-allowed">Dashboard</a>
            <a href="<?= base_url('superadmin/admins') ?>" 
            class="px-4 py-2 rounded hover:bg-blue-100 font-semibold cursor-not-allowed">Admins</a>
            <a href="<?= base_url('logout') ?>" 
            class="px-4 py-2 rounded hover:bg-red-100 font-semibold text-red-600 cursor-not-allowed">Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-100 min-h-screen">

    <!-- Header -->
    <h1 class="text-3xl font-bold text-gray-800 mb-2">
        Welcome, <?= esc($user['name']); ?>!
    </h1>

    <p class="mb-6 text-gray-600">
        This is the <strong><?= esc($user['role']); ?></strong> dashboard.
    </p>

    <!-- Pending Approval Card -->
    <div class="max-w-xl bg-white rounded-2xl shadow-md p-6">
        <h3 class="text-xl font-semibold text-yellow-600 mb-3">
            ⏳ Account Pending Approval
        </h3>

        <p class="text-gray-700 mb-2">
            Hello <strong><?= esc($user['name']) ?></strong>,
        </p>

        <?php if (isset($warning) && $warning): ?>
            <p class="text-gray-600 mb-2">
            <?= esc($warning) ?>
        </p>
        <?php endif; ?>

        <p class="text-gray-600 mb-4">
            You will be able to access the dashboard once approved.
        </p>

        
    </div>

</main>

    <!-- Rest of your pending page content -->

</div>


<?= $this->endSection() ?>

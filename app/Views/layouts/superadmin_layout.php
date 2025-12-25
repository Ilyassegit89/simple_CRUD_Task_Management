<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Sidebar -->
    <aside class="bg-white shadow w-full md:w-64 p-6">
        <h2 class="text-xl font-bold mb-6">SuperAdmin Menu</h2>
        <nav class="flex flex-col space-y-2">
            <a href="<?= base_url('superadmin/dashboard') ?>" 
               class="px-4 py-2 rounded hover:bg-blue-100 font-semibold <?= (uri_string() == 'superadmin/dashboard') ? 'bg-blue-50' : '' ?>">
               Dashboard
            </a>
            <a href="<?= base_url('superadmin/manage_admins') ?>" 
               class="px-4 py-2 rounded hover:bg-blue-100 font-semibold <?= (uri_string() == 'superadmin/manage_admins') ? 'bg-blue-50' : '' ?>">
               Admins
            </a>
            <a href="<?= base_url('superadmin/manage_members') ?>" 
               class="px-4 py-2 rounded hover:bg-blue-100 font-semibold <?= (uri_string() == 'superadmin/manage_members') ? 'bg-blue-50' : '' ?>">
               Members
            </a>
            <a href="<?= base_url('superadmin/assign_tasks') ?>" 
               class="px-4 py-2 rounded hover:bg-blue-100 font-semibold <?= (uri_string() == 'superadmin/assign_tasks') ? 'bg-blue-50' : '' ?>">
               Tasks
            </a>

        </nav>
    </aside>

    <!-- Main Content Area (This changes for each page) -->
    <main class="flex-1 p-6 bg-gray-100">
        <?= $this->renderSection('superadmin_content') ?>
    </main>
</div>

<?= $this->endSection() ?>
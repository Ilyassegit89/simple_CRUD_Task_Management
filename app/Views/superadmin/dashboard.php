<?= $this->extend('layouts/superadmin_layout') ?>

<?= $this->section('superadmin_content') ?>

<h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome, <?= esc($user['name']); ?>!</h1>
<p class="mb-6 text-gray-600">This is the <strong><?= esc($user['role']); ?></strong> dashboard.</p>


<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Stats Card -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm font-semibold">Total Admins</h3>
        <p class="text-3xl font-bold text-blue-600 mt-2"><?= $totalAdmins ?? 0 ?></p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm font-semibold">Total Members</h3>
        <p class="text-3xl font-bold text-green-600 mt-2"><?= $totalMembers ?? 0 ?></p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm font-semibold">Active Tasks</h3>
        <p class="text-3xl font-bold text-purple-600 mt-2"><?= $totalTasks ?? 0 ?></p>
    </div>
</div>

<?= $this->endSection() ?>



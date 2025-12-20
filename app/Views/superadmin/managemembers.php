<?= $this->extend('layouts/superadmin_layout') ?>

<?= $this->section('superadmin_content') ?>

<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manage Members</h1>
        <p class="text-sm text-gray-500">View members and assign them to admins</p>
    </div>

    <!-- Search -->
    <div class="mt-4 md:mt-0">
        <input type="text" placeholder="Search members..."
            class="w-full md:w-64 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
    </div>
</div>

<!-- Members Table Card -->
<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full border-collapse">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Member</th>
                <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Email</th>
                <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Assigned Admin</th>
                <th class="text-center px-6 py-3 text-sm font-semibold text-gray-600">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php if (!empty($members)): ?>
                <?php foreach ($members as $member): ?>
                    <tr class="hover:bg-gray-50">
                        <form method="post" action="<?= site_url('superadmin/update-member-admin') ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="member_id" value="<?= esc($member['id']) ?>">

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-600">
                                        <?= strtoupper(substr($member['name'], 0, 2)) ?>
                                    </div>
                                    <span class="font-medium text-gray-800">
                                        <?= esc($member['name'] ?? 'N/A') ?>
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                <?= esc($member['email'] ?? 'N/A') ?>
                            </td>

                            <td class="px-6 py-4">
                                <select name="admin_id" class="w-full px-3 py-2 border rounded-lg">
                                    <option value="">Unassigned</option>
                                    <?php foreach ($admins as $admin): ?>
                                        <option value="<?= esc($admin['id']) ?>"
                                            <?= ($member['created_by'] ?? '') == $admin['id'] ? 'selected' : '' ?>>
                                            <?= esc($admin['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <button type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Save
                                </button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <p class="text-gray-500 text-lg font-medium">No Members found</p>
                            <p class="text-gray-400 text-sm mt-1">Start by adding a new member</p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Notification Script -->
<script>
<?php if (session()->getFlashdata('success')): ?>
    showMessage('<?= addslashes(session()->getFlashdata('success')) ?>', 'success');
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    showMessage('<?= addslashes(session()->getFlashdata('error')) ?>', 'error');
<?php endif; ?>
</script>

<?= $this->endSection() ?>
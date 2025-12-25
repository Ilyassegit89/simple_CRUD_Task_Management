<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('admin_content') ?>

<div class="flex flex-col md:flex-row min-h-screen">

    <!-- Sidebar -->
    
    <main class="flex-1 p-6 bg-gray-100">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Manage Members</h1>
            <p class="text-gray-600 mt-2">View and manage Members accounts</p>
        </div>

        <!-- Admin Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" style="width: 100%; border-collapse: collapse;">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created At
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Updated At
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($members)): ?>
                            <?php foreach ($members as $member): ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">
                                                    <?= strtoupper(substr($member['name'] ?? 'A', 0, 1)) ?>
                                                </span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?= esc($member['name'] ?? 'N/A') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?= esc($member['email'] ?? 'N/A') ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <?= date('M d, Y', strtotime($member['created_at'] ?? 'now')) ?>
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            <?= date('H:i', strtotime($member['created_at'] ?? 'now')) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <?= date('M d, Y', strtotime($member['updated_at'] ?? 'now')) ?>
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            <?= date('H:i', strtotime($member['updated_at'] ?? 'now')) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($member['is_approved']): ?>
                                            <span style="padding: 2px 8px; display: inline-flex; font-size: 12px; line-height: 1.5; font-weight: 600; border-radius: 9999px; background: #d1fae5; color: #065f46;">Approved</span>
                                        <?php else: ?>
                                            <span style="padding: 2px 8px; display: inline-flex; font-size: 12px; line-height: 1.5; font-weight: 600; border-radius: 9999px; background: #d7d7d7ee; color: #454545ff;">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
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
        </div>
    </main>

    
</div>


<?= $this->endSection() ?>

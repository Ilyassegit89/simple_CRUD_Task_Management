<?= $this->extend('layouts/superadmin_layout') ?>
<?= $this->section('superadmin_content') ?>

<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Admin Tasks</h1>
        <p class="text-sm text-gray-500">Assign tasks to admins</p>
    </div>
</div>

<!-- Create Task Card -->
<div class="bg-white shadow rounded-xl p-6 mb-8">
    <h2 class="text-lg font-semibold mb-4">Create New Task</h2>

    <form method="post" action="<?= site_url('superadmin/tasks/create') ?>" class="space-y-4">
        <?= csrf_field() ?>

        <div>
            <label class="block text-sm font-medium mb-1">Task Title</label>
            <input type="text" name="title" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="3"
                      class="w-full px-4 py-2 border rounded-lg"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Assign to Admin</label>
            <select name="admin_id" required
                    class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select Admin</option>
                <?php foreach ($admins as $admin): ?>
                    <option value="<?= esc($admin['id']) ?>">
                        <?= esc($admin['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
            Assign Task
        </button>
    </form>
</div>

<!-- Tasks List -->
<div class="bg-white shadow rounded-xl overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold">Title</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Admin</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Created</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php foreach ($tasks as $task): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium"><?= esc($task['title']) ?></td>
                    <td class="px-6 py-4"><?= esc($task['admin_name']) ?></td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700">
                            <?= esc($task['status']) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">
                        <?= esc($task['created_at']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
<?php if (session()->getFlashdata('success')): ?>
    console.log("SUCCESS:", "<?= addslashes(session()->getFlashdata('success')) ?>");
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    console.error("ERROR:", "<?= addslashes(session()->getFlashdata('error')) ?>");
<?php endif; ?>
</script>

<?= $this->endSection() ?>

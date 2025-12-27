<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('admin_content') ?>


<!-- Tasks Page (Read-Only / Static UI) -->
<div class="flex-1 p-6 bg-gray-100">



  <!-- Page Header -->
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">My Tasks</h1>
    <p class="text-sm text-gray-500">Tasks assigned by SuperAdmin</p>
  </div>

  <!-- Tasks List -->
  <div class="space-y-4">

    <!-- Task Card -->
    <?php if (!empty($tasks)): ?>
        <?php foreach ($tasks as $task):?>
                <div class="bg-white shadow rounded-lg p-5 flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800"><?= esc($task['title']) ?></h3>
                    <p class="text-sm text-gray-500 mt-1"><?= esc($task['description']) ?></p>
                    Created at <?= date('Y-m-d', strtotime($task['created_at'])) ?>                
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                </div>
        </div>
        <?php endforeach;?>
        
    <?php else: ?>
        no tasks assigned to you !
    <?php endif; ?>
    

    
  </div>

  <!-- Footer Note -->
  <p class="text-xs text-gray-400 mt-6">* Read-only view. Tasks are assigned by SuperAdmin.</p>

</div>

<script>
    console.log('gg')
</script>

<?= $this->endSection() ?>

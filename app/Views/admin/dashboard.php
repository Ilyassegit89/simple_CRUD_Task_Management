<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<div class="flex flex-col md:flex-row min-h-screen">

    <!-- Sidebar -->
    <aside class="bg-white shadow w-full md:w-64 p-6">
        <h2 class="text-xl font-bold mb-6"><?= esc(ucwords($user['role'])); ?> Menu</h2>
        <nav class="flex flex-col space-y-2">
            <a href="<?= base_url('admin/dashboard') ?>" 
               class="px-4 py-2 rounded hover:bg-blue-100 font-semibold">Dashboard</a>
            <a href="<?= base_url('admin/members') ?>" 
               class="px-4 py-2 rounded hover:bg-blue-100 font-semibold">Members</a>
            <a href="<?= base_url('logout') ?>" 
               class="px-4 py-2 rounded hover:bg-red-100 font-semibold text-red-600">Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-100">
        
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome, <?= esc($user['name']); ?>!</h1>
        <p class="mb-6 text-gray-600">This is the <strong><?= esc($user['role']); ?></strong> dashboard.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Card: Total Admins -->
            <div class="bg-white shadow rounded-xl p-4 flex flex-col">
                <span class="text-gray-500">Total Admins</span>
                <span class="text-2xl font-bold text-blue-600 mt-2"><?=  $totalAdmins ?? 0 ?></span>
            </div>

            <!-- Card: Total Members -->
            <div class="bg-white shadow rounded-xl p-4 flex flex-col">
                <span class="text-gray-500">Total Members</span>
                <span class="text-2xl font-bold text-green-600 mt-2"><?= $totalMemberss ?? 0 ?></span>
            </div>

            <!-- Card: Total Tasks -->
            <div class="bg-white shadow rounded-xl p-4 flex flex-col">
                <span class="text-gray-500">Total Tasks</span>
                <span class="text-2xl font-bold text-purple-600 mt-2"><?= $totalTasks ?? 0 ?></span>
            </div>

            

        </div>

        <!-- Example welcome message -->
        
    </main>
</div>
<script>
    let totalAdmins = <?php echo json_encode($totalAdmins)?>;
    console.log(totalAdmins);
</script>

<?= $this->endSection() ?>

<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title ?? 'My App') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100">

    <!-- Include Header -->
    <?= $this->include('layouts/header') ?>

    <!-- Page Content -->
    <div class="container mx-auto p-4">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Include Footer -->
    <?= $this->include('layouts/footer') ?>

</body>
</html>

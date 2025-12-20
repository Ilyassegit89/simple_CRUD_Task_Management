
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="min-h-screen flex items-center justify-center px-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 animate-fadeIn">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Signup</h1>
            <p class="text-gray-500 mt-1">create account admin</p>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('signup') ?>" method="post" class="space-y-4">

             <div>
                <label class="block">Name</label>
                <input type="text" name="name" value="<?= old('name') ?>" class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email" placeholder="you@example.com" 
                       class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            
             <div>
                <label for="role" class="block text-gray-700 font-semibold mb-1">Role</label>
                <select name="role" id="role" 
                        class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="member" <?= old('role') == 'member' ? 'selected' : '' ?>>Member</option>
                    <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="********" 
                       class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password Confirmation</label>
                <input type="password" name="password" id="password" placeholder="********" 
                       class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-xl font-bold hover:opacity-90 transition">
                Sign Up
            </button>
        </form>

        
    </div>
</div>

<?= $this->endSection() ?>

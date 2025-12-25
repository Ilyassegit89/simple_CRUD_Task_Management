
<?= $this->extend('layouts/superadmin_layout') ?>

<?= $this->section('superadmin_content') ?>

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manage Admins</h1>
        <p class="text-sm text-gray-500">View and manage admin accounts</p>
    </div>

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
                        <?php if (!empty($admins)): ?>
                            <?php foreach ($admins as $admin): ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">
                                                    <?= strtoupper(substr($admin['name'] ?? 'A', 0, 1)) ?>
                                                </span>
                                                
                                            </div>
                                            
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?= esc($admin['name'] ?? 'N/A') ?>
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    Total Members: <?= esc($admin['total_members']  ?? 0) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?= esc($admin['email'] ?? 'N/A') ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <?= date('M d, Y', strtotime($admin['created_at'] ?? 'now')) ?>
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            <?= date('H:i', strtotime($admin['created_at'] ?? 'now')) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            <?= date('M d, Y', strtotime($admin['updated_at'] ?? 'now')) ?>
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            <?= date('H:i', strtotime($admin['updated_at'] ?? 'now')) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($admin['is_approved']): ?>
                                            <span style="padding: 2px 8px; display: inline-flex; font-size: 12px; line-height: 1.5; font-weight: 600; border-radius: 9999px; background: #d1fae5; color: #065f46;">Approved</span>
                                        <?php else: ?>
                                            <span style="padding: 2px 8px; display: inline-flex; font-size: 12px; line-height: 1.5; font-weight: 600; border-radius: 9999px; background: #d7d7d7ee; color: #454545ff;">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div style="position: relative; display: inline-block;">
                                            <button type="button" 
                                                    onclick="toggleDropdown(<?= $admin['id'] ?? 0 ?>)"
                                                    style="display: inline-flex; justify-content: center; align-items: center; width: 32px; height: 32px; border-radius: 50%; border: none; background: transparent; cursor: pointer; transition: background 0.2s;"
                                                    onmouseover="this.style.background='#f3f4f6'" 
                                                    onmouseout="this.style.background='transparent'">
                                                <svg style="width: 20px; height: 20px; color: #6b7280;" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                                </svg>
                                            </button>

                                            <!-- Dropdown Menu -->
                                            <div id="dropdown-<?= $admin['id'] ?? 0 ?>" 
                                                 style="display: none; position: absolute; right: 0; margin-top: 8px; width: 192px; border-radius: 6px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); background: white; border: 1px solid #e5e7eb; z-index: 1000;">
                                                <div style="padding: 4px 0;">
                                                    <?php if (!isset($admin['is_approved']) || !$admin['is_approved']): ?>
                                                        <a href="javascript:void(0)" 
                                                           onclick="approveAdmin(<?= $admin['id'] ?? 0 ?>, this)"
                                                           style="display: flex; align-items: center; padding: 8px 16px; font-size: 14px; color: #059669; text-decoration: none; transition: background 0.2s; cursor: pointer;"
                                                           onmouseover="this.style.background='#f0fdf4'" 
                                                           onmouseout="this.style.background='transparent'">
                                                            <svg style="width: 16px; height: 16px; margin-right: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                            Approve Admin
                                                        </a>
                                                    <?php endif; ?>
                                                    
                                                    <a href="<?= base_url('superadmin/edit/' . ($admin['id'] ?? 0)) ?>" 
                                                       style="display: flex; align-items: center; padding: 8px 16px; font-size: 14px; color: #374151; text-decoration: none; transition: background 0.2s;"
                                                       onmouseover="this.style.background='#f3f4f6'" 
                                                       onmouseout="this.style.background='transparent'">
                                                        <svg style="width: 16px; height: 16px; margin-right: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        Edit Admin
                                                    </a>
                                                    
                                                    <a href="javascript:void(0)" 
                                                       onclick="deleteAdmin(<?= $admin['id'] ?? 0 ?>, this)"
                                                       style="display: flex; align-items: center; padding: 8px 16px; font-size: 14px; color: #dc2626; text-decoration: none; transition: background 0.2s; cursor: pointer;"
                                                       onmouseover="this.style.background='#fef2f2'" 
                                                       onmouseout="this.style.background='transparent'">
                                                        <svg style="width: 16px; height: 16px; margin-right: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Delete Admin
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
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
                                        <p class="text-gray-500 text-lg font-medium">No admins found</p>
                                        <p class="text-gray-400 text-sm mt-1">Start by adding a new admin</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>




<script>
function toggleDropdown(adminId) {
    const dropdown = document.getElementById('dropdown-' + adminId);
    const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
    
    // Close all other dropdowns
    allDropdowns.forEach(dd => {
        if (dd.id !== 'dropdown-' + adminId) {
            dd.style.display = 'none';
        }
    });
    
    // Toggle current dropdown
    if (dropdown.style.display === 'none' || dropdown.style.display === '') {
        dropdown.style.display = 'block';
    } else {
        dropdown.style.display = 'none';
    }
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    const isDropdownButton = event.target.closest('button[onclick^="toggleDropdown"]');
    if (!isDropdownButton) {
        const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
        allDropdowns.forEach(dd => dd.style.display = 'none');
    }
});

// Approve Admin via AJAX
function approveAdmin(adminId, element) {
    if (!confirm('Are you sure you want to approve this admin?')) {
        return;
    }
   
    
    // Close dropdown
    document.getElementById('dropdown-' + adminId).style.display = 'none';
    
    // Send AJAX request
    fetch('<?= base_url('superadmin/approve') ?>/' + adminId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {

        if (data.success) {

            // Find the status badge in this row
            const row = element.closest('tr');
            const statusCell = row.querySelector('td:nth-child(5)');
            
            // Update status badge to "Approved"
            statusCell.innerHTML = '<span style="padding: 2px 8px; display: inline-flex; font-size: 12px; line-height: 1.5; font-weight: 600; border-radius: 9999px; background: #d1fae5; color: #065f46;">Approved</span>';
            
            // Remove the approve option from dropdown
            element.remove();
            
            // Show success message
            showMessage('Admin approved successfully!', 'success');
        } else {
            showMessage(data.message || 'Failed to approve admin', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('An error occurred. Please try again.', 'error');
    });
}

// Delete Admin via AJAX
function deleteAdmin(adminId, element) {
    if (!confirm('Are you sure you want to delete this admin? This action cannot be undone.')) {
        return;
    }
    
    // Close dropdown
    document.getElementById('dropdown-' + adminId).style.display = 'none';
    
    // Send AJAX request
    fetch('<?= base_url('superadmin/delete') ?>/' + adminId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the row with fade out effect
            const row = element.closest('tr');
            row.style.transition = 'opacity 0.3s';
            row.style.opacity = '0';
            setTimeout(() => row.remove(), 300);
            
            // Show success message
            showMessage('Admin deleted successfully!', 'success');
        } else {
            showMessage(data.message || 'Failed to delete admin', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('An error occurred. Please try again.', 'error');
    });
}

// Show notification message
function showMessage(message, type) {
    const messageDiv = document.createElement('div');
    messageDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 500;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        z-index: 9999;
        animation: slideIn 0.3s ease-out;
    `;
    
    if (type === 'success') {
        messageDiv.style.background = '#d1fae5';
        messageDiv.style.color = '#065f46';
        messageDiv.style.borderLeft = '4px solid #10b981';
    } else {
        messageDiv.style.background = '#fee2e2';
        messageDiv.style.color = '#991b1b';
        messageDiv.style.borderLeft = '4px solid #ef4444';
    }
    
    messageDiv.textContent = message;
    document.body.appendChild(messageDiv);
    
    // Remove after 3 seconds
    setTimeout(() => {
        messageDiv.style.animation = 'slideOut 0.3s ease-in';
        setTimeout(() => messageDiv.remove(), 300);
    }, 3000);
}

// Add CSS animation
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);
</script>

<?= $this->endSection() ?>
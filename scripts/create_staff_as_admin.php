<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;

$admin = User::where('email', 'admin@example.com')->first();
if (! $admin) {
    echo "Admin user not found\n";
    exit(1);
}

// log in the admin for any auth checks
auth()->loginUsingId($admin->id);

$id = 'S_UI' . rand(1000, 9999);
$request = new Request([
    'staff_id' => $id,
    'first_name' => 'UI',
    'last_name' => 'Created',
    'position' => 'Staff',
]);

try {
    // Instantiate controller without running constructor (to avoid middleware setup)
    $ref = new ReflectionClass(App\Http\Controllers\StaffController::class);
    $controller = $ref->newInstanceWithoutConstructor();

    // Call the store method directly
    $controller->store($request);

    $exists = Staff::where('staff_id', $id)->exists();
    echo 'created ' . $id . " exists:" . ($exists ? 'yes' : 'no') . "\n";
} catch (Throwable $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}

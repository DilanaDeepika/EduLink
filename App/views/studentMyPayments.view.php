<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/css/studentMyPayments.css?v=1.1">
    <link rel="stylesheet" href="../../Public/assets/css/component/StudentProfileHeader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include __DIR__ . '/Component/studentProfileHeader.view.php';?>

    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar">

            <nav class="sidebar-nav">
                <a href="../views/studentProfileMain.view.php" class="sidebar-item">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a>
                <a href="../views/studentEditProfile.view.php" class="sidebar-item">
                    <i class="fa-regular fa-user"></i>
                    <span>Edit Profile</span>
                </a>
                <a href="../views/studentMyCourses.view.php" class="sidebar-item">
                    <i class="fa-solid fa-book-open"></i>
                    <span>My Courses</span>
                </a>
                <a href="../views/studentMyPayments.view.php" class="sidebar-item active">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>My Payments</span>
                </a>
                <a href="../views/studentMyCalendar.view.php" class="sidebar-item">
                    <i class="fa-regular fa-calendar"></i>
                    <span>My Calendar</span>
                </a>
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="main-content">
            <div class="container">
                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title"><i class="fa-solid fa-credit-card"></i> My Payments</h1>
                    <p class="page-subtitle">View your payment history and download invoices</p>
                </div>

                <!-- Stats Cards -->
                <div class="stats-box">
                    <div class="stat-card">
                        <div class="stat-content">
                            <div class="stat-info">
                                <p class="stat-label">Total Spent</p>
                                <h2 class="stat-value">Rs.7000</h2>
                            </div>
                            <div class="stat-icon stat-icon-blue">
                                <i class="fa-solid fa-credit-card"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-content">
                            <div class="stat-info">
                                <p class="stat-label">This Month</p>
                                <h2 class="stat-value">Rs.28000</h2>
                            </div>
                            <div class="stat-icon stat-icon-orange">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment History -->
                <div class="payment-history">
                    <h2 class="section-title">Payment History</h2>
                    
                    <div class="table-container">
                        <table class="payment-table">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Class ID</th>
                                    <th>Class</th>
                                    <th>Date</th>
                                    <th>Method</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="invoice-id">INV-2024-001</td>
                                    <td>PS-2003</td>
                                    <td>Physics</td>
                                    <td>Jan 15, 2025</td>
                                    <td>Credit Card</td>
                                    <td class="amount">Rs.2500</td>
                                    <td><span class="status-badge status-completed">Completed</span></td>
                                    <td>
                                        <button class="btn-invoice">
                                            <i class="fa-solid fa-download"></i>
                                            Invoice
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="invoice-id">INV-2024-005</td>
                                    <td>ES-2045</td>
                                    <td>Economics</td>
                                    <td>Feb 28, 2025</td>
                                    <td>Bank Transfer</td>
                                    <td class="amount">Rs.1500</td>
                                    <td><span class="status-badge status-pending">Pending</span></td>
                                    <td>
                                        <button class="btn-invoice">
                                            <i class="fa-solid fa-download"></i>
                                            Invoice
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="invoice-id">INV-2024-008</td>
                                    <td>CH-2029</td>
                                    <td>Chemistry</td>
                                    <td>Jun 14, 2025</td>
                                    <td>Credit Card</td>
                                    <td class="amount">Rs.3000</td>
                                    <td><span class="status-badge status-completed">Completed</span></td>
                                    <td>
                                        <button class="btn-invoice">
                                            <i class="fa-solid fa-download"></i>
                                            Invoice
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

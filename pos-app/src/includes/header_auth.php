<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>POS App</title>

    <!-- ✅ Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .navbar-custom {
            background: #2c3e50 !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            border-bottom: 3px solid #3498db;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .navbar-brand i {
            margin-right: 12px;
            color: #3498db;
            font-size: 2rem;
        }

        .navbar-text {
            color: #ecf0f1 !important;
            font-size: 0.9rem;
            margin-left: 20px;
        }

        .user-badge {
            background: #34495e;
            border-radius: 20px;
            padding: 8px 16px;
            color: #ecf0f1;
            border: 2px solid #3498db;
        }

        .user-badge i {
            color: #3498db;
            margin-right: 8px;
        }

        .btn-logout {
            background: #e74c3c;
            border: none;
            border-radius: 20px;
            padding: 8px 16px;
            margin-left: 15px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .time-info {
            color: #bdc3c7;
            font-size: 0.85rem;
            text-align: right;
        }

        .btn-login {
            background: #27ae60;
            border: none;
            border-radius: 20px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #229954;
            transform: translateY(-2px);
        }

        .user-section {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand text-white d-flex align-items-center" href="#">
                <i class="bi bi-shop-window"></i>
                POS App
            </a>

            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon text-white"></span>
            </button>

            <div class="user-section">
                <div class="time-info me-3 text-end">
                    <div id="currentTime"></div>
                    <div id="currentDate"></div>
                </div>
            </div>
        </div>
        </div>
    </nav>

    <script>
        function updateDateTime() {
            const now = new Date();
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            document.getElementById('currentTime').textContent = now.toLocaleTimeString('id-ID', timeOptions);
            document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', dateOptions);
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
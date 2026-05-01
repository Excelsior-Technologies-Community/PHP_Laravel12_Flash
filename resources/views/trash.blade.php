<!DOCTYPE html>
<html>

<head>
    <title>Trash Messages</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 900px;
            margin-top: 60px;
        }

        .card {
            border-radius: 20px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-weight: bold;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .message-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 12px;
            transition: 0.3s;
        }

        .message-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .msg-text {
            font-weight: 500;
            color: #333;
        }

        .btn-group {
            display: flex;
            gap: 8px;
        }

        .btn-custom {
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 13px;
        }

        .empty-box {
            text-align: center;
            padding: 40px;
            color: #888;
        }

        .back-btn {
            margin-top: 20px;
            display: block;
            width: 150px;
            margin-left: auto;
            margin-right: auto;
        }

        #flash-msg {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card">

            <h2 class="text-center">🗑 Trash Messages</h2>
            <p class="subtitle text-center">Manage deleted flash messages</p>

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success" id="flash-msg">
                    {{ session('success') }}
                </div>
            @endif

            <script>
                setTimeout(() => {
                    let msg = document.getElementById('flash-msg');
                    if (msg) msg.style.display = 'none';
                }, 3000);
            </script>

            {{-- LIST --}}
            @forelse($messages as $msg)
                <div class="message-box">

                    <span class="msg-text">{{ $msg->message }}</span>

                    <div class="btn-group">

                        <button onclick="restoreConfirm({{ $msg->id }})" class="btn btn-success btn-sm btn-custom">
                            Restore
                        </button>

                        <button onclick="deleteConfirm({{ $msg->id }})" class="btn btn-danger btn-sm btn-custom">
                            Delete
                        </button>

                    </div>

                </div>
            @empty
                <div class="empty-box">
                    <h5>No messages in trash 😌</h5>
                </div>
            @endforelse

            <a href="/" class="btn btn-dark back-btn">⬅ Back</a>

        </div>

    </div>

    {{-- SWEET ALERT --}}
    <script>
        function restoreConfirm(id) {
            Swal.fire({
                title: 'Restore message?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes, restore'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/restore/' + id;
                }
            });
        }

        function deleteConfirm(id) {
            Swal.fire({
                title: 'Delete permanently?',
                text: "This cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes, delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/force-delete/' + id;
                }
            });
        }
    </script>

</body>

</html>
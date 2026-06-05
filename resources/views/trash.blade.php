<!DOCTYPE html>
<html>
<head>
    <title>Trash Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { background: linear-gradient(135deg, #667eea, #764ba2); font-family: 'Segoe UI', sans-serif; }
        .container { max-width: 900px; margin-top: 60px; }
        .card { border-radius: 20px; padding: 30px; background: rgba(255, 255, 255, 0.95); box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); }
        .message-box { display: flex; justify-content: space-between; align-items: center; background: #f8f9fa; padding: 15px 20px; border-radius: 12px; margin-bottom: 12px; }
        .btn-custom { border-radius: 8px; padding: 5px 12px; font-size: 13px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center">🗑 Trash Messages</h2>
            
            <div class="mb-3 text-center">
                <button id="bulk-restore" class="btn btn-success btn-sm btn-custom">Bulk Restore</button>
                <button id="bulk-force-delete" class="btn btn-danger btn-sm btn-custom">Bulk Delete Permanently</button>
            </div>

            @forelse($messages as $msg)
                <div class="message-box">
                    <div>
                        <input type="checkbox" class="msg-checkbox" value="{{ $msg->id }}">
                        <span class="ms-3">{{ $msg->message }}</span>
                    </div>
                    <div class="btn-group">
                        <button onclick="window.location.href='/restore/{{ $msg->id }}'" class="btn btn-success btn-sm btn-custom">Restore</button>
                        <button onclick="window.location.href='/force-delete/{{ $msg->id }}'" class="btn btn-danger btn-sm btn-custom">Delete</button>
                    </div>
                </div>
            @empty
                <div class="text-center p-4"><h5>No messages in trash 😌</h5></div>
            @endforelse

            <a href="/" class="btn btn-dark mt-3 d-block mx-auto" style="width: 150px;">⬅ Back</a>
        </div>
    </div>

    <script>
        $('#bulk-restore').click(function() {
            let ids = $('.msg-checkbox:checked').map(function() { return $(this).val(); }).get();
            if(ids.length > 0) {
                $.post("/bulk-restore", { _token: "{{ csrf_token() }}", ids: ids }, function() { location.reload(); });
            } else { alert('Select at least one!'); }
        });

        $('#bulk-force-delete').click(function() {
            let ids = $('.msg-checkbox:checked').map(function() { return $(this).val(); }).get();
            if(ids.length > 0) {
                Swal.fire({ title: 'Delete permanently?', icon: 'warning', showCancelButton: true }).then((res) => {
                    if(res.isConfirmed) {
                        $.post("/bulk-force-delete", { _token: "{{ csrf_token() }}", ids: ids }, function() { location.reload(); });
                    }
                });
            } else { alert('Select at least one!'); }
        });
    </script>
</body>
</html>
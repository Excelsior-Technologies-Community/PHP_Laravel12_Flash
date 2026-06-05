<!DOCTYPE html>
<html>
<head>
    <title>Flash Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { background: linear-gradient(135deg, #667eea, #764ba2); font-family: 'Segoe UI', sans-serif; }
        .container { max-width: 1000px; margin-top: 50px; }
        .card { border-radius: 20px; padding: 30px; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); background: #fff; }
        .btn-custom { border-radius: 10px; padding: 8px 15px; font-weight: 600; transition: 0.3s; }
        .search-box { display: flex; gap: 10px; }
        #flash-msg { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center mb-4">🚀 Flash Messages Dashboard</h2>

            @foreach (['success', 'error', 'warning', 'info'] as $type)
                @if(session($type))
                    <div id="flash-msg" class="alert alert-{{ $type == 'error' ? 'danger' : $type }}">
                        {{ session($type) }}
                    </div>
                @endif
            @endforeach

            <script>
                setTimeout(() => {
                    let msg = document.getElementById('flash-msg');
                    if (msg) msg.style.display = 'none';
                }, 3000);
            </script>

            <div class="mb-4 text-center">
                <a href="/success" class="btn btn-success btn-custom">Success</a>
                <a href="/error" class="btn btn-danger btn-custom">Error</a>
                <a href="/warning" class="btn btn-warning btn-custom">Warning</a>
                <a href="/info" class="btn btn-info btn-custom">Info</a>
                <a href="/trash" class="btn btn-dark btn-custom">Trash</a>
                <button id="bulk-delete" class="btn btn-outline-danger btn-custom">Bulk Delete</button>
            </div>

            <form method="GET" class="mb-4">
                <div class="search-box">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search message..." class="form-control">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>

            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>ID</th>
                        <th>Message</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr>
                            <td><input type="checkbox" class="msg-checkbox" value="{{ $msg->id }}"></td>
                            <td>{{ $msg->id }}</td>
                            <td>{{ $msg->message }}</td>
                            <td>
                                <span class="badge bg-{{ $msg->type == 'danger' ? 'danger' : $msg->type }}">
                                    {{ $msg->type }}
                                </span>
                            </td>
                            <td>
                                <a href="/delete/{{ $msg->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No messages found</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">{{ $messages->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>

    <script>
        $('#select-all').click(function() {
            $('.msg-checkbox').prop('checked', this.checked);
        });

        $('#bulk-delete').click(function() {
            let ids = $('.msg-checkbox:checked').map(function() { return $(this).val(); }).get();
            if(ids.length > 0) {
                $.post("{{ route('flash.bulkDelete') }}", {
                    _token: "{{ csrf_token() }}",
                    ids: ids
                }, function(res) {
                    location.reload();
                });
            } else {
                alert('Select at least one!');
            }
        });
    </script>
</body>
</html>
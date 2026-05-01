<!DOCTYPE html>
<html>

<head>
    <title>Flash Messages</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 1000px;
            margin-top: 50px;
        }

        .card {
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            background: #fff;
        }

        h2 {
            font-weight: bold;
            color: #333;
        }

        /* Buttons */
        .btn-custom {
            border-radius: 10px;
            padding: 8px 15px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Table */
        table {
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #343a40;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }

        /* Search */
        .search-box {
            display: flex;
            gap: 10px;
        }

        /* Pagination */
        .pagination {
            justify-content: center;
        }

        .page-link {
            border-radius: 8px;
            margin: 0 3px;
        }

        /* Flash */
        #flash-msg {
            animation: fadeIn 0.5s ease-in-out;
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

            <h2 class="text-center mb-4">🚀 Flash Messages Dashboard</h2>

            {{-- FLASH --}}
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

            {{-- BUTTONS --}}
            <div class="mb-4 text-center">
                <a href="/success" class="btn btn-success btn-custom">Success</a>
                <a href="/error" class="btn btn-danger btn-custom">Error</a>
                <a href="/warning" class="btn btn-warning btn-custom">Warning</a>
                <a href="/info" class="btn btn-info btn-custom">Info</a>
                <a href="/trash" class="btn btn-dark btn-custom">Trash</a>
            </div>

            {{-- SEARCH --}}
            <form method="GET" class="mb-4">
                <div class="search-box">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search message..."
                        class="form-control">

                    <button class="btn btn-primary">Search</button>
                </div>
            </form>

            {{-- TABLE --}}
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Message</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($messages as $msg)
                        <tr>
                            <td>{{ $msg->id }}</td>
                            <td>{{ $msg->message }}</td>
                            <td>
                                <span class="badge bg-{{ $msg->type == 'danger' ? 'danger' : $msg->type }}">
                                    {{ $msg->type }}
                                </span>
                            </td>
                            <td>
                                <a href="/delete/{{ $msg->id }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this message?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No messages found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- PAGINATION (NUMBERED) --}}
            <div class="mt-3">
                {{ $messages->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>

</body>

</html>
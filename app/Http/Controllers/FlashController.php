<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlashMessage;

class FlashController extends Controller
{
    public function index(Request $request)
    {
        $query = FlashMessage::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('message', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('type', 'LIKE', '%' . $request->search . '%');
            });
        }

        $messages = $query->orderBy('created_at', 'asc')->paginate(4);

        return view('flash-demo', compact('messages'));
    }

    public function success()
    {
        $msg = 'Success message! Data saved successfully.';

        session()->flash('success', $msg);

        FlashMessage::create([
            'message' => $msg,
            'type' => 'success'
        ]);

        return back();
    }

    public function error()
    {
        $msg = 'Error message! Something went wrong.';

        session()->flash('error', $msg);

        FlashMessage::create([
            'message' => $msg,
            'type' => 'danger'
        ]);

        return back();
    }

    public function warning()
    {
        $msg = 'Warning message! Please check your input.';

        session()->flash('warning', $msg);

        FlashMessage::create([
            'message' => $msg,
            'type' => 'warning'
        ]);

        return back();
    }

    public function info()
    {
        $msg = 'Info message! This is an informational alert.';

        session()->flash('info', $msg);

        FlashMessage::create([
            'message' => $msg,
            'type' => 'info'
        ]);

        return back();
    }

    public function destroy($id)
    {
        FlashMessage::findOrFail($id)->delete();
        return back()->with('success', 'Moved to trash successfully');
    }

    public function trash()
    {
        $messages = FlashMessage::onlyTrashed()->get();
        return view('trash', compact('messages'));
    }

    public function restore($id)
    {
        FlashMessage::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Message restored successfully');
    }
}
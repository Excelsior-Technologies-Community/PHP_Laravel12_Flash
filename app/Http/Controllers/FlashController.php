<?php

namespace App\Http\Controllers;

class FlashController extends Controller
{
    public function index()
    {
        return view('flash-demo');
    }

    public function success()
    {
        flash('Success message! Data saved successfully.', 'alert alert-success');
        return redirect()->back();
    }

    public function error()
    {
        flash('Error message! Something went wrong.', 'alert alert-danger');
        return redirect()->back();
    }

    public function warning()
    {
        flash('Warning message! Please check your input.', 'alert alert-warning');
        return redirect()->back();
    }

    public function info()
    {
        flash('Info message! This is an informational alert.', 'alert alert-info');
        return redirect()->back();
    }
}
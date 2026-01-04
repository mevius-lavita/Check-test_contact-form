<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\Events\Login;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function store(UserRequest $request)
    {
        $users = $request->only(['name', 'email', 'password']);
        $users['password'] = Hash::make($users['password']);
        $user = User::create($users);
        Auth::login($user);
        return redirect('/admin');
    }
    public function admin()
    {
        $contacts = Contact::with('category')->paginate(7);

        $categories = Category::all();

        $genderMap = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        return view('admin', compact('contacts', 'categories', 'genderMap'));
    }
    public function search(Request $request)
    {
        $contacts = Contact::with('category')
            ->when($request->keyword, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('first_name', 'like', '%' . $request->keyword . '%')
                        ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                        ->orWhere('email', 'like', '%' . $request->keyword . '%');
                });
            })
            ->when($request->gender, fn($q) => $q->where('gender', $request->gender))
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->when($request->date, fn($q) => $q->whereDate('created_at', $request->date))
            ->paginate(7)
            ->withQueryString();

        $categories = Category::all();

        $genderMap = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        return view('admin', compact('contacts', 'categories', 'genderMap'));
    }
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect('/admin');
    }
    public function showLogin()
    {
        return view('login');
    }
    public function remove(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
    public function export()
    {
        $contacts = Contact::with('category')
            ->when(request('keyword'), function ($q) {
                $q->where(function ($qq) {
                    $qq->where('email', 'like', '%' . request('keyword') . '%')
                        ->orWhere('first_name', 'like', '%' . request('keyword') . '%')
                        ->orWhere('last_name', 'like', '%' . request('keyword') . '%');
                });
            })
            ->when(request('gender'), function ($q) {
                $q->where('gender', request('gender'));
            })
            ->when(request('category_id'), function ($q) {
                $q->where('category_id', request('category_id'));
            })
            ->when(request('date'), function ($q) {
                $q->whereDate('created_at', request('date'));
            })
            ->get();

        $headings = [
            '名前',
            '性別',
            'メール',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせ種類',
            '内容',
        ];

        return Excel::download(
            new ExcelExport($contacts, $headings),
            'contacts.xlsx'
        );
    }
}
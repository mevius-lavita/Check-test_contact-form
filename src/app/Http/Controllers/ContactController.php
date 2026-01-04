<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
       $categories = Category::all();

       return view('index', compact( 'categories'));
    }
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'detail',
            'category_id',
        ]);

        $contact['tel'] =
            $request->tel1 .
            $request->tel2 .
            $request->tel3;

        $genderMap = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        $displayGender = $genderMap[$contact['gender']];
        $category = Category::find($contact['category_id']);

        return view('confirm', compact('contact', 'category', 'displayGender'));
    }
    public function store(Request $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'detail',
            'category_id',
        ]);

        $contact['tel'] =
            $request->tel1 .
            $request->tel2 .
            $request->tel3;

        Contact::create($contact);

        return view('thanks');
    }
}
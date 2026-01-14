<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {

        $categories = Category::all();

        $contact = $request->all();

        return view('confirm', compact('contact', 'categories'));
    }

    public function store(Request $request)
    {
        $tel = $request->tel_1 . $request->tel_2 . $request->tel_3;

        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'address',
            'building',
            'categry_id',
            'detail'
        ]);
        $contact['tel'] = $tel;

        Contact::create($contact);

        return view('thanks');
    }
}

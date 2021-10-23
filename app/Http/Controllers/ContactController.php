<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function submit(ContactRequest $req) {
        // return "Okey123";
        // dd($req);
        // dd($req->input('subject'));
        // $validation = $req->validate([
        //     'subject' => 'required|min:5|max:50',
        //     'message' => 'required|min:15|max:500'
        // ]);
        $contact = new Contact();
        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');

        $contact->save();

        return redirect()->route('home')->with('success','Сообщение было добавлено');
    }

    public function allData() {
        $contact = new Contact;
        return view('messages', ['data' => $contact->all()]);
    }

    public function showOneMessage($id) {
        $contact = new Contact;
        return view('one-messages', ['data' => $contact->find($id)]);
    }

    public function updateMessage($id) {
        $contact = new Contact;
        return view('update-messages', ['data' => $contact->find($id)]);
    }

    public function updateMessageSubmit($id, ContactRequest $req) {
        $contact = Contact::find($id);
        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');

        $contact->save();

        return redirect()->route('contact-data-one', $id)->with('success','Сообщение было обновлено');
    }

    public function deleteMessage($id) {
        Contact::find($id)->delete();
        return redirect()->route('contact-data', $id)->with('success','Сообщение было удалено');

    }


}

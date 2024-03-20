<?php

namespace App\Http\Controllers;

use App\Models\ContactSection;
use Illuminate\Http\Request;

class ContactSectionController extends Controller
{
    public function edit()
    {
        $contact_section = ContactSection::first();
        return view('back.sections.contact_section.create', compact('contact_section'));
    }

    public function update(Request $request)
    {
        $contact = ContactSection::first();

        if (!$contact) {
            $contact = new ContactSection();
        }

        $contact->content = $request->content;
        $contact->save();

        return redirect()->route('contact.section')->with('success', 'Contact section update successfully');
    }
}

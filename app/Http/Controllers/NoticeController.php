<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    


    function edit() {
        $notice = Notice::first();

        return view('back.notice.edit', compact('notice'));
    }

    function update(Request $request) {
     
        $notice = Notice::first();

        if(!$notice) {
            $notice = new Notice();
        }

        $notice->content = $request->content;
        $notice->status = $request->status;
        
        
        $notice->save();
        return redirect()->route('notice.edit')->with('success', 'Notice updated successfully');
    }


    
}



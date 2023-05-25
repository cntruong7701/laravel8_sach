<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Sach;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function store(Request $request): RedirectResponse
    {

        // $sach = Sach::orderBy('id', 'DESC')->get();
        $data = $request->all();
        $comment = new Comments();

        $comment->sach_id = $data['tenSach'];
        $comment->author = $data['author'];
        $comment->text = $data['text'];
        $comment->save();

        return back();
    }

    public function index()
    {
        $comment = Comments::orderBy('id', 'DESC')->get();
        return view('admincp.comment.index')->with(compact('comment'));
    }

    public function destroy($id)
    {
        //
        Comments::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa thành công');
    }
}

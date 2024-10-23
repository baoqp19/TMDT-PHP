<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{

    public function index()
    {
        $comments =  Comment::with('user')->get();
        return view('admin.comment.list')->with(compact(['comments']));
    }

    public function get_not_confirm()
    {
        $comments =  Comment::with('user')->where('status', 0)->get();
        return view('admin.comment.not-confirm')->with(compact(['comments']));
    }

    public function set_confirm($id)
    {
        Comment::where('id', $id)->update(['status' => 1]);
        return back();
    }

    public function store(CommentRequest $req)
    {
        Log::info($req->all());
        $comment = new Comment;
        $comment->user_id = Auth::user()->id; // Gán user_id từ người dùng đã đăng nhập
        $comment->product_id = $req->product_id; // Gán product_id từ request
        $comment->comment = $req->comment; // Gán comment từ request
        $comment->star = $req->star; // Gán số sao từ request
        $comment->save(); // Lưu bình luận vào database

        return response()->json(['success' => true, 'message' => 'Bình luận đã được lưu thành công!']);
    }


    public function update(CommentRequest $req)
    {
        Comment::where([
            'user_id' => Auth::user()->id,
            'product_id' => $req->product_id,
        ])->update($req->only(['product_id', 'comment', 'star']));
    }

    public function delete(Request $req)
    {
        Comment::find($req->id)->delete();
    }
}

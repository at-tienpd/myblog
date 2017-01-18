<?php

namespace App\Http\Controllers\Like;

use App\Models\Like;
use Auth;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    /**
     * Action like post
     *
     * @param int $id id post
     *
     * @return \Illuminate\Http\Response
     */
    public function likePost($id)
    {
        $this->handleLike('App\Models\Post', $id);
        return redirect()->back();
    }

    /**
     * Action like comment
     *
     * @param int $id id comment
     *
     * @return \Illuminate\Http\Response
     */
    public function likeComment($id)
    {
        $this->handleLike('App\Models\Comment', $id);
        return redirect()->back();
    }
    
    /**
     * Handle action like in model
     *
     * @param string $type type model
     * @param int    $id   id model
     *
     * @return App\Models\Like
     */
    public function handleLike($type, $id)
    {
        $existingLike = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($id)->whereUserId(Auth::id())->first();

        if (is_null($existingLike)) {
            Like::create([
                'user_id'       => Auth::id(),
                'likeable_id'   => $id,
                'likeable_type' => $type,
            ]);
        } else {
            if (is_null($existingLike->deleted_at)) {
                $existingLike->delete();
            } else {
                $existingLike->restore();
            }
        }
    }
}

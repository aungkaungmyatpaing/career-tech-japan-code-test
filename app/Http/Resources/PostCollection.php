<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class PostCollection extends ResourceCollection
{
    public function toArray(Request $request): Collection
{
    return $this->collection->transform(function ($post) {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'description' => $post->description,
            'created_at' => $post->created_at,
            'like_counts' => $post->likes_count,
            'tags' => TagResource::collection($post->tags),
            'user' => new PostAuthorResource($post->author),
        ];
    });
}
}

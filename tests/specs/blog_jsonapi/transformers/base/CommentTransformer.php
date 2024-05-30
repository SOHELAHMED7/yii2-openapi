<?php
namespace app\transformers\base;

use League\Fractal\TransformerAbstract;
use app\models\Comment;
use app\transformers\PostTransformer;
use app\transformers\UserTransformer;

class CommentTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['post', 'user'];
    protected array $defaultIncludes = [];

    public function transform(Comment $model)
    {
        return $model->getAttributes();
    }

    public function includePost(Comment $model)
    {
        $relation = $model->post;
        if ($relation === null) {
            return $this->null();
        }
        $transformer = new PostTransformer();
        return $this->item($relation, $transformer, 'posts');
    }

    public function includeUser(Comment $model)
    {
        $relation = $model->user;
        if ($relation === null) {
            return $this->null();
        }
        $transformer = new UserTransformer();
        return $this->item($relation, $transformer, 'users');
    }
}

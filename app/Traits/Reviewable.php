<?php

namespace App\Traits;
use App\Review;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Reviewable.
 */
trait Reviewable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
    /**
     * @param $data
     * @param Model      $author
     * @param Model|null $parent
     *
     * @return static
     */
    public function review($data, Model $author, Model $parent = null)
    {
        return (new Review())->createReview($this, $data, $author);
    }
    /**
     * @param $id
     * @param $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateReview($id, $data, Model $parent = null)
    {
        return (new Review())->updateReview($id, $data);
    }
    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteReview($id)
    {
        return (new Review())->deleteReview($id);
    }
}
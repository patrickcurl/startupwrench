<?php
/*
 * This file is part of Laravel Reviewable.
 *
 * (c) PackageBackup <hello@draperstud.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Contracts;
use Illuminate\Database\Eloquent\Model;
/**
 * Interface Reviewable.
 */
interface Reviewable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviews();
    /**
     * @param $data
     * @param Model      $author
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function review($data, Model $author, Model $parent = null);
    /**
     * @param $id
     * @param $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateReview($id, $data, Model $parent = null);
    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteReview($id);
}
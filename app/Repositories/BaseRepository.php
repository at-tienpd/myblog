<?php
/**
* Base Repository
*/
namespace App\Repositories;

abstract class BaseRepository
{
    /**
     * The Model instance
     *
     * @param \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Get all record
     *
     * @param array $columns name column
     *
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }
 
    /**
     * Get paged items
     *
     * @param int   $perPage perPage perPage
     * @param array $columns columns columns
     *
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }
 
    /**
     * Create new using mass assignment
     *
     * @param array $data data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
 
    /**
     * Update item by its id
     *
     * @param array  $data      data
     * @param int    $id        id
     * @param string $attribute attribute
     *
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }
 
    /**
     * Delete item by its id
     *
     * @param int $id id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
 
    /**
     * Get item by its id
     *
     * @param int   $id      id
     * @param array $columns columns
     *
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->findOrFail($id, $columns);
    }
 
    /**
     * Get item by its attribute
     *
     * @param string $attribute attribute
     * @param string $value     value
     * @param array  $columns   columns
     *
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->firstOrFail($columns);
    }
}

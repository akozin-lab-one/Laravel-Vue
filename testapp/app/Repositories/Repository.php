<?php
namespace App\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\RepositoryInterface;

abstract class Repository implements RepositoryInterface{
    protected $model;

    public function __construct(){
        $this->makeModel();
    }

    abstract public function model();

    abstract public function create(Request $request);

    abstract public function update(Request $request);

    abstract public function create_validation($data);

    abstract public function update_validation($data);

    abstract public function find($id);

    abstract public function get();

    public function makeModel() : Model {
        return $this->model = App::make($this->model());
    }
}

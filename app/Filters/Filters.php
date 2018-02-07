<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;
    protected $filters = [];

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function apply($builder){
        $this->builder = $builder;
        // dd($this->filterExists());
        foreach ($this->filterExists() as $filter => $value){
            if(method_exists($this, $filter)){
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    protected function filterExists(){
        return $this->request->only($this->filters);
        // request ada, filter tak = null
        // request ada, filter ada = filter
        // request tak, filter tak = null
    }
}

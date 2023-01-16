<?php

namespace App\Http\Livewire\Category;

use App\Models\CategoryProduct;
use App\Traits\DataTable;
use Livewire\Component;

class CategoryTable extends Component
{
    use DataTable;

    public $showFilters = false;

    protected $listeners = ['refreshList'=> '$refresh','delete'];  

    protected $queryString = ['search'=> ['except' => '']];  

    public $filters = ['fromDate' => null, 'toDate' => null];

    public function mount(){ $this->sortField = 'id';}

    public function showFilter(){ $this->showFilters = $this->showFilters ? false : true; }

    public function render(){
        // sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.category.category-table',[
            'categories' => CategoryProduct::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'],fn($q, $created_at) => $q->whereBetween('created_at',[$this->filters['fromDate'].' 00:00:00',$this->filters['toDate'].' 23:59:00']))
            ->search('name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage),
            ])->extends('layouts.admin.app')->section('content');
    }
    
    public function delete(CategoryProduct $categoryProduct){ $categoryProduct->delete(); }
}

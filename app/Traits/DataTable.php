<?php

namespace App\Traits;

use Livewire\WithPagination;

trait DataTable {

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    
    public $perPage = 5 ;
    
    public $sortField;
    
    public $sortDirection = 'asc';

    public function sortBy($field){

        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;

    }
    

}
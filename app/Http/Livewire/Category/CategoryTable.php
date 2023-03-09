<?php

namespace App\Http\Livewire\Category;

use App\Models\CategoryProduct;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;

class CategoryTable extends Component
{
    use DataTable;

    public $showFilters = false;
    public $selected = [];
    public $selectedPage = false;
    protected $listeners = ['refreshList' => '$refresh', 'delete', 'deleteSelected', 'exportSelected'];

    protected $queryString = ['search' => ['except' => '']];

    public $filters = ['fromDate' => null, 'toDate' => null];

    public function mount()
    {
        $this->sortField = 'id';
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }


    public function getCategoriesProperty()
    {
        return  CategoryProduct::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('created_at', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d') . ' 00:00:00', Carbon::parse($this->filters['toDate'])->format('Y-m-d') . ' 23:59:00']))
            ->search('name', $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }
    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.category.category-table', [
            'categories' => $this->categories,
        ])->extends('layouts.admin.app')->section('content');
    }
    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function delete(CategoryProduct $categoryProduct)
    {
        $categoryProduct->delete();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->categories->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo CategoryProduct::whereKey($this->selected)->toCsv();
        }, 'categorias_productos.csv');
        $this->selected = [];
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $categories = CategoryProduct::whereKey($this->selected);
        $categories->delete();
        $this->selected = [];
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }
}

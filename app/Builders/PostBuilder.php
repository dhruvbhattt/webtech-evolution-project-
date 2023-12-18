<?php

namespace App\Builders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PostBuilder extends Builder
{
    public function wherePropertyName($propertyName)
    {
        return $this->where('property_name', 'like', '%' . $propertyName . '%');
    }

    public function whereCategoryId($categoryId)
    {
        return $this->where('category_id', $categoryId);
    }

    public function whereSubCategoryId($subCategoryId)
    {
        return $this->where('sub_category_id', $subCategoryId);
    }

    public function whereOrder($orderByField, $orderBy)
    {
        return $this->orderBy($orderByField, $orderBy);
    }

    public function whereGuests($guests)
    {
        return $this->where('no_of_guests', $guests);
    }

    public function whereCreatedAtBetween($startDate, $endDate)
    {
        return $this->whereBetween('available_date', [$startDate, $endDate]);
    }

    public function paginateData($limit)
    {
        if ($limit == 'all') {
            return $this->get();
        }

        return $this->paginate($limit);
    }

    public function applyFilters(array $filters)
    {
        $filters = collect($filters);

        if ($filters->get('property_name')) {
            $this->wherePropertyName($filters->get('property_name'));
        }

        if ($filters->get('category_id')) {
            $this->whereCategoryId($filters->get('category_id'));
        }

        if ($filters->get('sub_category_id')) {
            $this->whereSubCategoryId($filters->get('sub_category_id'));
        }

        if ($filters->get('no_of_guests')) {
            $this->whereGuests($filters->get('no_of_guests'));
        }

        if ($filters->get('start_date') && $filters->get('end_date')) {
            $startDate = Carbon::createFromFormat('Y-m-d', $filters->get('start_date'))->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $filters->get('end_date'))->endOfDay();
            $this->whereCreatedAtBetween($startDate, $endDate);
        }

        if ($filters->get('orderByField') || $filters->get('orderBy')) {
            $field = $filters->get('orderByField') ? $filters->get('orderByField') : 'property_name';
            $orderBy = $filters->get('orderBy') ? $filters->get('orderBy') : 'asc';
            $this->whereOrder($field, $orderBy);
        }

        return $this;
    }
}

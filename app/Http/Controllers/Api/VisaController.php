<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisaCategory;
use App\Models\VisaSubCategory;

class VisaController extends Controller
{
    public function visa_category_list()
    {
        $visaCategories  = VisaCategory::where('publish_is', 2)->latest()->get();
        return $this->success(true, 'Visa Category Data retrieved successfully!', $visaCategories);
    }

    public function visa_category_details($id)
    {
        $visaCategory = VisaCategory::with([
            'sub_category.table_of_content'
        ])->where('publish_is', 2)->where('id', $id)->first();

        return $this->success(true, 'Visa Category Details Data retrieved successfully!', $visaCategory);
    }

    public function visa_sub_category_details($visaSubCategoryId)
    {
        $visaSubCategories  = VisaSubCategory::with('table_of_content')
            ->where('id', $visaSubCategoryId)
            ->where('publish_is', 2)
            ->latest()
            ->first();

        return $this->success(true, 'Visa Sub Category Data retrieved successfully!', $visaSubCategories);
    }
}

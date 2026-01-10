<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisaCategory;
use App\Models\VisaSubCategory;
use Illuminate\Support\Facades\Cache;

class VisaController extends Controller
{
    public function visa_category_list()
    {
        $visaCategories  = VisaCategory::where('publish_is', 2)->latest()->get();
        return $this->success(true, 'Visa Category Data retrieved successfully!', $visaCategories);
    }

    public function visa_category_details($randomId)
    {
        // $decoded = base64_decode($randomId);
        // if (!str_contains($decoded, '|')) {
        //     return $this->error('Invalid ID');
        // }
        // [$id, $salt] = explode('|', $decoded);
        $visaCategory = VisaCategory::with([
            'main_table_of_content',
            'sub_category.table_of_content'
        ])->where('publish_is', 2)->where('id', $randomId)->first();

        if (empty($visaCategory)) {
            return $this->error('Data Not found');
        }

        return $this->success(true, 'Visa Category Details Data retrieved successfully!', $visaCategory);
    }

    public function visa_sub_category_details($randomId)
    {
        // $decoded = base64_decode($randomId);
        // if (!str_contains($decoded, '|')) {
        //     return $this->error('Invalid ID');
        // }
        // [$id, $salt] = explode('|', $decoded);

        $visaSubCategories  = VisaSubCategory::with('table_of_content')
            ->where('id', $randomId)
            ->where('publish_is', 2)
            ->first();

        if (empty($visaSubCategories)) {
            return $this->error('Data Not found');
        }
        return $this->success(true, 'Visa Sub Category Data retrieved successfully!', $visaSubCategories);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventCategory;

class EventCategoryListController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $eventCategories  = EventCategory::select('id as id', 'name as text')
                                    ->when($search, function($query, $search) {
                                        return $query->where('name', 'like', "%$search%");
                                    })
                                    ->get();

        return $eventCategories;
    }
}

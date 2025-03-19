<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    private SearchService $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function userSearch(Request $request) {
        
        $search = $request->input('search');
        $result = $this->searchService->userSearch($search);
        
        return view('user/user_search', $result);

    }
}

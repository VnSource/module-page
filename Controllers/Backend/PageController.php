<?php namespace VnsModules\Page\Controllers\Backend;

use Illuminate\Http\Request;
use VnsModules\Page\StoreRequest;
use VnsModules\Page\UpdateRequest;
use VnsModules\Page\PageRepositoryInterface as PageRepository;

class PageController extends \App\Http\Controllers\Controller
{
    protected $pages;

    public function __construct(PageRepository $pages)
    {
        $this->pages = $pages;
    }

    public function index(Request $request)
    {
        list($pages, $total) = $this->pages->filter($request->all());
        return response()->json($pages)->header('total', $total);
    }

    public function show($id)
    {
        $page = $this->pages->find($id);
        return response()->json($page);
    }

    public function store(StoreRequest $request)
    {
        $page = $this->pages->create($request->all());
        return response()->json($page);
    }

    public function update(UpdateRequest $request, $id)
    {
        $page = $this->pages->update($id, $request->all());
        return response()->json($page);
    }

    public function destroy($id)
    {
        $page = $this->pages->delete($id);
        return response()->json($page);
    }
}

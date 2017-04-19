<?php namespace VnsModules\Page;

use Repositories\Post\PostRepository;

class PageRepository extends PostRepository implements PageRepositoryInterface
{
    public function getModel()
    {
        return Page::class;
    }
}
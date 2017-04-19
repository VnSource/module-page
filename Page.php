<?php namespace VnsModules\Page;

class Page extends \Models\Post {

    protected $fillable = ['name', 'slug', 'title', 'image', 'excerpt', 'content', 'status', 'comment'];

}

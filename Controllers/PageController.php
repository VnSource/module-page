<?php namespace VnsModules\Page\Controllers;

class PageController extends \Http\Controllers\FrontEndController
{
    public function displayPost($post) {
        $data = [
            'post' => $post,
            'breadcrumb' => breadcrumb([
                [
                    'name' => $post->name
                ]
            ])
        ];

        return view('VnsModules\Page::detail', $data);
    }
}

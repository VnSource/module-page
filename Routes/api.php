<?php

Route::group(['prefix' => 'v1', 'middleware' => 'permission:page'], function () {
    Route::resource('page', 'Backend\PageController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
});

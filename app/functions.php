<?php
use App\Models\Page;
function menu(){
    $data = Page::orderBy('id')->where('slug', '<>', 'home')->get();
    return $data;
}
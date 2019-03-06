<?php
Route::get('/do', function() {
    echo 'hello, i am controller of path /do <br>';
    $p1 = new Person('def');
    echo $p1->hello();
});
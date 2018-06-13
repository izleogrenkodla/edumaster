<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryBulkBookRequest extends AppModel
{
    public $name = 'LibraryBulkBookRequest';
    public $useTable = 'library_book_bulk';
    public $primaryKey = 'BULK_ID';
}
?>
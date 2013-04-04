public function filters()
{
    return array(
        'accessControl', // perform access control for CRUD operations
        'postOnly + delete', // we only allow deletion via POST request
    );
}

public function accessRules() {
    return array(
        array(
            'allow',
            'actions'=>array('danhsach','chitiet','them','capnhat','xoa','xoagrid'),
            'users'=>array('@'),
    ),
        array('deny',
        'users'=>array('*')),
    );
}
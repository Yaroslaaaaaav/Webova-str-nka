<? 


if(isset($_GET['act']) ){
    if($_GET['act'] == 'get'){
        echo (file_get_contents('info.txt'));
    }
    if($_GET['act'] == 'put'){
        $keys = [];
        $keys[0] = $_GET['k1'];
        $keys[1] = $_GET['k2'];

        file_put_contents('info.txt',implode(',',$keys));
    }
}

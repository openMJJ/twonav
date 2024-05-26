<?php
$api_name = $_GET['api'];

if ($api_name == 'menu') {
    $info1 = [];
    $info1['title'] = '导航';
    $info1['icon'] = 'fa fa-address-book';
    $info1['href'] = '';
    $info1['target'] = '_self';
    foreach ($category_parent as $category) {
        $info1['child'][] = ['title'=>$category['name'],'href'=>$category['id'],'icon'=>$category['font_icon'],'target'=>'_self'];
    }
    
    $init = array( 'homeInfo'=>['title'=>'导航','href'=>'home'],'logoInfo'=>['title'=>'TwoNav','image'=>'./templates/admin/img/logo.png','href'=>'./?u='.U],'menuInfo'=>[$info1]);
    header('Content-Type:application/json; charset=utf-8');
    exit(json_encode($init));
}elseif($api_name == 'data'){
    $start_time = microtime(true); 
    $mix_data = $category_parent;
    $link_cont = 0;
    //处理二级分类
    foreach ($category_parent as $key => $category) {
        $sub_category = get_sub_category($categorys,'fid',$category['id']);
        $mix_data[$key]['sub_category'] = $sub_category;
    }
    //处理链接
    $useless_fields = ['real_url','url_standby','click','extend','fid','icon','pid','property','type','id'];
    // if($theme_config['link_description'] == 0){
    //     array_push($useless_fields,'description');
    // }
    foreach ($mix_data as $key1 => $category) {
        $mix_data[$key1]['links'] = get_links($category['id']);
        del_useless_fields($mix_data[$key1]['links'],$useless_fields);
        $link_cont += count($mix_data[$key1]['links']);
        foreach ($category['sub_category'] as $key2 => $category) {
            $mix_data[$key1]['sub_category'][$key2]['links'] = get_links($category['id']);
            del_useless_fields($mix_data[$key1]['sub_category'][$key2]['links'],$useless_fields);
            $link_cont += count($mix_data[$key1]['sub_category'][$key2]['links']);
        }
    }
    $end_time = microtime(true);
    $execution_time = intval(($end_time - $start_time) * 1000); 
    
    msgA([
        'code'=>1,
        'data'=>$mix_data,
        //'layui_js'=>$layui['js'],
        //'layui_css'=>$layui['css'],
        'time_consum'=>"$execution_time",
        'link_cont'=>$link_cont
        ]);
}

//获取二级分类
function get_sub_category($array, $key, $value) {
    $filteredArray = [];
    foreach ($array as $item) {
        if (isset($item[$key]) && $item[$key] === $value ) {
            $filteredArray[] = $item;
        }
    }
    return $filteredArray;
}

function del_useless_fields(&$array, $fieldsToRemove) {
    foreach ($array as &$item) {
        if (is_array($item)) {
            foreach ($fieldsToRemove as $field) {
                if (isset($item[$field])) {
                    unset($item[$field]);
                }
            }
        }
    }
}
exit;
?>
<?php 
//生成常量给前端处理
echo "<script>\n";
echo "const\n";
$i= 0; $c=count($categorys); $cm6 = [];
foreach ( $categorys as $category ) {
    $i++;
    
    $links = get_links($category['id']);
    $nav = [];
    foreach ($links as $link) {
        array_push($nav,['text'=>$link['title'],'link'=>$link['url'],'icon'=>$link['ico'],'desc'=>(intval($theme_config['display_describe']) == 1 ? $link['description'] : '')]);
    }
    
    $data = [ "title" => $category['name'], "sort" => $i,"ficon"=>$category['font_icon'], "nav" => $nav ];
    $data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "lm_data_{$category['id']} = " . $data . ", lm_index_{$category['id']} = Object.freeze(Object.defineProperty({__proto__: null,default: lm_data_{$category['id']}}, Symbol.toStringTag, {value: \"Module\"}))".($i == $c ?",\n":"\n,");
    array_push($cm6,"lm_index_{$category['id']}");
}

echo "lm_cm6 = {" .implode(", ", $cm6)."},\n";
echo "logo = \"{$theme_config['logo']}\",\n";
echo "logo_text = ".json_encode($site['logo'], JSON_UNESCAPED_UNICODE).",\n";

if(intval($theme_config['display_admin']) == 1){
    echo "admin = \"./index.php?c=admin&u={$u}\";\n";
}else{
    echo "admin = 'hide';\n";
}
echo "</script>\n\n";

?>
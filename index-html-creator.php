<?php

mb_internal_encoding('UTF-8');
define('MAIN_DIR', __DIR__.'/');



create_index_html(MAIN_DIR);



/**
 * возвращает целое положительное число
 * @param mixed $a
 * @return int
 */
function absint($a){
	return abs(intval($a));
}

/**
 * Проверяет существование ФАЙЛА
 * @param $path - путь до файла
 * @return bool
 */
function check_file($path){
	return file_exists($path) && is_file($path);
}

/**
 * Проверяет существование папки
 * @param $path - путь до папки
 * @return bool
 */
function check_dir($path){
	return file_exists($path) && is_dir($path);
}

//получает список файлов
//path - путь до директории
//ext - расширение файлов (c точкой)
//name_pattern - шаблон имени (регулярное выражение)
function file_list($path, $ext='', $name_pattern='^.*?'){
	$files = scandir($path);
	$pattern = '#'.$name_pattern.preg_quote($ext).'$#';
	$len = sizeof($files);
	for($i=0; $i<$len; $i++){
		if(!preg_match($pattern, $files[$i])){
			unset($files[$i]);
		}
	}
	return array_values($files);
}

function create_index_html($path, $recursive=true, $content=''){
	if(!check_dir($path)){
		return false;
	}

	$path = realpath($path); //без слэша
	
	if(!check_file($path.'/index.html') && !check_file($path.'/index.php')){
		file_put_contents($path.'/index.html', $content);
	}
	
	if($recursive){
		$files = file_list($path);
		$len = sizeof($files);
		for($i = 0; $i < $len; $i++){
			if($files[$i] === '.' || $files[$i] === '..')
				continue;

			if(check_dir($path.'/'.$files[$i])){
				create_index_html($path.'/'.$files[$i], $recursive, $content);
			}
		}
	}
	
	return true;
}
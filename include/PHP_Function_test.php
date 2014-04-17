<?php

/*
 *  __DIR__ :
 *  
 */
echo __DIR__."</br>";

/*
 *  __FILE__ : 
 */
echo __FILE__."</br>";

/*
 * chdir() - 实时该变当前工作目录
 */
//chdir(dirname (__FILE__));

/*
 * getcwd() - 获取当前工作目录的绝对路径
 */
$dir = getcwd();
echo "Path 1 print in PHPFT:" . $dir . "</br>";
/*
 * strrposstrrpos(string,find,start) - 返回指定字符或子字符串（第一个字符）在目标字符串中的最后出现位置（目标字符串第一个字符位置为0）
 *     string - 目标字符串
 *     find - 搜索的字符串
 *     start - 起始搜索位置
 *     例如$dir=abfghcdefghijk,则strrpos($dir,"fgh")==8
 */
$pos=strrpos($dir,"\\");
echo $pos."</br>";
/*
 * substr(string,start,length) - 函数返回字符串的一部分。
 *     string - 目标字符串
 *     start - 正数  - 在字符串的指定位置开始
 *             负数  - 在从字符串结尾的指定位置开始
 *              0 - 在字符串中的第一个字符处开始
 *     length - 正数 - 从 start 参数所在的位置返回
 *              负数 - 从字符串末端返回
 */
echo substr($dir,$pos+1)."</br>";//找到最后一个\,开始截取.
echo substr("Hello world!",-6,5)."</br>";
/*
 * dirname()
 */
$dir_path=dirname(__FILE__);
echo "Path 2 print in PHPFT:" . $dir_path."</br>";

/*
 * To get your current working directory: getcwd() (documentation)
 * To get the document root directory: $_SERVER['DOCUMENT_ROOT']
 * To get the filename of the current script: $_SERVER['SCRIPT_FILENAME']
 */
echo $_SERVER['DOCUMENT_ROOT']."</br>";
/*
 * 一种可直接定位包含的文件所在目录的方法，以避免在当前工作目录下搜索，可提高系统性能
 * main.php
 * libs/common.php
 * libs/images/editor.php
 * 
 * in your common.php you need to use functions in editor.php, so you use
 * 
 * common.php:
 *     require_once dirname(__FILE__) . '/images/editor.php';
 * 
 * main.php:
 *     require_once libs/common.php
 * 
 * That way when common.php is require'd in main.php, the call of require_once in common.php will correctly includes editor.php in images/editor.php instead of trying to look in current directory where main.php is run.
 * 
 */
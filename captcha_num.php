<?php

    session_start();

    //绘制画布
    $image = imagecreatetruecolor(200,60);

    //填充画布颜色
    $imgbg = imagecolorallocate($image, 255,255, 255);
    imagefill($image, 0,0, $imgbg);

//    //传统方法显示数字
//    $num = "";
//    for($i=0; $i<4; $i++){
//        $font = 5;
//        $fontcolor = imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));
//        $fontcont = rand(0, 9);
//        $num.=$fontcont;
//
//        $x = $i*(200/4) + rand(10,30);
//        $y = rand(10,40);
//
//        imagestring($image, $font, $x, $y, $fontcont, $fontcolor);
//
//    }

    //另外一种可携带字体文件且能修改字体大小的显示
    $fontface = dirname(__FILE__).'/ttf/link.TTF';

    //str可选择任意字符串，只能在纯数字、纯字母、字母数字组合、纯中文的组合中选一组
    //若选择了纯中文，则需要在strdb里将str_split的长度属性改为3，因为该编码格式为utf-8
    $str = 'acdefgfjkmnprstuvwxyz234589';
    $strdb = str_split($str, 1);

    $code = '';

    //显示文本
    for($i=0; $i<4; $i++){
        $fontcolor = imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));

        $index = mt_rand(0, count($strdb)-1);
        $ch = $strdb[$index];
        $code .= $ch;

        imagettftext(
            $image, mt_rand(20,24), mt_rand(-60, 60),
            (40*$i+20), mt_rand(30,35), $fontcolor, $fontface, $ch);
    }

    $_SESSION['code'] = $code;

    //干扰像素点
    for($i=0; $i<500; $i++){
        $pointcolor = imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));
        imagesetpixel($image, mt_rand(1,199), mt_rand(1,59), $pointcolor);
    }

    //干扰线条
    for($i=0; $i<5; $i++){
        $linecolor = imagecolorallocate($image, mt_rand(0,120), mt_rand(0,120), rand(0,120));
        imageline($image,mt_rand(1,99), mt_rand(1,29), mt_rand(99,199),mt_rand(29,59), $linecolor);
    }


    header("content-type:image/png");

    imagepng($image);

    imagedestroy($image);

?>
<?php
// Function for converting GIFs and PNGs to JPG upon upload
function ft_covert($target, $newcopy, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $ext = strtolower($ext);
    $img = "";
    if ($ext == "gif"){ 
        $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
        $img = imagecreatefrompng($target);
    }
    $tci = imagecreatetruecolor($w_orig, $h_orig);
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w_orig, $h_orig, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 84);
}
// ----------------------- IMAGE WATERMARK FUNCTION -----------------------
// Function for applying a PNG watermark file to a file after you convert the upload to JPG
function ft_sticker($target, $sticker_file, $newcopy) { 
    $sticker = imagecreatefrompng($sticker_file); 
    imagealphablending($sticker, false); 
    imagesavealpha($sticker, true); 
    $img = imagecreatefromjpeg($target);
    $img_w = imagesx($img); 
    $img_h = imagesy($img); 
    $sticker_width = imagesx($sticker); 
    $sticker_hieght = imagesy($sticker); 
    $dst_x = ($img_w / 2) - ($sticker_width / 2); // For centering the watermark on any image
    $dst_y = ($img_h / 2) - ($sticker_hieght / 2); // For centering the watermark on any image
    imagecopy($img, $sticker, $dst_x, $dst_y, 0, 0, $sticker_width, $sticker_hieght); 
    imagejpeg($img, $newcopy, 100); 
    imagedestroy($img); 
    imagedestroy($sticker); 
} 
?>
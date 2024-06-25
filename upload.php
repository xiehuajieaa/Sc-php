<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $project = $_POST['project'];
    $file = $_FILES['file'];

    // 检查文件是否上传成功
    if ($file['error'] != 0) {
        die("文件上传出错：" . $file['error']);
    }

    // 设置上传目录
    $uploadDir = "uploads/$project/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // 生成新文件名
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFileName = $name . "_" . $student_id . "." . $fileExtension;

    // 设置目标文件路径
    $targetFilePath = $uploadDir . $newFileName;

    // 移动上传的文件到目标位置
    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        echo "文件上传成功！";
    } else {
        echo "文件上传失败。";
    }
}
?>

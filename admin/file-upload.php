<?php
class FileUpload {

    function uploadFiles($files, $uploadDir) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
    
        $uploadedFiles = [];
        for ($i = 0; $i < count($files['name']); $i++) {
            $fileName = $files['name'][$i];
            $fileTmpName = $files['tmp_name'][$i];
            $fileSize = $files['size'][$i];
            $fileError = $files['error'][$i];
    
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
            if (!in_array($fileExt, $allowedExtensions)) {
                return ['success' => false, 'message' => "ファイル {$fileName} は許可されていない拡張子です。"];
            }
    
            if ($fileSize > $maxFileSize) {
                return ['success' => false, 'message' => "ファイル {$fileName} のサイズが大きすぎます。"];
            }
    
            if ($fileError !== 0) {
                return ['success' => false, 'message' => "ファイル {$fileName} のアップロードでエラーが発生しました。"];
            }
            
            $fileNameOld = explode(".", $fileName);
            $newFileName = $fileNameOld[0] . '_' . uniqid() . '.' . $fileExt;
            $destination = $uploadDir . '/' . $newFileName;
    
            if (move_uploaded_file($fileTmpName, $destination)) {
                $uploadedFiles[] = $newFileName;
            } else {
                return ['success' => false, 'message' => "ファイル {$fileName} の保存に失敗しました。"];
            }
        }
    
        return ['success' => true, 'message' => 'ファイルが正常にアップロードされました。', 'files' => $uploadedFiles];
    }
}
?>
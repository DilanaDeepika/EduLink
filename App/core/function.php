<?php
function show($staff)
{
    echo "<pre>";
    print_r($staff);
    echo "</pre>";
}


function handleFileUploads($inputName = 'files', $subDir = 'uploads')
{
    $uploadedFiles = [];

    if (!isset($_FILES[$inputName])) {
        return $uploadedFiles;
    }

    // Determine if it's single or multiple files
    $isMultiple = is_array($_FILES[$inputName]['name']);

    $uploadDir = 'public/uploads/' . $subDir . '/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if ($isMultiple) {
        $fileCount = count($_FILES[$inputName]['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            if ($_FILES[$inputName]['error'][$i] === 0) {
                $fileName = time() . '_' . $i . '_' . basename($_FILES[$inputName]['name'][$i]);
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES[$inputName]['tmp_name'][$i], $targetPath)) {
                    $uploadedFiles[] = $targetPath;
                }
            }
        }
    } else {
        if ($_FILES[$inputName]['error'] === 0) {
            $fileName = time() . '_' . basename($_FILES[$inputName]['name']);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetPath)) {
                $uploadedFiles[] = $targetPath;
            }
        }
    }

    return $uploadedFiles;
}


// This is the redirect function you are missing
function redirect($path)
{
    // This is the built-in PHP header function
    header("Location: " . ROOT . "/" . $path);
    die; // Always call die() after a redirect
}
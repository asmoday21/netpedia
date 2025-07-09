<?php
namespace App\Helpers;

class FileHelper
{
    /**
     * Generate HTML preview file jawaban untuk halaman guru
     * @param string $filename nama file (misal: "jawaban1.pdf")
     * @param string $filepath path lengkap atau relative path dari storage (misal: "jawaban/123/jawaban1.pdf")
     * @param string $fileUrl URL akses file (misal: url('storage/jawaban/123/jawaban1.pdf'))
     * @param int $fileId id file jawaban di database (bisa null jika tidak pakai)
     * @return string HTML siap pakai
     */
    public static function renderFilePreview(string $filename, string $fileUrl, ?int $fileId = null): string
    {
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $iconClass = 'bi-file-earmark-fill text-muted';
        $filePreviewHtml = '';
        $fileIdAttr = $fileId ? "data-file-id='{$fileId}'" : '';

        $extIconMap = [
            'pdf' => 'bi-file-earmark-pdf-fill text-danger',
            'doc' => 'bi-file-earmark-word-fill text-primary',
            'docx' => 'bi-file-earmark-word-fill text-primary',
            'ppt' => 'bi-file-earmark-ppt-fill text-danger',
            'pptx' => 'bi-file-earmark-ppt-fill text-danger',
            'xls' => 'bi-file-earmark-excel-fill text-success',
            'xlsx' => 'bi-file-earmark-excel-fill text-success',
            'zip' => 'bi-file-earmark-zip-fill text-secondary',
            'rar' => 'bi-file-earmark-zip-fill text-secondary',
            '7z' => 'bi-file-earmark-zip-fill text-secondary',
            'txt' => 'bi-file-earmark-text-fill text-muted',
            'png' => '',
            'jpg' => '',
            'jpeg' => '',
            'gif' => '',
            'bmp' => '',
            // bisa tambahkan lagi kalau perlu
        ];

        if (isset($extIconMap[$ext]) && $extIconMap[$ext] !== '') {
            $iconClass = $extIconMap[$ext];
        }

        // HTML preview berdasarkan tipe file
        if (in_array($ext, ['png', 'jpg', 'jpeg', 'gif', 'bmp'])) {
            // Preview image langsung
            $filePreviewHtml = "<img src='{$fileUrl}' alt='{$filename}' class='img-thumbnail' style='max-width: 150px; max-height: 150px; object-fit: contain;'>";
        } elseif ($ext === 'pdf') {
            // Preview PDF embed
            $filePreviewHtml = "<iframe src='{$fileUrl}#toolbar=0' style='width:150px; height:200px;' frameborder='0'></iframe>";
        } else {
            // Preview icon file dokumen lain
            $filePreviewHtml = "<i class='bi {$iconClass} fs-1'></i>";
        }

        // Tombol hapus file, pakai atribut data-file-id buat AJAX hapus
        $deleteBtn = $fileId ? "<button class='btn btn-sm btn-danger btn-delete-file' {$fileIdAttr} title='Hapus file'><i class='bi bi-trash'></i></button>" : '';

        return "
        <div class='file-preview border rounded p-2 m-2 d-inline-block text-center' style='width: 160px; position: relative;'>
            <div class='file-thumb mb-1'>{$filePreviewHtml}</div>
            <div class='file-name text-truncate' title='{$filename}'>{$filename}</div>
            {$deleteBtn}
        </div>";
    }
}

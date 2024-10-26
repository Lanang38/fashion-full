<?php
require 'config.php'; // Include file koneksi database
require 'vendor/autoload.php'; // Include PHPSpreadsheet Composer autoload

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set judul kolom dan atur tengah serta bold
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Slug');
$sheet->setCellValue('D1', 'Category Count');

// Atur gaya untuk judul kolom agar berada di tengah dan tebal
$styleArray = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
    ],
];

$sheet->getStyle('A1:E1')->applyFromArray($styleArray);

// Fetch data dari database
$sql = "SELECT * FROM categories";
$result = $conection_db->query($sql);

if ($result->num_rows > 0) {
    $rowIndex = 2; // Mulai baris untuk data
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A'.$rowIndex, $no++);
        $sheet->setCellValue('B'.$rowIndex, $row['name']);
        $sheet->setCellValue('C'.$rowIndex, $row['slug']);
        $sheet->setCellValue('D'.$rowIndex, $row['category_count']);

        $sheet->getStyle('A'.$rowIndex.':D'.$rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $rowIndex++;
    }
}

// Set lebar kolom
$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(40);
$sheet->getColumnDimension('C')->setWidth(40);
$sheet->getColumnDimension('D')->setWidth(20);

// Set judul untuk download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="categories.xlsx"');
header('Cache-Control: max-age=0');

// Buat Excel writer
$writer = new Xlsx($spreadsheet);

// Output file Excel ke browser
$writer->save('php://output');
exit;
?>

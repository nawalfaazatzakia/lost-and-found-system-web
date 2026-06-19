<?php

namespace App\Services;

use App\Contracts\ReportContract;

class ReportService implements ReportContract
{
    public function createLostReport(array $data)
    {
        return [
            'message' => 'Laporan barang hilang berhasil dibuat',
            'data' => $data
        ];
    }

    public function createFoundReport(array $data)
    {
        return [
            'message' => 'Laporan barang ditemukan berhasil dibuat',
            'data' => $data
        ];
    }

    public function getAllReports()
    {
        return [
            'message' => 'Daftar semua laporan'
        ];
    }

    public function getReportById(int $id)
    {
        return [
            'message' => 'Detail laporan',
            'id' => $id
        ];
    }

    public function deleteReport(int $id)
    {
        return [
            'message' => 'Laporan berhasil dihapus',
            'id' => $id
        ];
    }
}
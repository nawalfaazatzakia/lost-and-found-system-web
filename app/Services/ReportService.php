<?php

namespace App\Services;

use App\Contract\ReportContract;
use App\Models\Report;
use Exception;

class ReportService implements ReportContract
{
    public function createLostReport(array $data)
    {
        try {
            $report = Report::create([
                ...$data,
                'type'   => 'lost',
                'status' => 'pending',
            ]);

            return [
                'message' => 'Laporan barang hilang berhasil dibuat',
                'data'    => $report->load('user'),
            ];
        } catch (Exception $e) {
            return [
                'message' => 'Gagal membuat laporan',
                'error'   => $e->getMessage(),
            ];
        }
    }

    public function createFoundReport(array $data)
    {
        try {
            $report = Report::create([
                ...$data,
                'type'   => 'found',
                'status' => 'pending',
            ]);

            return [
                'message' => 'Laporan barang ditemukan berhasil dibuat',
                'data'    => $report->load('user'),
            ];
        } catch (Exception $e) {
            return [
                'message' => 'Gagal membuat laporan',
                'error'   => $e->getMessage(),
            ];
        }
    }

    public function getAllReports()
    {
        return [
            'message' => 'Daftar semua laporan',
            'data'    => Report::with('user')->latest()->get(),
        ];
    }

    public function getReportById(int $id)
    {
        return [
            'message' => 'Detail laporan',
            'data'    => Report::with(['user', 'claims', 'verificationQuestions'])->findOrFail($id),
        ];
    }

    public function deleteReport(int $id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return [
            'message' => 'Laporan berhasil dihapus',
        ];
    }
}

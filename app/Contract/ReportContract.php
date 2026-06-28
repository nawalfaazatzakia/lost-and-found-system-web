<?php

namespace App\Contract;

interface ReportContract
{
    public function createLostReport(array $data);

    public function createFoundReport(array $data);

    public function getAllReports();

    public function getReportById(int $id);

    public function deleteReport(int $id);
}
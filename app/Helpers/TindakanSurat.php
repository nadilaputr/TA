<?php

namespace App\Helpers;

class TindakanSurat
{
    const DITERIMA = 0;
    const REVISI = 1;
    const MENUNGGU_INSTRUKSI_KEPALA = 2;
    const DISPOSISI = 4;
    const ARSIP = 5;
    const TELAH_DIREVISI = 6;

    public function toBadge($status)
    {
        $statusText = self::toString($status);
        $badgeColor = self::getBadgeColor($status);

        return "<span class=\"badge badge-$badgeColor\">$statusText</span>";
    }

    public function toString($status)
    {
        switch ($status) {
            case self::DITERIMA:
                return "Diterima";
            case self::REVISI:
                return "Revisi";
            case self::MENUNGGU_INSTRUKSI_KEPALA:
                return "Menunggu Instruksi Kepala";
            case self::DISPOSISI:
                return "Disposisi";
            case self::ARSIP:
                return "Arsip";
            case self::TELAH_DIREVISI:
                return "Telah Direvisi";
        }
    }

    public function getBadgeColor($status)
    {
        switch ($status) {
            case self::DITERIMA:
            case self::TELAH_DIREVISI:
                return "info";
            case self::REVISI:
                return "danger";
            case self::MENUNGGU_INSTRUKSI_KEPALA:
                return "warning";
            case self::DISPOSISI:
                return "primary";
            case self::ARSIP:
                return "success";
            default:
                return "secondary";
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MemorialPage;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Http\Response;
use Illuminate\View\View;

class QrCodeController extends Controller
{
    public function show(MemorialPage $memorialPage): View
    {
        return view('memorial-pages.qr-code', [
            'memorialPage' => $memorialPage,
            'url' => route('memorial-pages.show', $memorialPage),
        ]);
    }

    public function svg(MemorialPage $memorialPage): Response
    {
        $result = $this->builder($memorialPage)->build(writer: new SvgWriter());

        return response($result->getString(), 200)
            ->header('Content-Type', $result->getMimeType());
    }

    public function png(MemorialPage $memorialPage): Response
    {
        $result = $this->builder($memorialPage)->build(writer: new PngWriter());

        return response($result->getString(), 200)
            ->header('Content-Type', $result->getMimeType())
            ->header(
                'Content-Disposition',
                'attachment; filename="mindeside-'.$memorialPage->id.'-qr.png"'
            );
    }

    private function builder(MemorialPage $memorialPage): Builder
    {
        return new Builder(
            data: route('memorial-pages.show', $memorialPage),
            size: 480,
            margin: 16,
            foregroundColor: new Color(46, 52, 64),
            backgroundColor: new Color(255, 255, 255),
        );
    }
}

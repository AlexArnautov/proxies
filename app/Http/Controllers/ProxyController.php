<?php

namespace App\Http\Controllers;

use App\Exports\ProxiesExport;
use App\Models\Proxy;
use App\Repositories\RandomProxyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ProxyController extends Controller
{
    public const EXPORT_FILENAME = 'proxies.csv';

    public function __construct(
        private readonly RandomProxyRepository $proxyRepository
    ) {
    }

    public function list(): JsonResponse
    {
        $proxies = $this->proxyRepository->all();
        return response()->json($proxies);
    }

    public function export(Request $request): BinaryFileResponse|JsonResponse
    {
        $validator = Validator::make(
            data: $request->all(),
            rules: ['format' => ['required', Rule::in(Proxy::$possibleFormats)]]
        );

        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $format = $validator->safe()->only(['format'])['format'];
        $proxies = $this->proxyRepository->all();

        return Excel::download(
            export: new ProxiesExport($proxies, $format),
            fileName: self::EXPORT_FILENAME,
            headers: ['Content-Type' => 'text/csv']
        );
    }
}

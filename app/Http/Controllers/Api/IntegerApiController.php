<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Integer\ConvertToRomanNumeralRequest;
use App\Http\Resources\IntegerConversionResource;
use App\Models\IntegerConversion;
use App\Services\RomanNumeralConverter;
use Illuminate\Http\JsonResponse;

class IntegerApiController extends Controller
{
    public function __construct(private readonly RomanNumeralConverter $romanNumeralConverter)
    {
    }

    /**
     * POST /api/integers/convert-to-roman-numeral
     * Convert an integer to a Roman numeral.
     *
     * @param ConvertToRomanNumeralRequest $request
     * @return IntegerConversionResource
     */
    public function convertToRomanNumeral(ConvertToRomanNumeralRequest $request): IntegerConversionResource
    {
        $integer = $request->input('integer');

        $romanNumeral = $this->romanNumeralConverter->convertInteger($integer);

        $conversion = IntegerConversion::create([
            'type' => 'roman',
            'integer' => $integer,
            'conversion' => $romanNumeral,
        ]);

        return new IntegerConversionResource($conversion);
    }

    /**
     * GET /api/integers/recent-conversions
     * Get the five most recent integer conversions.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function recentConversions(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $conversions = IntegerConversion::orderBy('created_at', 'desc')->limit(5)->get();

        return IntegerConversionResource::collection($conversions);
    }

    /**
     * GET /api/integers/top-ten-conversions
     * Get the ten most frequently converted integers.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function topTenConversions(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $conversions = IntegerConversion::selectRaw('integer, conversion, count(*) as count')
            ->groupBy('integer', 'conversion')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        return IntegerConversionResource::collection($conversions);
    }
}

<?php


namespace App\Core\Providers;


use _HumbugBox0b2f2d5c77b8\Nette\Neon\Exception;
use App\Core\Models\Database\User;
use Illuminate\Support\Facades\Http;

class Przelewy24Provider
{
    private static string $SANDBOX_URL = 'https://sandbox.przelewy24.pl/';
    private static string $PRODUCTION_URL = 'https://secure.przelewy24.pl/';

    private ?User $user;
    private string $id;
    private int $amount;
    private string $currency;
    private string $description;
    private string $country;
    private string $language;

    public function __construct(int $id, ?User $user, int $amount, string $currency, string $description, string $country, string $language)
    {
        $this->user = $user;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->description = $description;
        $this->country = $country;
        $this->language = $language;
        $this->id = (string)$id;
    }

    public function preparePayment(): array
    {
        $merchantId = (int)env('PAYMENT_PRZELEWY24_MERCHANTID');
        $posId = (int)env('PAYMENT_PRZELEWY24_POSID');
        $isSandbox = env('PAYMENT_PRZELEWY24_IS_SANDBOX');
        $secretId = env('PAYMENT_PRZELEWY24_SECRET');
        $crc = env('PAYMENT_PRZELEWY24_CRC');

        $url = $isSandbox ? self::$SANDBOX_URL : self::$PRODUCTION_URL;

        $data = [
            'sessionId' => $this->id,
            'merchantId' => $merchantId,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'crc' => $crc
        ];

        $response = Http::withBasicAuth($posId, $secretId)
            ->post($url . 'api/v1/transaction/register', [
                'merchantId' => $merchantId,
                'posId' => $posId,
                'sessionId' => $this->id,
                'amount' => $this->amount,
                'currency' => $this->currency,
                'description' => $this->description,
                'email' => $this->user->email,
                'client' => "{$this->user->firstName} {$this->user->lastName}",
                'country' => $this->country,
                'language' => $this->language,
                'urlStatus' => url("/api/contract/{$this->id}/payment/"),
                'urlReturn' => url("/panel/formSubmission"),
                'waitForResult' => true,
                'sign' => hash('sha384', json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)),
            ]);

        return [
            "verify" => [
                'merchantId' => $merchantId,
                'posId' => $posId,
                'sessionId' => $this->id,
                'amount' => $this->amount,
                'currency' => $this->currency,
                'orderId' => null,
                'sign' => hash('sha384', json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)),
            ],
            "url" => $url . 'trnRequest/' . json_decode($response->getBody(), true)['data']['token']
        ];
    }

    public function verify(int $orderId, string $sign): bool
    {
        $merchantId = (int)env('PAYMENT_PRZELEWY24_MERCHANTID');
        $posId = (int)env('PAYMENT_PRZELEWY24_POSID');
        $isSandbox = env('PAYMENT_PRZELEWY24_IS_SANDBOX');
        $secretId = env('PAYMENT_PRZELEWY24_SECRET');

        $url = $isSandbox ? self::$SANDBOX_URL : self::$PRODUCTION_URL;
        $response = Http::withBasicAuth($posId, $secretId)
            ->post($url . '/api/v1/transaction/register', [
                'merchantId' => $merchantId,
                'posId' => $posId,
                'sessionId' => $this->id,
                'amount' => $this->amount,
                'currency' => $this->currency,
                'orderId' => $orderId,
                'sign' => $sign,
            ]);

        return $response['statusCode'] !== 200;
    }
}
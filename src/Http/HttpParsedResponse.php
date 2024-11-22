<?php 


namespace Kepsondiaz\HttpParsedResponse;

use Illuminate\Support\Arr;
use Illuminate\Http\Client\Response;


class HttpParsedResponse
{
    public function __construct(protected Response $response) {}

    public function getStatus(): int
    {
        return $this->response->status();
    }

    public function getData(): array
    {
        return $this->response->json() ?? [];
    }

    public function get(string $key)
    {
        return $this->getData()[$key] ?? null;
    }

    public function has(array $keys): bool
    {
        return Arr::has($this->getData(), $keys);
    }

    public function isValue(string $key, string $value): bool
    {
        return $this->has([$key]) && $this->get($key) === $value;
    }

    public function valueContains(string $key, string $value): bool
    {
        return $this->has([$key]) && str_contains($this->get($key), $value);
    }

    public function isSuccessful(): bool
    {
        return $this->response->successful();
    }

    public function isFailed(): bool
    {
        return $this->response->failed();
    }

    public function getErrorMessage(): ?string
    {
        return $this->isSuccessful() ? null : $this->response->toException()?->getMessage();
    }
}

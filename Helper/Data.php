<?php

namespace Swissup\Wsrv\Helper;

class Data
{
    public function convertUrl(string $url): string
    {
        $urlParts = parse_url($url);
        if (!isset($urlParts['host'])) {
            return $url;
        }

        $host = $urlParts['host'];
        $path = $urlParts['path'];

        parse_str($urlParts['query'] ?? '', $params);
        $params = $this->getQueryParams($params);
        $query = http_build_query($params);

        return "//wsrv.nl?url={$host}{$path}&{$query}";
    }

    public function getQueryParams(array $params): array
    {
        $mapping = [
            'width' => 'w',
            'height' => 'h',
        ];

        $result = [];
        foreach ($params as $key => $value) {
            if (isset($mapping[$key])) {
                $result[$mapping[$key]] = $value;
            }
        }

        if (isset($result['w'], $result['h'])) {
            $result['fit'] = 'contain';
            $result['cbg'] = 'fff';
        }

        return array_merge($result, [
            'output' => 'webp',
        ]);
    }
}

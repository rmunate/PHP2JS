<?php

namespace Rmunate\Php2Js\Data;

class AgentPhp2Js
{
    /**
     * Propierties Object.
     */
    private $agent;

    /**
     * Constructor Class.
     */
    public function __construct()
    {
        $this->agent = $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Validata if is mobile the agent.
     *
     * @return bool
     */
    public function isMobileDevice(): bool
    {
        $deviceKeywords = [
            'Mobile',
            'Android',
            'iPhone',
            'iPad',
            'iPod',
            'Windows Phone',
            'BlackBerry',
            'webOS',
            'Opera Mini',
            'IEMobile',
        ];

        foreach ($deviceKeywords as $keyword) {
            if (stripos($this->agent, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $identifiers
     *
     * @return bool
     */
    public function validatePlatform($identifiers = [])
    {
        foreach ($identifiers as $identifier) {
            $check = strpos($this->agent, $identifier);
            if ($check >= 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return Name Current OS.
     *
     * @return string
     */
    public function getDataClienteSO(): string
    {
        $operatingSystems = [
            '/\bWindows\b/i'                  => 'Windows',
            '/\bMacintosh\b|Mac(?!.+OS X)/i'  => 'Mac',
            '/\bLinux\b/i'                    => 'Linux',
            '/\bAndroid\b/i'                  => 'Android',
            '/\biPhone\b|\biPad\b|\biPod\b/i' => 'iOS',
        ];

        foreach ($operatingSystems as $pattern => $os) {
            if (preg_match($pattern, $this->agent)) {
                return $os;
            }
        }

        return 'Unknown';
    }

    /**
     * Return Data Browser.
     *
     * @return array
     */
    public function getDataBrowser(): array
    {
        $userAgent = $this->agent;
        $browsers = [
            'Internet Explorer' => 'MSIE',
            'Opera'             => 'Opera',
            'Netscape'          => 'Netscape',
            'Apple Safari'      => 'Safari',
            'Microsoft Edge'    => 'Edg',
            'Google Chrome'     => 'Chrome',
            'Mozilla Firefox'   => 'Firefox',
        ];

        $platforms = [
            'Linux'     => '/linux/i',
            'Macintosh' => '/macintosh|mac os x/i',
            'Windows'   => '/windows|win32/i',
        ];

        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = 'Unknown';

        // Detect platform
        foreach ($platforms as $platformName => $platformRegex) {
            if (preg_match($platformRegex, $userAgent)) {
                $platform = $platformName;
                break;
            }
        }

        // Detect browser and version
        foreach ($browsers as $browserName => $browserCode) {
            if (str_contains($userAgent, $browserCode)) {
                $bname = $browserName;
                $pattern = '#(?<browser>'.preg_quote($browserCode).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
                if (preg_match_all($pattern, $userAgent, $matches)) {
                    $i = count($matches['browser']);
                    if ($i > 0) {
                        $version = $matches['version'][$i - 1];
                    }
                }
                break;
            }
        }

        $response = [
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
        ];

        return $response;
    }

    /**
     * Return Remote IP.
     *
     * @return string
     */
    public function getIpAddress(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? null;
    }

    /**
     * Return Remote Port.
     *
     * @return string
     */
    public function getRemotePort(): string
    {
        return $_SERVER['SERVER_PORT'] ?? null;
    }

    /**
     * Return Remote Agent.
     *
     * @return string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }
}

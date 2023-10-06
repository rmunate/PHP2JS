<?php

namespace Rmunate\Php2Js\Data;

class AgentPhp2Js
{
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
    public function isMobileDevice()
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
     * @return mixed
     */
    public function getDataClienteSO()
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

        return null;
    }

    /**
     * Return Data Browser.
     *
     * @return mixed
     */
    public function getDataBrowser()
    {
        $userAgent = $this->agent;
        $browsers = [
            'Internet Explorer' => 'MSIE',
            'Internet Explorer' => 'IEMobile',
            'Internet Explorer' => 'MSIEMobile',
            'Netscape'          => 'Netscape',
            'Opera Mini'        => 'Opera Mini',
            'Opera'             => 'Opera',
            'Netscape'          => 'Netscape',
            'Apple Safari'      => 'Safari',
            'Microsoft Edge'    => 'Edg',
            'Coc Coc'           => 'coc_coc_browser',
            'Vivaldi'           => 'Vivaldi',
            'UCBrowser'         => 'UCBrowser',
            'Microsoft Edge'    => 'Edge',
            'Google Chrome'     => 'Chrome',
            'Mozilla Firefox'   => 'Firefox',
            'Safari'            => 'Safari',
            'WeChat'            => 'MicroMessenger',
        ];

        $platforms = [
            'Linux'     => '/linux/i',
            'Macintosh' => '/macintosh|mac os x/i',
            'Windows'   => '/windows|win32/i',
        ];

        $bname = null;
        $platform = null;
        $version = null;

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

        if (empty($bname) && empty($version) && empty($platform)) {
            return null;
        } else {
            return [
                'name'     => $bname,
                'version'  => $version,
                'platform' => $platform,
            ];
        }
    }

    /**
     * Return Remote IP.
     *
     * @return mixed
     */
    public function getIpAddress()
    {
        return $_SERVER['REMOTE_ADDR'] ?? null;
    }

    /**
     * Return Remote Port.
     *
     * @return mixed
     */
    public function getRemotePort()
    {
        return $_SERVER['SERVER_PORT'] ?? null;
    }

    /**
     * Return Remote Agent.
     *
     * @return string
     */
    public function getAgent()
    {
        return $this->agent;
    }
}

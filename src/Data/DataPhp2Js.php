<?php

namespace Rmunate\Php2Js\Data;

class DataPhp2Js
{
    /**
     * Return Data agent.
     *
     * @return array
     */
    public static function getDataAgent(): array
    {
        $data = new AgentPhp2Js();

        return [
            'agent' => [
                'identifier'  => $data->getAgent(),
                'remote_ip'   => $data->getIpAddress(),
                'remote_port' => $data->getRemotePort(),
                'browser'     => $data->getDataBrowser(),
                'isMobile'    => $data->isMobileDevice(),
                'OS'          => $data->getDataClienteSO(),
            ],
        ];
    }

    /**
     * Return Array with Data Url In Use.
     *
     * @return array
     */
    public static function getDataUrl(): array
    {
        $data = new UrlPhp2Js();

        return [
            'url' => [
                'baseUrl'    => $data->getBaseUrl(),
                'fullUrl'    => $data->getFullUrl(),
                'uri'        => $data->getUri(),
                'parameters' => [
                    'route' => $data->getParametersRoute(),
                    'get'   => $data->getParametersGet(),
                    'post'  => $data->getParametersPost(),
                ],
                'scheme'      => $data->getSchema(),
                'currentName' => $data->getCurrentRouteName(),
                'isSecure'    => $data->isSecure(),
            ],
        ];
    }

    /**
     * Return Token CSRF Laravel.
     *
     * @return array
     */
    public static function getDataCSRF(): array
    {
        $data = new TokenPhp2Js();

        return [
            'token'       => $data->csrfToken(),
            'tokenCookie' => $data->csrfTokenCookie(),
        ];
    }

    /**
     * Return Data Laravel.
     *
     * @return array
     */
    public static function getDataLaravel(): array
    {
        $data = new LaravelPhp2Js();

        return [
            'framework' => [
                'version'     => $data->getLaravelVersion(),
                'environment' => [
                    'name'    => $data->getEnvName(),
                    'debug'   => $data->getEnvDebug() == true,
                    'context' => $data->getEnvironment(),
                    'url'     => $data->getEnvUrl(),
                ],
            ],
        ];
    }

    /**
     * Return Data PHP.
     *
     * @return array
     */
    public static function getDataPHP(): array
    {
        $data = new ServerPhp2Js();

        return [
            'php' => [
                'id'                    => $data->getPhpVersionId(),
                'version'               => $data->getPhpVersion(),
                'release'               => $data->getPhpReleaseVersion(),
                'serverSoftware'        => $data->getServerSoftware(),
                'serverOperatingSystem' => $data->getServerOperatingSystem(),
                'extensions'            => $data->getPhpExtensions(),
                'clientLanguage'        => $data->getClientLanguage(),
            ],
        ];
    }

    /**
     * Return User Data.
     *
     * @return mixed
     */
    public static function getDataUser()
    {
        $data = new UserPhp2Js();

        return [
            'user' => $data->getDataUser(),
        ];
    }
}

<?php


namespace App\Services;


use App\Deploy;
use Illuminate\Http\Request;

class Deployer
{
    protected $deploy;
    const API_URL = "https://api.cloudways.com/api/v1";

    public function __construct(Deploy $deploy)
    {
        $this->deploy = $deploy;
    }

    public function deploy(Request $request): array
    {
        $tokenResponse = $this->callCloudwaysAPI('POST', '/oauth/access_token', null
            , [
                'email' => $this->deploy->getEmail(),
                'api_key' => $this->deploy->getApiKey()
            ]);
        $accessToken = $tokenResponse->access_token;
        return $this->callCloudWaysAPI('POST', '/git/pull', $accessToken, [
            'server_id' => $request->server_id,
            'app_id' => $request->app_id,
            'git_url' => $request->git_url,
            'branch_name' => $request->branch_name
            //'deploy_path' => getVar('deploy_path')
        ]);
    }

    private function callCloudwaysAPI($method, $url, $accessToken, $post = [])
    {
        $baseURL = self::API_URL;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_URL, $baseURL . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Set Authorization Header
        if ($accessToken) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $accessToken]);
        }

        //Set Post Parameters
        $encoded = '';
        if (count($post)) {
            foreach ($post as $name => $value) {
                $encoded .= urlencode($name) . '=' . urlencode($value) . '&';
            }
            $encoded = substr($encoded, 0, strlen($encoded) - 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded);
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpcode != '200') {
            die('An error occurred code : ' . $httpcode . ' output: ' . substr($output, 0, 10000));
        }
        curl_close($ch);
        return json_decode($output);
    }
}

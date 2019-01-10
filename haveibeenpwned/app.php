<?php

    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\ClientException;

    require_once 'vendor/autoload.php';

    $client = new Client(['base_uri' => 'https://haveibeenpwned.com/api/v2/', 'delay' => 1500]);
    for ($i = 1; $i < $argc; $i++) {
        echo LookupBreeches($client, $argv[$i]) . PHP_EOL;
    }

    function LookupBreeches($client, $account)
    {
        $result = $account . ': ';

        try {
            $response = $client->get("breachedaccount/{$account}");
            if (200 === $response->getStatusCode()) {
                $json = json_decode($response->getBody());
                $breeches = [];
                foreach ($json as $breech) {
                    $breeches[] = $breech->Title;
                }

                return $result . implode(', ', $breeches);
            }
            else {
                return $result . ' Unexpected result from haveibeenpwned (' . $response->getStatusCode() . ')';
            }
        }
        catch (ClientException $ce)
        {
            // No account listed as having been breached
            if (404 === $ce->getCode()) {
                return $result;
            }
            else {
                return $result . ' Something really bad happened making this request. ' . $ce->getMessage();
            }
        }
        catch (Exception $e)
        {
            return 'Unhandled exception making this request. ' . $e->getMessage();
        }
    }



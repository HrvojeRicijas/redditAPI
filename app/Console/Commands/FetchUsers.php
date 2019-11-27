<?php
namespace App\Console\Commands;
use App\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
class FetchUsers extends Command
{
    protected $signature = 'fetch:users';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        try {
            $response = $client->get('https://www.reddit.com/search.json?q=title:php');
            if ($response->getStatusCode() != 200) {
                throw new Exception('The request was unsuccessful with status code ' . $response->getStatusCode());
            }
            $usersCreated = 0;
            //dd($users = json_decode($response->getBody()->getContents()));
            foreach ($users as $user) {
                $doGenerateQR = User::where('agency_id', $user->Id_gost)->get()->isEmpty();
                $created = User::updateOrCreate([
                    'agency_id' => $user->Id_gost,
                ],
                    [
                        'name' => "{$user->Ime} {$user->Prezime}",
                        'qr_identifier' => $user->Id_kod,
                        'email' => $user->Email,
                        'job' => $user->Radno_mjesto,
                        'organization' => $user->Ustanova,
                        'participation' => $user->Sudionik ? $user->Sudionik : '-',
                        'password' => bcrypt($user->Id_kod),
                    ]);
                if ($created && $doGenerateQR) {
                    $created->generateQRCode();
                }
                if ($created) {
                    Log::info("Updated or created user {$created->name}");
                    $usersCreated++;
                }
            }
            Log::info("{$usersCreated} users have been created and or updated.");
            $this->info("{$usersCreated} users have been created and or updated. - " . date('d.m.Y. H:i:s'));
        } catch (Exception $e) {
            Log::error('An error occurred during the sync of users: ' . $e->getMessage());
            $this->error('An error occurred during the sync of users: ' . $e->getMessage());
        }
    }
}

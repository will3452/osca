<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Textarea;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendSmsMessage extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $key = env('NEXMO_KEY');
        $secret = env('NEXMO_SECRET');

        $message = $fields["message"];

        $client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Basic($key, $secret));


        foreach ($models as $model) {
            $message = $client->message()->send([
                'to' => "63" . $model->contact_number,
                'from' => 'VONAGE',
                'text' => $message
            ]);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Textarea::make('Message')
                ->rules(['max:200', 'required']),
        ];
    }
}

<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Textarea;

class sendSmsMessage extends Action
{
    use InteractsWithQueue, Queueable;

    public function sendMessage($message, $phone)
    {
        $ch = curl_init();
        $parameters = array(
            'apikey' => env('SMS_KEY'), //Your API KEY
            'number' => $phone,
            'message' => $message,
            'sendername' => 'Nuwang',
        );
        curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        curl_setopt($ch, CURLOPT_POST, 1);

        //Send the parameters set above with the request
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

        // Receive response from server
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

        //Show the server response
        echo $output;

        return;
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {

        $message = $fields["message"];

        foreach ($models as $model) {
            $this->sendMessage($message, $model->contact_number);
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

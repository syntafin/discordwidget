<?php

namespace Syntafin\DiscordWidget\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Widget extends Component
{
    public $serverId;

    public function mount($serverId)
    {
        $this->serverId = $serverId;
    }

    public function render()
    {
        return view('discord-widget::widget', [
            'data' => $this->getServer($this->serverId)
        ]);
    }

    private function getServer($serverId)
    {
        if(Cache::has('discord-widget-server-'.$serverId)) {
            $response = Cache::get('discord-widget-server-'.$serverId);
        }else{
            $result = Http::get('https://discord.com/api/guilds/'.$serverId.'/widget.json');
            $response = json_decode($result->getBody());
            Cache::put('discord-widget-server-'.$serverId, $response, now()->addMinutes(5));
        }

        if(isset($response->message)) {
            $widgetdata = (object) [
                'error' => $response->message,
                'code' => $response->code
            ];

            return $widgetdata;
        }

        foreach($response->members as $i => $member) {
            if(!empty($member->channel_id)) {
                $channelMembers[$member->channel_id][] = $member;
            }
            if(Cache::has('discord-widget-user-'.$member->user->id)) {
                $response->members[$i]->avatar_url = Cache::get('discord-widget-user-'.$member->id);
            }else{
                $avatar = Http::get($member->user->avatar_url);
                Cache::put('discord-widget-user-'.$member->user->id, $avatar->getUri(), now()->addMinutes(5));
                $response->members[$i]->avatar_url = Cache::get('discord-widget-user-'.$member->id);
            }
        }

        if(!empty($response->channels)) {
            usort($response->channels, static function($a, $b) {
                if($a->position === $b->position) {
                    return 0;
                }

                return $a->position < $b->position ? -1 : 1;
            });
        }

        $widgetdata = (object) [
            'channel_list' => $response->channels,
            'member_list' => $response->members,
            'channel_count' => count($response->channels),
            'member_count' => count($response->members),
            'server_name' => $response->name,
            'instant_invite' => $response->instant_invite,
            'channelMembers' => isset($channelMembers) ? $channelMembers : null
        ];

        return $widgetdata;
    }
}

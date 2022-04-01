<?php

namespace Syntafin\DiscordWidget\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Widget extends Component
{
    public int $serverId;

    public function mount($serverId)
    {
        $this->serverId = $serverId;
    }

    /**
     * Render the Widget View
     */
    public function render()
    {
        return view('discord-widget::widget', [
            'data' => $this->getServer($this->serverId)
        ]);
    }

    /**
     * Get server data from cache or Discord API
     *
     * @param  int  $serverId
     * @return object
     */
    private function getServer($serverId): object
    {
        if (Cache::has('discord-widget-server-'.$serverId)) {
            $response = Cache::get('discord-widget-server-'.$serverId);
        } else {
            $result = Http::get('https://discord.com/api/guilds/'.$serverId.'/widget.json');
            $response = json_decode($result->getBody());
            Cache::put('discord-widget-server-'.$serverId, $response, now()->addMinutes(5));
        }

        if (isset($response->message)) {
            return (object)[
                'error' => $response->message,
                'code' => $response->code
            ];
        }

        foreach ($response->members as $i => $member) {
            if (!empty($member->channel_id)) {
                $channelMembers[$member->channel_id][] = $member;
            }

            if (!Cache::has('discord-widget-user-'.$member->id)) {
                $avatar = Http::get($member->avatar_url);
                Cache::put('discord-widget-user-'.$member->id, base64_encode($avatar->body()), now()->addMinutes(5));
            }
            $response->members[$i]->avatar_url = 'data:image/png;base64,'.Cache::get(
                    'discord-widget-user-'.$member->id
                );
        }

        if (!empty($response->channels)) {
            usort($response->channels, static function ($a, $b) {
                if ($a->position === $b->position) {
                    return 0;
                }

                return $a->position < $b->position ? -1 : 1;
            });
        }

        return (object)[
            'channel_list' => $response->channels,
            'member_list' => $response->members,
            'channel_count' => count($response->channels),
            'member_count' => count($response->members),
            'server_name' => $response->name,
            'instant_invite' => $response->instant_invite,
            'channelMembers' => $channelMembers ?? null
        ];
    }
}

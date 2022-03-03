<div>
    @isset($data->error)
    <div class="alert alert-danger">
        @lang('discord-widget::widget.error', ['error' => $data->error, 'code' => $data->code])
        @dump($data)
    </div>
    @else
    <div class="w-full">
        <p class="p-6">
            @lang('discord-widget::widget.voicechannel')
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-100">
                {{ $data->channel_count }}
            </span>
        </p>
        <ul class="dividy-y divide-gray-200">
            @foreach($data->channel_list as $channel)
                @if(!empty($data->channelMembers[$channel->id]))
                    <li><i class="fas fa-volume"></i> {{ $channel->name }}
                        <ul class="list-unstyled">
                            @foreach($data->channelMembers[$channel->id] as $member)
                                <li>
                                    {{ $member->username }}
                                    @if($member->self_mute || $member->mute) <i class="fas fa-microphone-slash"></i> @endif
                                    @if($member->self_deaf || $member->deaf) <i class="fas fa-volume-slash"></i> @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li><i class="fas fa-volume"></i> {{ $channel->name }}</li>
                @endif
            @endforeach
        </ul>
        <h5>@lang('discord-widget::widget.membersOnline') <span class="badge badge-secondary">{{ $data->member_count }}</span></h5>
        <div class="discordWidgetUsers">
            <ul class="divide-y divide-gray-200">
                @foreach($data->member_list as $member)
                    <li class="py-4 flex">
                        <div>
                            @if(config('discord-widget.avatar'))
                                <img src="{{ $member->avatar_url }}" class="h-10 w-10 rounded-full" />
                            @endif
                            <span class="text-sm font-medium text-gray-900 -{{ $member->status }}"></span>
                        </div>
                        <div class="widget-member-name align-baseline">
                            {{ $member->username }}
                        </div>
                        @isset($member->game)
                        <div class="widget-member-game align-baseline">
                            {{ $member->game->name }}
                        </div>
                        @endisset
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="divider"></div>
    <a href="{{ $data->instant_invite }}" class="btn btn-primary">@lang('discord-widget::widget.invite')</a>
    @endisset
</div>
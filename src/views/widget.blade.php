<div>
    @isset($data->error)
    <div class="alert alert-danger">
        @lang('discord-widget::widget.error', ['error' => $data->error, 'code' => $data->code])
    </div>
    @else
    <div class="syntafinDiscordWidget">
        <h5 class="align-center">@lang('discord-widget::widget.voicechannel') <span class="badge badge-secondary">{{ $data->channel_count }}</span></h5>
        <ul class="list-unstyled">
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
            <ul class="list-unstyled">
                @foreach($data->member_list as $member)
                    <li class="widget-member">
                        <div class="widget-member-avatar align-top">
                            @if(config('discord-widget.avatar'))
                                <img src="{{ $member->avatar_url }}" width="25" class="img-fluid rounded rounded-circle" />
                            @endif
                            <span class="widget-member-status noAvatar" class="widget-member-status-{{ $member->status }}"></span>
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
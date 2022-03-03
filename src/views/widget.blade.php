@props(['status' => 'online'])

@php
switch ($status) {
    case 'online':
        $status = 'green';
        break;
    case 'away':
        $status = 'yellow';
        break;
    case 'dnd':
        $status = 'red';
        break;
    default:
        $status = 'gray';
}
@endphp
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
                                    @if($member->self_mute || $member->mute)
                                        <div class="text-color-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class="fa-primary" d="M630.8 469.1L38.81 5.111C34.41 1.673 29.19 0 24.03 0C16.91 0 9.839 3.158 5.12 9.189C-3.067 19.63-1.25 34.72 9.188 42.89l591.1 463.1c10.5 8.203 25.57 6.328 33.69-4.078C643.1 492.4 641.2 477.3 630.8 469.1z"/><path class="fa-secondary" d="M383.1 464l-39.1-.0001v-33.77c20.6-2.824 39.98-9.402 57.69-18.72l-43.26-33.91c-14.66 4.652-30.28 7.179-46.68 6.144C245.7 379.6 191.1 317.1 191.1 250.9V247.2L143.1 209.5l.0001 38.61c0 89.66 63.97 169.6 151.1 181.7v34.15l-40 .0001c-17.67 0-31.1 14.33-31.1 31.1C223.1 504.8 231.2 512 239.1 512h159.1c8.838 0 15.1-7.164 15.1-15.1C415.1 478.3 401.7 464 383.1 464zM471.1 192c-13.25 0-24 10.75-24 24l-.0001 39.1c0 21.12-5.559 40.77-14.77 58.24l38.24 29.97c15.37-25.94 24.53-55.91 24.53-88.21V216C495.1 202.7 485.3 192 471.1 192zM319.1 0C266.1 0 223.1 42.97 223.1 96l0 54.25l183.5 143.8c5.234-11.69 8.493-24.42 8.493-38.08L415.1 96C415.1 42.97 373 0 319.1 0z"/></svg>
                                        </div>
                                    @endif
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
                        @if(config('discord-widget.avatar'))
                            <span class="inline-block relative">
                                <img class="h-10 w-10 rounded-full" src="{{ $member->avatar_url }}" alt="">
                                <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white bg-{{ $status }}-400"></span>
                            </span>
                        <img src="{{ $member->avatar_url }}" class="h-10 w-10 rounded-full" />
                        @endif
                        <span class="text-sm font-medium text-gray-900 -{{ $member->status }}"></span>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ $member->username }}</p>
                            @isset($member->game)
                            <p class="text-sm text-gray-500">{{ $member->game->name }}</p>
                            @endisset
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="divider"></div>
    <a href="{{ $data->instant_invite }}" class="btn btn-primary">@lang('discord-widget::widget.invite')</a>
    @endisset
</div>
<div style="background: url("{{ asset('vendor/images/discordWidgetBoxBackground_1.png') }}")">
    @isset($data->error)
    <div class="alert alert-danger">
        @lang('discord-widget::widget.error', ['error' => $data->error, 'code' => $data->code])
        @dump($data)
    </div>
    @else
    <div class="w-full">
        <p class="p-4 text-xl inline-flex">
            @lang('discord-widget::widget.voicechannel')
            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-100 ml-2">
                {{ $data->channel_count }}
            </span>
        </p>
        <ul class="dividy-y divide-gray-200">
            @foreach($data->channel_list as $channel)
                @if(!empty($data->channelMembers[$channel->id]))
                    <li class="text-lg font-bold ml-5">
                        {{ $channel->name }}
                        <ul class="text-base font-normal ml-5">
                            @foreach($data->channelMembers[$channel->id] as $member)
                                <li>
                                    {{ $member->username }}
                                    @if($member->self_mute || $member->self_deaf || $member->mute || $member->deaf)
                                    <ul class="inline-flex">
                                        @if($member->self_mute || $member->mute)
                                        <li class="text-red-500 h-4 w-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                <path d="M383.1 464l-39.1-.0001v-33.77c20.6-2.824 39.98-9.402 57.69-18.72l-43.26-33.91c-14.66 4.65-30.28 7.179-46.68 6.144C245.7 379.6 191.1 317.1 191.1 250.9V247.2L143.1 209.5l.0001 38.61c0 89.65 63.97 169.6 151.1 181.7v34.15l-40 .0001c-17.67 0-31.1 14.33-31.1 31.1C223.1 504.8 231.2 512 239.1 512h159.1c8.838 0 15.1-7.164 15.1-15.1C415.1 478.3 401.7 464 383.1 464zM630.8 469.1l-159.3-124.9c15.37-25.94 24.53-55.91 24.53-88.21V216c0-13.25-10.75-24-23.1-24c-13.25 0-24 10.75-24 24l-.0001 39.1c0 21.12-5.559 40.77-14.77 58.24l-25.72-20.16c5.234-11.68 8.493-24.42 8.493-38.08l-.001-155.1c0-52.57-40.52-98.41-93.07-99.97c-54.37-1.617-98.93 41.95-98.93 95.95l0 54.25L38.81 5.111C34.41 1.673 29.19 0 24.03 0C16.91 0 9.839 3.158 5.12 9.189c-8.187 10.44-6.37 25.53 4.068 33.7l591.1 463.1c10.5 8.203 25.57 6.328 33.69-4.078C643.1 492.4 641.2 477.3 630.8 469.1z" />
                                            </svg>
                                        </li>
                                        @endif
                                        @if($member->self_deaf || $member->deaf)
                                        <li class="text-red-500 h-4 w-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                <path d="M301.2 34.85c-11.5-5.188-25.02-3.122-34.44 5.253L131.8 160H48c-26.51 0-48 21.49-48 47.1v95.1c0 26.51 21.49 47.1 48 47.1h83.84l134.9 119.9c5.984 5.312 13.58 8.094 21.26 8.094c4.438 0 8.972-.9375 13.17-2.844c11.5-5.156 18.82-16.56 18.82-29.16V64C319.1 51.41 312.7 40 301.2 34.85zM513.9 255.1l47.03-47.03c9.375-9.375 9.375-24.56 0-33.94s-24.56-9.375-33.94 0L480 222.1L432.1 175c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l47.03 47.03l-47.03 47.03c-9.375 9.375-9.375 24.56 0 33.94c9.373 9.373 24.56 9.381 33.94 0L480 289.9l47.03 47.03c9.373 9.373 24.56 9.381 33.94 0c9.375-9.375 9.375-24.56 0-33.94L513.9 255.1z" />
                                            </svg>
                                        </li>
                                        @endif
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                <li class="text-lg font-bold ml-5">{{ $channel->name }}</li>
                @endif
            @endforeach
        </ul>
        <p class="p-4 text-xl inline-flex">
            @lang('discord-widget::widget.membersOnline')
            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-100 ml-2">
                {{ $data->member_count }}
            </span>
        </p>
        <div class="h-80 overflow-y-auto" data-simplebar>
            <div class="space-y-1">
                @foreach($data->member_list as $member)
                    @php
                        switch ($member->status) {
                            case 'online':
                            $status = 'bg-green-400';
                            break;
                            case 'idle':
                            $status = 'bg-yellow-400';
                            break;
                            case 'dnd':
                            $status = 'bg-red-400';
                            break;
                            default:
                            $status = 'bg-gray-400';
                        }

                        $ringColor = config('discord-widget.colors.ringColor');
                        $background = config('discord-widget.colors.background');
                        $border = config('discord-widget.colors.border');
                        $borderHover = config('discord-widget.colors.borderHover');
                        $text = config('discord-widget.colors.text');
                        $textSub = config('discord-widget.colors.textSub');
                        $button = config('discord-widget.colors.button');
                        $buttonHover = config('discord-widget.colors.buttonHover');
                    @endphp
                    <div class="relative rounded-lg border {{ $border }} {{ $background }} p-3 shadow-sm flex items-center space-x-3 {{ $borderHover }}">
                        @if(config('discord-widget.avatar'))
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="{{ $member->avatar_url }}" alt="">
                            <span class="relative bottom-2 left-7 block h-2.5 w-2.5 rounded-full ring-2 {{ $ringColor }} {{ $status }}"></span>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                            <p class="text-sm font-medium {{ $text }}">{{ $member->username }}</p>
                            @isset($member->game)
                            <p class="text-sm {{ $textSub }} truncate">{{ $member->game->name }}</p>
                            @endisset
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <a href="{{ $data->instant_invite }}" class="inline-flex items-center px-5 py-2 border border-transparent font-medium rounded w-full shadow-sm text-white {{ $button }} {{ $buttonHover }} transition ease-in-out delay-150 hover:scale-110">
        @lang('discord-widget::widget.invite')
    </a>
    @endisset
</div>
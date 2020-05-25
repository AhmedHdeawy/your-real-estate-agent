@extends('layouts.master')

@section('content')

<section class='profile-page' id="app">
    <div class='row'>
        <div class='col-lg-6 col-md-10 mx-auto'>
            <div class='groups'>

                <ul class='groups-body'>
                    <li style='text-align: center;' class="mb-4">
                        <a href='{{ route('groups.create') }}' class="btn btn-rbzgo">
                            <i class='fas fa-plus text-white'></i>
                            <span class="font-weight-bold text-white mx-1"> {{ __('lang.createGroup') }} </span>
                        </a>
                    </li>

                    @forelse ($groups as $group)
                    <li class='clearfix mb-4'>
                        <a href='{{ route('groups.show', ['group_permlink'  => $group->unique_name]) }}'
                            class="font-weight-bold color-rbzgo">
                            @if ($group->image)
                            <img src="{{ asset('images/' . $group->image) }}"
                                class="img-avatar {{ $currentLangDir == 'rtl' ? 'float-right' : 'float-left' }}">
                            @else

                            <avatar
                                class="img-avatar d-inline-block {{ $currentLangDir == 'rtl' ? 'float-right' : 'float-left' }}"
                                :username="{{ json_encode($group->nameForAvatar()) }}" background-color="#7F78B4"
                                color="#FFF">
                            </avatar>
                            @endif
                            <span class="mx-3">
                                {{ $group->name }}
                                <span class="d-block text-secondary">
                                    {{ $group->users_count }} {{ __('lang.member') }} -
                                    {{ $group->posts_count }} {{ __('lang.post') }}
                                </span>
                            </span>
                        </a>

                        <form action="{{ route('groups.leave') }}" method="POST">
                            @csrf
                            <input type="hidden" name="group_permlink" value="{{ $group->unique_name }}">
                            <button class='btn leave_group' type="submit">
                                <span> {{ __('lang.leave') }} </span>
                                <i class='fa fa-level-up-alt'></i>
                            </button>
                        </form>

                    </li>
                    @empty
                    <li style='text-align: center;' class="mb-4">
                        <p> {{ __('lang.noJoinedGroups') }}
                            <a href='{{ route('groups.create') }}' class="color-rbzgo font-weight-bold">
                                {{ __('lang.search') }}
                            </a>
                        </p>
                    </li>
                    @endforelse

                </ul>
            </div>
        </div>
    </div>
</section>


@endsection

@section('script')

<script>
    $('.leave_group').click(function (e) {
    e.preventDefault();

    Swal.fire({
    title: '{{__("lang.areSureLeave")}}',
    text: '{{__("lang.leaveHint")}}',
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: '{{__("lang.yes")}}',
    cancelButtonText: '{{__("lang.no")}}',
    })
    .then(result => {
    // If User accept
    if (result.value) {
        $(this).parent().submit();
    }
    })
    .catch(() => {});
    });
</script>

@endsection

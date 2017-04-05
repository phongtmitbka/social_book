<input type="hidden" class="memberId" value="{{ $member->id }}">

@if (isset($user) && $member->following == 0 && $user->id != $member->id)
    <span class="follow-btn btn btn-default">
        {{ trans('profile.follow') }}
    </span>
@endif

@if (isset($user) && $member->following == 1 && $user->id != $member->id)
    <span class="following-btn btn btn-default">
        {{ trans('profile.following') }}
    </span>
@endif

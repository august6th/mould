<div class="stats">
    <a href="{{ route('user.followings', $user->id) }}">
        <strong id="following" class="stat">
            {{ count($user->followings) }}
        </strong>
        关注
    </a>
    <a href="{{ route('user.followers', $user->id) }}">
        <strong id="followers" class="stat">
            {{ count($user->followers) }}
        </strong>
        粉丝
    </a>
    <a href="{{ route('user.show', $user->id) }}">
        <strong id="statuses" class="stat">
            {{ $user->statuses()->count() }}
        </strong>
        微博
    </a>
</div>
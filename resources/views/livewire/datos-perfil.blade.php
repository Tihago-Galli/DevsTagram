<div>
    <p class="text-gray-800 text-sm mb-3 font-bold mt-5">{{$user->follower->count()}}
        <span id="seguidor" wire:click="$emit('mostrarFollower', {{$user->follower}})" class="font-normal hover:cursor-pointer">@choice('Seguidor|Seguidores', $user->follower->count())</span>
       
    </p>
    <p class="text-gray-800 text-sm mb-3 font-bold">{{$user->followings->count()}}
        <span wire:click="$emit('mostrarFollowings', {{$user->followings}})" class="font-normal">Siguiendo</span>
    </p>

    
</div>


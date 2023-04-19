<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" id="topbar-notifydrop"
        role="button" aria-haspopup="true" aria-expanded="true">
        <i class="uil-bell uil-24px noti-icon"></i>
        <span class="top-2 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $notifications->count() }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg" aria-labelledby="topbar-notifydrop"
        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-278px, 72px);"
        data-popper-placement="bottom-end">

        <!-- item-->
        <div class="dropdown-item noti-title">
            <h5 class="m-0">
                <span class="float-end">
                    <a href="javascript: void(0);" class="text-dark">
                        <small>Limpiar todo</small>
                    </a>
                </span>
            </h5>
        </div>

        <div style="max-height: 230px;" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">
                                <!-- item-->
                                @forelse ($notifications as $nt)
                                    <a href="javascript:void(0);" class="dropdown-item notify-item" wire:click="changeStatus({{ $nt->id }})">
                                        <div class="notify-icon bg-danger">
                                            <i class="uil-stopwatch"></i>
                                        </div>
                                        <p class="notify-details">{{ $nt->title }}
                                            <small class="text-muted">{{ $nt->expire_time }}</small>
                                        </p>
                                    </a>
                                @empty
                                    <p class="text-center notify-details">No hay notificaciones</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: 318px; height: {{ $notifications->count() == 0 ? '50' : '300'}}px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar"
                    style="height: 135px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
            </div>
        </div>

        <!-- All-->
        <a href="javascript:void(0);" class="dropdown-item text-center text-info notify-item notify-all">
            Ver todo
        </a>
    </div>
</li>

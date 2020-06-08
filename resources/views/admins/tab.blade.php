<ul class="nav nav-tabs nav-justified mb-3">
    {{-- ユーザ登録タブ --}}
    <li class="nav-item">
        <a href="{{ route('index') }}" class="nav-link {{ Request::routeIs('index') ? 'active' : '' }}">
            ユーザー登録
        </a>
    </li>
    {{-- 部署変更タブ --}}
    <li class="nav-item">
        <a href="{{ route('change_department_page') }}" class="nav-link {{ Request::routeIs('change_department_page') ? 'active' : '' }}">
            部署変更
        </a>
    </li>
    {{-- ススメ投稿タブ --}}
    <li class="nav-item">
        <a href="{{ route('susume_page') }}" class="nav-link {{ Request::routeIs('susume_page') ? 'active' : '' }}">
            ススメ投稿
        </a>
    </li>
</ul>